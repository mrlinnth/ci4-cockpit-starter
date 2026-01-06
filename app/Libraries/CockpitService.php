<?php

namespace App\Libraries;

use CodeIgniter\HTTP\CURLRequest;
use Config\Services;

/**
 * CockpitService Library
 *
 * Handles all Cockpit CMS API interactions with built-in caching
 *
 * @package App\Libraries
 */
class CockpitService
{
    /**
     * Cockpit API base URL
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * Cockpit API token
     *
     * @var string
     */
    protected $apiToken;

    /**
     * HTTP Client
     *
     * @var CURLRequest
     */
    protected $client;

    /**
     * Cache instance
     *
     * @var \CodeIgniter\Cache\CacheInterface
     */
    protected $cache;

    /**
     * Default cache TTL (in seconds)
     *
     * @var int
     */
    protected $cacheTTL = 3600; // 1 hour

    /**
     * Constructor
     */
    public function __construct()
    {
        // Load configuration from .env or config
        $this->apiUrl = getenv('COCKPIT_API_URL') ?: '';
        $this->apiToken = getenv('COCKPIT_API_TOKEN') ?: '';

        // Initialize HTTP client
        $this->client = Services::curlrequest([
            'baseURI' => $this->apiUrl,
            'headers' => [
                'api-key' => $this->apiToken,
                'Content-Type' => 'application/json',
            ],
        ]);

        // Initialize cache
        $this->cache = Services::cache();
    }

    /**
     * Get a singleton resource from Cockpit (cached)
     *
     * @param string $singletonName Name of the singleton
     * @param int|null $ttl Cache time-to-live in seconds (null = use default)
     * @return array|null
     */
    public function getSingletonCached(string $singletonName, ?int $ttl = null): ?array
    {
        $cacheKey = 'cockpit_singleton_' . $singletonName;
        $ttl = $ttl ?? $this->cacheTTL;

        // Try to get from cache
        $data = $this->cache->get($cacheKey);

        if ($data !== null) {
            return $data;
        }

        // Fetch from API
        $data = $this->getSingleton($singletonName);

        // Cache the result
        if ($data !== null) {
            $this->cache->save($cacheKey, $data, $ttl);
        }

        return $data;
    }

    /**
     * Get a collection from Cockpit (cached)
     *
     * @param string $collectionName Name of the collection
     * @param array $filter Optional filter criteria
     * @param int|null $ttl Cache time-to-live in seconds (null = use default)
     * @return array
     */
    public function getCollectionCached(string $collectionName, array $filter = [], ?int $ttl = null): array
    {
        $cacheKey = 'cockpit_collection_' . $collectionName . '_' . md5(json_encode($filter));
        $ttl = $ttl ?? $this->cacheTTL;

        // Try to get from cache
        $data = $this->cache->get($cacheKey);

        if ($data !== null) {
            return $data;
        }

        // Fetch from API
        $data = $this->getCollection($collectionName, $filter);

        // Cache the result
        $this->cache->save($cacheKey, $data, $ttl);

        return $data;
    }

    /**
     * Get a singleton resource from Cockpit (uncached)
     *
     * @param string $singletonName Name of the singleton
     * @return array|null
     */
    protected function getSingleton(string $singletonName): ?array
    {
        try {
            $response = $this->client->get("/api/singletons/get/{$singletonName}");

            if ($response->getStatusCode() === 200) {
                return json_decode($response->getBody(), true);
            }

            log_message('error', "Cockpit API error for singleton '{$singletonName}': " . $response->getStatusCode());
            return null;
        } catch (\Exception $e) {
            log_message('error', "Cockpit API exception for singleton '{$singletonName}': " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get a collection from Cockpit (uncached)
     *
     * @param string $collectionName Name of the collection
     * @param array $filter Optional filter criteria
     * @return array
     */
    protected function getCollection(string $collectionName, array $filter = []): array
    {
        try {
            $options = [];

            if (!empty($filter)) {
                $options['json'] = ['filter' => $filter];
            }

            $response = $this->client->post("/api/collections/get/{$collectionName}", $options);

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody(), true);
                return $result['entries'] ?? [];
            }

            log_message('error', "Cockpit API error for collection '{$collectionName}': " . $response->getStatusCode());
            return [];
        } catch (\Exception $e) {
            log_message('error', "Cockpit API exception for collection '{$collectionName}': " . $e->getMessage());
            return [];
        }
    }

    /**
     * Clear cache for a specific singleton
     *
     * @param string $singletonName
     * @return bool
     */
    public function clearSingletonCache(string $singletonName): bool
    {
        $cacheKey = 'cockpit_singleton_' . $singletonName;
        return $this->cache->delete($cacheKey);
    }

    /**
     * Clear cache for a specific collection
     *
     * @param string $collectionName
     * @param array $filter Optional filter criteria used when caching
     * @return bool
     */
    public function clearCollectionCache(string $collectionName, array $filter = []): bool
    {
        $cacheKey = 'cockpit_collection_' . $collectionName . '_' . md5(json_encode($filter));
        return $this->cache->delete($cacheKey);
    }

    /**
     * Clear all Cockpit cache
     *
     * @return bool
     */
    public function clearAllCache(): bool
    {
        return $this->cache->clean();
    }

    /**
     * Set default cache TTL
     *
     * @param int $seconds
     * @return void
     */
    public function setCacheTTL(int $seconds): void
    {
        $this->cacheTTL = $seconds;
    }

    /**
     * Get the API URL
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * Check if Cockpit is configured
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiUrl) && !empty($this->apiToken);
    }
}
