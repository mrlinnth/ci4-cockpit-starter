# Blade Templating Integration

This project uses **BladeOne** - a standalone, lightweight Blade templating engine via the [eftec/bladeone](https://github.com/EFTEC/BladeOne) package, integrated seamlessly with CodeIgniter 4.

## Package Information

- **Package**: `eftec/bladeone`
- **Version**: 4.19+
- **Compatibility**: CodeIgniter 4.x, PHP 8.1+
- **Dependencies**: ZERO (standalone single file)
- **Performance**: Compiles to native PHP for optimal speed
- **Maintenance**: Actively maintained (2025)

## Why BladeOne?

BladeOne was chosen over other Blade implementations for several key reasons:

- **Zero Dependencies**: No heavy Laravel Illuminate packages
- **Lightweight**: Single file implementation vs. 30+ packages
- **Better Performance**: Compiles to native PHP, faster execution
- **CI4 Philosophy**: Aligns with CodeIgniter's lightweight approach
- **Full Featured**: All Blade features (except dynamic components)
- **Smaller Footprint**: ~150KB vs. several MB

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

// Share data across all views
blade()->share('siteName', 'My Website');

// Set compile mode
use eftec\bladeone\BladeOne;
blade()->setMode(BladeOne::MODE_FAST); // Production mode

// Clear the Blade cache
blade()->clearCache();
```

## Compile Modes

BladeOne offers different compilation modes for different environments:

```php
use eftec\bladeone\BladeOne;

// MODE_AUTO (0) - Default: checks if compiled file has changed
blade()->setMode(BladeOne::MODE_AUTO);

// MODE_SLOW (1) - Development: always recompiles
blade()->setMode(BladeOne::MODE_SLOW);

// MODE_FAST (2) - Production: never recompiles
blade()->setMode(BladeOne::MODE_FAST);

// MODE_DEBUG (5) - Debug: always compiles with identifiable filenames
blade()->setMode(BladeOne::MODE_DEBUG);
```

The library automatically sets `MODE_FAST` in production and `MODE_AUTO` in development.

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
    @stack('styles')
</head>
<body>
    @yield('content')
    @stack('scripts')
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

@push('scripts')
    <script src="/js/custom.js"></script>
@endpush
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

@while($count < 10)
    <p>{{ $count++ }}</p>
@endwhile

{{-- Unless --}}
@unless($user->isGuest())
    <p>Welcome back!</p>
@endunless

{{-- Empty/Isset --}}
@empty($records)
    <p>No records found</p>
@endempty

@isset($name)
    <p>Name: {{ $name }}</p>
@endisset
```

### Including Views

```blade
@include('partials.header')

@include('partials.sidebar', ['menu' => $menuItems])

{{-- Include if exists --}}
@includeIf('partials.optional')

{{-- Include when condition is true --}}
@includeWhen($isAdmin, 'partials.admin')
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

{{-- Comment (not rendered) --}}
{{-- This is a Blade comment --}}
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
            @include('components.card', ['title' => $article['title']])
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

// Directive with parameters
blade()->directive('datetime', function ($expression) {
    return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
});
```

Use in views:
```blade
<footer>
    @copyright
</footer>

<p>Posted: @datetime($post->created_at)</p>
```

## Sharing Data Across Views

Share variables that should be available in all views:

```php
// In a controller or BaseController
blade()->share('appName', 'My Application');
blade()->share('currentYear', date('Y'));
```

Access in any view:
```blade
<h1>{{ $appName }}</h1>
<footer>&copy; {{ $currentYear }}</footer>
```

## Cache Management

BladeOne caches compiled views in `writable/cache/blade/`.

### Clear Cache Programmatically

```php
blade()->clearCache();
```

### Clear Cache Manually

```bash
rm -rf writable/cache/blade/*
```

### Cache Modes

- **Production**: Use `MODE_FAST` - never recompiles (fastest)
- **Development**: Use `MODE_AUTO` - checks if source changed (balanced)
- **Debugging**: Use `MODE_DEBUG` - always recompiles with readable names

## Important Notes

### Inline Arrays in @foreach

BladeOne may not handle multi-line inline arrays well. Use this pattern instead:

```blade
{{-- ✗ Avoid multi-line arrays --}}
@foreach([
    'item1',
    'item2'
] as $item)

{{-- ✓ Use single-line or PHP variable --}}
<?php $items = ['item1', 'item2', 'item3']; ?>
@foreach($items as $item)
    {{ $item }}
@endforeach
```

## Features

- ✅ Full Blade syntax support
- ✅ Layouts and template inheritance
- ✅ Components and includes
- ✅ Custom directives
- ✅ Automatic escaping for security
- ✅ Compiled template caching for performance
- ✅ Seamless CI4 integration
- ✅ Zero dependencies
- ✅ Lightweight footprint
- ✅ Production-ready modes

## Resources

- [BladeOne GitHub](https://github.com/EFTEC/BladeOne)
- [Laravel Blade Documentation](https://laravel.com/docs/blade) (Syntax reference)
- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/)

## Troubleshooting

### Cache Issues

If views aren't updating, clear the Blade cache:
```php
blade()->clearCache();
```

Or manually:
```bash
rm -rf writable/cache/blade/*
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

### Parsing Errors

If you encounter parse errors in compiled files:
- Avoid multi-line inline arrays in directives
- Check for mismatched `@section` / `@endsection` pairs
- Clear cache and try again

## Performance Tips

1. **Use MODE_FAST in production** - Disable automatic recompilation
2. **Minimize includes** - Each include adds overhead
3. **Cache API data** - Don't fetch on every request
4. **Use layouts wisely** - Avoid deep nesting
5. **Keep cache directory clean** - Old files won't auto-delete

## Migration from jenssegers/blade

If migrating from jenssegers/blade:

- BladeOne uses `run()` internally but our wrapper provides `render()`
- All Blade syntax remains the same
- Replace multi-line inline arrays in `@foreach`
- Custom directives work identically
- No other code changes needed
