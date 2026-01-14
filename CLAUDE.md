# CLAUDE.md - Project Context

## Project Overview

This is a **CodeIgniter 4 + Cockpit CMS + Blade Starter Project** - a demonstration and starter template for building applications that use CodeIgniter 4 as the framework, Blade (via BladeOne) as the templating engine, and Cockpit CMS as a headless content management system.

## Purpose

This project serves as:
- A **starter template** for developers wanting to integrate CodeIgniter 4 with Cockpit CMS
- A **demo project** showcasing best practices for consuming Cockpit CMS APIs
- A **reference implementation** for headless CMS integration with CodeIgniter 4

## Architecture

### Tech Stack

- **Frontend Framework**: CodeIgniter 4 (PHP 8.1+)
- **Templating Engine**: Blade (via eftec/bladeone)
- **Content Management**: Cockpit CMS (Headless CMS)
- **Data Flow**: API consumption from Cockpit CMS endpoints
- **No Database**: This project does NOT use a local database
- **No Authentication**: This project does NOT implement authentication/authorization

### Key Characteristics

✅ **What This Project DOES:**
- Use Blade templating engine for views
- Consume API endpoints from Cockpit CMS
- Display content fetched from Cockpit
- Demonstrate headless CMS integration patterns
- Provide a clean starter template with modern templating

❌ **What This Project DOES NOT:**
- Use a local database (all data comes from Cockpit API)
- Implement user authentication/authorization
- Store or persist data locally
- Require database configuration

## Project Structure

```
ci4-cockpit-starter/
├── app/
│   ├── Config/
│   │   └── Services.php       # Service definitions (blade, cockpit)
│   ├── Controllers/
│   │   ├── BaseController.php # Base for API/CLI controllers
│   │   ├── WebController.php  # Base for web pages (extends BaseController)
│   │   └── Home.php           # Example web controller (extends WebController)
│   ├── Views/                 # Blade view templates (*.blade.php)
│   │   ├── layouts/           # Blade layouts
│   │   └── components/        # Reusable Blade components
│   ├── Libraries/
│   │   ├── BladeView.php      # Blade templating engine wrapper
│   │   └── CockpitService.php # Cockpit CMS API client with caching
│   ├── Helpers/
│   │   └── blade_helper.php   # Blade helper functions
│   └── ...
├── public/                    # Web root (index.php lives here)
├── vendor/                    # Composer dependencies
├── writable/
│   └── cache/blade/          # Blade compiled views cache
├── .env                      # Environment configuration
├── composer.json             # PHP dependencies
├── BLADE.md                  # Blade templating documentation
└── CLAUDE.md                 # This file - project context
```

## Key Configuration

### Environment Setup

1. Copy `env` to `.env`
2. Configure `baseURL` for your environment
3. Add Cockpit CMS API configuration:
   - Cockpit API URL
   - Cockpit API token/key (if required)

### Blade Templating

This project uses BladeOne templating engine for views:
- **Package**: `eftec/bladeone` (lightweight, zero dependencies, actively maintained)
- **Helper Function**: `view_blade('viewname', $data)`
- **Library**: `App\Libraries\BladeView`
- **Views Location**: `app/Views/*.blade.php`
- **Cache Location**: `writable/cache/blade/`

Example usage:
```php
// In controller
return view_blade('welcome', ['title' => 'My Page']);
```

See `BLADE.md` for complete documentation.

### Cockpit CMS Integration

This project integrates with Cockpit CMS by:
1. Making HTTP requests to Cockpit API endpoints
2. Parsing JSON responses
3. Rendering content in Blade views

### Architecture Rules

**IMPORTANT:** The following architecture rules must be strictly followed:

#### 1. No Models or Entities
- **Rule**: Do NOT create local CodeIgniter 4 Models or Entities
- **Reason**: All data comes from Cockpit CMS API, not a local database
- **Implementation**: Use `App\Libraries\CockpitService` for all data retrieval

#### 2. No Migrations
- **Rule**: Do NOT create CodeIgniter 4 Migrations
- **Reason**: Database structure is managed solely in Cockpit CMS
- **Implementation**: Configure content models in Cockpit, not in CI4

#### 3. Controller Inheritance
- **WebController**: Use `App\Controllers\WebController` for all HTML pages (Home, About, Blog, etc.)
  - This class extends `BaseController`
  - Automatically initializes CMS (`$this->cockpit`) and View engine (`$this->blade`)
  - Provides convenient `render()` method for Blade views
  - Example:
    ```php
    class Home extends WebController
    {
        public function index()
        {
            $data = $this->cockpit->getSingletonCached('homepage');
            return $this->render('home', ['data' => $data]);
        }
    }
    ```

