# Blade Templating Integration

This project uses the **Laravel Blade** templating engine via the [jenssegers/blade](https://github.com/jenssegers/blade) package, integrated seamlessly with CodeIgniter 4.

## Package Information

- **Package**: `jenssegers/blade`
- **Version**: Latest stable
- **Compatibility**: CodeIgniter 4.x, PHP 8.1+
- **Maintenance**: Actively maintained and widely used

## Usage

### Method 1: Using the Helper Function (Recommended)

The easiest way to render Blade views is using the `view_blade()` helper function:

```php
<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome',
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];

        return view_blade('welcome', $data);
    }
}
```

### Method 2: Using the BladeView Library

For more control, you can use the `BladeView` library directly:

```php
<?php

namespace App\Controllers;

use App\Libraries\BladeView;

class Home extends BaseController
{
    public function index()
    {
        $blade = new BladeView();

        $data = [
            'title' => 'Welcome',
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];

        return $blade->render('welcome', $data);
    }
}
```

### Method 3: Using the blade() Helper

Get the BladeView instance for advanced operations:

```php
<?php

// Render a view
echo blade()->render('myview', $data);

// Add a custom directive
blade()->directive('datetime', function ($expression) {
    return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
});

// Clear the Blade cache
blade()->clearCache();
```

## View Files

Blade views should be placed in `app/Views/` and use the `.blade.php` extension.

### Example Structure

```
app/Views/
├── layouts/
│   └── master.blade.php         # Main layout
├── components/
│   └── card.blade.php           # Reusable component
├── welcome.blade.php            # Welcome page
└── pages/
    └── about.blade.php          # About page
```

## Blade Syntax Examples

### Layouts and Inheritance

**Layout file** (`app/Views/layouts/master.blade.php`):
```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>
```

**Child view** (`app/Views/page.blade.php`):
```blade
@extends('layouts.master')

@section('title', 'My Page Title')

@section('content')
    <h1>Page Content</h1>
@endsection
```

### Control Structures

```blade
{{-- If statements --}}
@if($user->isAdmin())
    <p>Admin User</p>
@elseif($user->isEditor())
    <p>Editor User</p>
@else
    <p>Regular User</p>
@endif

{{-- Loops --}}
@foreach($items as $item)
    <li>{{ $item->name }}</li>
@endforeach

@for($i = 0; $i < 10; $i++)
    <p>{{ $i }}</p>
@endfor

{{-- Unless --}}
@unless($user->isGuest())
    <p>Welcome back!</p>
@endunless
```

### Including Views

```blade
@include('partials.header')

@include('partials.sidebar', ['menu' => $menuItems])
```

### Components

**Define component** (`app/Views/components/alert.blade.php`):
```blade
<div class="alert alert-{{ $type ?? 'info' }}">
    {{ $slot }}
</div>
```

**Use component**:
```blade
@include('components.alert', ['type' => 'success'])
    Operation completed successfully!
@endinclude
```

### Echoing Data

```blade
{{-- Escaped output (safe) --}}
<p>{{ $name }}</p>

{{-- Raw output (use with caution) --}}
<p>{!! $htmlContent !!}</p>

{{-- With default value --}}
<p>{{ $name ?? 'Guest' }}</p>
```

## Integration with Cockpit CMS

Example controller fetching data from Cockpit API and rendering with Blade:

```php
<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;

class Articles extends BaseController
{
    public function index()
    {
        // Fetch data from Cockpit CMS
        $client = \Config\Services::curlrequest();
        $response = $client->get(env('COCKPIT_API_URL') . '/collections/get/articles', [
            'headers' => [
                'Cockpit-Token' => env('COCKPIT_API_TOKEN')
            ]
        ]);

        $articles = json_decode($response->getBody(), true);

        // Render with Blade
        return view_blade('articles.index', [
            'articles' => $articles['entries'] ?? []
        ]);
    }
}
```

**Blade view** (`app/Views/articles/index.blade.php`):
```blade
@extends('layouts.master')

@section('title', 'Articles')

@section('content')
    <h1>Articles from Cockpit CMS</h1>

    @if(count($articles) > 0)
        @foreach($articles as $article)
            @include('components.card', [
                'title' => $article['title']
            ])
                <p>{{ $article['description'] }}</p>
                <a href="/articles/{{ $article['_id'] }}">Read more</a>
            @endinclude
        @endforeach
    @else
        <p>No articles found.</p>
    @endif
@endsection
```

## Custom Directives

You can create custom Blade directives for reusable logic:

```php
// In a controller or bootstrap file
blade()->directive('copyright', function () {
    return "<?php echo '&copy; ' . date('Y') . ' My Company'; ?>";
});
```

Use in views:
```blade
<footer>
    @copyright
</footer>
```

## Cache Management

Blade caches compiled views in `writable/cache/blade/`. To clear the cache:

```php
blade()->clearCache();
```

Or manually delete files in `writable/cache/blade/`.

## Features

- ✅ Full Blade syntax support
- ✅ Layouts and template inheritance
- ✅ Components and includes
- ✅ Custom directives
- ✅ Automatic escaping for security
- ✅ Compiled template caching for performance
- ✅ Seamless CI4 integration

## Resources

- [Laravel Blade Documentation](https://laravel.com/docs/blade)
- [jenssegers/blade GitHub](https://github.com/jenssegers/blade)
- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/)

## Troubleshooting

### Cache Issues

If views aren't updating, clear the Blade cache:
```php
blade()->clearCache();
```

### Permission Errors

Ensure `writable/cache/blade/` is writable:
```bash
chmod -R 755 writable/cache/blade/
```

### View Not Found

- Verify the view file exists in `app/Views/`
- Check the file has `.blade.php` extension
- Use dot notation or slashes: `view_blade('layouts.master')` or `view_blade('layouts/master')`