- **BaseController**: Keep clean for API/CLI use
  - Do NOT add web-specific initialization to BaseController
  - Reserve for API controllers or CLI commands that don't need CMS/Views
  - Example: REST API controllers, CLI commands, cron jobs

#### 4. Services Layer
- **Rule**: Access libraries via `Config\Services`
- **Available Services**:
  - `Services::blade()` - Get BladeView instance
  - `Services::cockpit()` - Get CockpitService instance
- **Implementation**:
  ```php
  // In controllers
  $blade = Services::blade();
  $cockpit = Services::cockpit();

  // Or use inherited properties in WebController
  $this->blade->render('view', $data);
  $this->cockpit->getSingletonCached('homepage');
  ```

#### 5. Caching Strategy
- **Rule**: All Cockpit API calls MUST be cached
- **Implementation**: Use caching methods in `CockpitService`
  - `getSingletonCached($name, $ttl)` - For singleton resources
  - `getCollectionCached($name, $filter, $ttl)` - For collections
  - Default TTL: 3600 seconds (1 hour)
- **Example**:
  ```php
  // Cached API call (recommended)
  $data = $this->cockpit->getSingletonCached('homepage', 1800); // 30 min cache

  // Cached collection with filter
  $posts = $this->cockpit->getCollectionCached('posts', ['published' => true]);
  ```

#### 6. Data Flow Pattern
```
Controller (WebController)
    ↓
CockpitService (with caching)
    ↓
Cockpit CMS API
    ↓
Blade View (via BladeView)
```

## Development Guidelines

### When Working on This Project

1. **API Consumption**: All data should come from Cockpit CMS API endpoints
2. **No Database**: Do not add database models or migrations
3. **No Auth**: Do not implement authentication features
4. **Keep It Simple**: Focus on demonstrating Cockpit integration
5. **HTTP Client**: Use CodeIgniter's CURLRequest or HTTP Client for API calls

### Typical Workflow

1. Configure Cockpit CMS connection in `.env`
2. Create controllers to fetch data from Cockpit APIs
3. Parse and process API responses
4. Create or use Blade views (`.blade.php` files)
5. Pass data to Blade views using `view_blade()` helper
6. Use Blade layouts, components, and directives for templating
7. Style and present content as needed

## Important Notes for AI Assistants

- **Follow Architecture Rules**: Strictly adhere to the Architecture Rules section above
- **Use Blade for views**: All views should use Blade templating (`.blade.php` extension)
- **Blade helper is auto-loaded**: The `view_blade()` helper function is available globally
- **No Models/Migrations**: Do NOT create CI4 Models, Entities, or Migrations - use `CockpitService` instead
- **Controller inheritance**: Web pages extend `WebController`, not `BaseController`
- **Use Services**: Access `blade()` and `cockpit()` via `Config\Services`
- **Cache all API calls**: Use `getSingletonCached()` and `getCollectionCached()` methods
- **Database files can be ignored**: Database.php and migration-related configs exist in the starter template but are not used
- **Focus on API integration**: The core functionality revolves around consuming Cockpit CMS APIs
- **Stateless approach**: This is a read-only application that displays content from Cockpit
- **No user management**: Do not implement login, registration, or user-related features

## Resources

- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/)
- [Laravel Blade Documentation](https://laravel.com/docs/blade) (Syntax reference)
- [BladeOne GitHub](https://github.com/EFTEC/BladeOne)
- [Cockpit CMS](https://getcockpit.com/)
- [Cockpit API Documentation](https://getcockpit.com/documentation/api)
- See `BLADE.md` for complete Blade integration guide

## Server Requirements

- PHP 8.1 or higher
- Required extensions:
  - intl
  - mbstring
  - json
  - libcurl (for API requests)

## Getting Started

1. Clone this repository
2. Run `composer install`
3. Copy `env` to `.env` and configure
4. Set up Cockpit CMS instance
5. Configure Cockpit API credentials
6. Point web server to `public/` directory
7. Start building!

---

**Last Updated**: 2026-01-06
**Project Type**: Starter/Demo
**Primary Goal**: Demonstrate CodeIgniter 4 + BladeOne + Cockpit CMS integration
