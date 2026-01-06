# CodeIgniter 4 + Cockpit CMS + Blade Starter

A modern starter template integrating **CodeIgniter 4**, **BladeOne templating**, and **Cockpit CMS** as a headless content management system.

## 🚀 Features

- **CodeIgniter 4** - Lightweight, fast PHP framework
- **BladeOne** - Powerful Blade templating engine (via `eftec/bladeone`)
- **Cockpit CMS** - Headless CMS for flexible content management
- **Zero Dependencies** - BladeOne is standalone with no heavy packages
- **API-Driven** - No local database required
- **Modern Stack** - PHP 8.1+, Composer-based dependencies

## 📋 What's Included

- ✅ BladeOne templating engine fully integrated with CI4
- ✅ Helper functions for easy Blade rendering
- ✅ Example Blade layouts and components
- ✅ BladeView library for advanced usage
- ✅ Zero dependencies - single file implementation
- ✅ Optimized performance - compiles to native PHP
- ✅ Ready for Cockpit CMS API integration
- ✅ Auto-loaded Blade helper (`view_blade()`)

## 📦 Installation

### Requirements

- PHP 8.1 or higher
- Composer
- Required PHP extensions:
  - intl
  - mbstring
  - json
  - libcurl

### Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ci4-cockpit-starter
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp env .env
   ```

   Edit `.env` and configure:
   - `app.baseURL` - Your application URL
   - Cockpit CMS API settings (if using)

4. **Set permissions**
   ```bash
   chmod -R 755 writable/
   ```

5. **Start development server**
   ```bash
   php spark serve
   ```

   Visit: `http://localhost:8080`

## 🎨 Using Blade Templates

### Quick Start

**In your controller:**
```php
<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view_blade('welcome', [
            'title' => 'Welcome to CI4 + Blade',
            'items' => ['Feature 1', 'Feature 2', 'Feature 3']
        ]);
    }
}
```

**Create a Blade view** (`app/Views/welcome.blade.php`):
```blade
@extends('layouts.master')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <ul>
        @foreach($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
@endsection
```

### Blade Documentation

For complete Blade integration documentation, see **[BLADE.md](BLADE.md)**.

## 🌐 Cockpit CMS Integration

### Setup Cockpit Connection

Add to your `.env`:
```env
cockpit.apiUrl = https://your-cockpit-instance.com/api
cockpit.apiToken = your-api-token-here
```

### Example: Fetching Content from Cockpit

```php
<?php

namespace App\Controllers;

class Articles extends BaseController
{
    public function index()
    {
        // Fetch from Cockpit API
        $client = \Config\Services::curlrequest();
        $response = $client->get(env('cockpit.apiUrl') . '/collections/get/articles', [
            'headers' => [
                'Cockpit-Token' => env('cockpit.apiToken')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        // Render with Blade
        return view_blade('articles.index', [
            'articles' => $data['entries'] ?? []
        ]);
    }
}
```

**Blade view** (`app/Views/articles/index.blade.php`):
```blade
@extends('layouts.master')

@section('content')
    <h1>Articles</h1>

    @foreach($articles as $article)
        <article>
            <h2>{{ $article['title'] }}</h2>
            <p>{{ $article['excerpt'] }}</p>
        </article>
    @endforeach
@endsection
```

## 📁 Project Structure

```
ci4-cockpit-starter/
├── app/
│   ├── Config/              # Configuration files
│   ├── Controllers/         # Application controllers
│   ├── Views/               # Blade templates (*.blade.php)
│   │   ├── layouts/         # Master layouts
│   │   ├── components/      # Reusable components
│   │   └── welcome.blade.php
│   ├── Libraries/           # BladeView library
│   ├── Helpers/             # blade_helper.php
│   └── ...
├── public/                  # Web root
│   └── index.php           # Application entry point
├── writable/
│   └── cache/blade/        # Blade compiled templates
├── vendor/                  # Composer dependencies
├── .env                     # Environment configuration
├── composer.json            # Dependencies
├── BLADE.md                 # Blade documentation
├── CLAUDE.md                # Project context (for AI)
└── README.md               # This file
```

## 🛠️ Development

### Blade Features Available

- Layouts and template inheritance (`@extends`, `@section`)
- Components and includes (`@include`, `@component`)
- Control structures (`@if`, `@foreach`, `@for`)
- Custom directives
- Automatic XSS protection
- Template caching for performance

### Helper Functions

```php
// Render a Blade view
view_blade('viewname', $data);

// Get BladeView instance
blade()->render('viewname', $data);

// Clear Blade cache
blade()->clearCache();

// Add custom directive
blade()->directive('datetime', function($expression) {
    return "<?php echo ($expression)->format('Y-m-d H:i'); ?>";
});
```

## 📚 Documentation

- **[BLADE.md](BLADE.md)** - Complete BladeOne integration guide
- **[CLAUDE.md](CLAUDE.md)** - Project context and AI instructions
- [CodeIgniter 4 User Guide](https://codeigniter.com/user_guide/)
- [BladeOne GitHub](https://github.com/EFTEC/BladeOne)
- [Laravel Blade Docs](https://laravel.com/docs/blade) (Syntax reference)
- [Cockpit CMS API](https://getcockpit.com/documentation/api)

## 🎯 Architecture

This project follows a **headless CMS architecture**:

1. **Cockpit CMS** - Manages content via API
2. **CodeIgniter 4** - Handles routing, business logic, API consumption
3. **Blade Templates** - Renders beautiful views
4. **No Database** - All content comes from Cockpit API

```
┌─────────────┐      ┌──────────────┐      ┌─────────────┐
│             │      │              │      │             │
│ Cockpit CMS │─────▶│ CodeIgniter 4│─────▶│   Blade     │
│    (API)    │ JSON │  (Controller)│ Data │ (Template)  │
│             │      │              │      │             │
└─────────────┘      └──────────────┘      └─────────────┘
```

## 🔧 Configuration

### Important Files

- **`.env`** - Environment configuration
- **`app/Config/Autoload.php`** - Auto-loads Blade helper
- **`app/Libraries/BladeView.php`** - Blade integration library
- **`app/Helpers/blade_helper.php`** - Helper functions

## 🚨 Important Notes

- **No Database Required** - This starter doesn't use a local database
- **No Authentication** - This is a content display starter
- **API-Driven** - All data comes from Cockpit CMS
- **Blade Required** - All views should use `.blade.php` extension

## 🤝 Contributing

This is a starter template. Fork it, customize it, make it your own!

## 📄 License

MIT License - Feel free to use this starter for any project.

## 🆘 Support

- **Issues**: Check the CodeIgniter and BladeOne documentation
- **BladeOne Package**: [EFTEC/BladeOne](https://github.com/EFTEC/BladeOne)
- **CI4 Forum**: [forum.codeigniter.com](https://forum.codeigniter.com)

## 🎓 Learning Resources

- [CodeIgniter 4 Tutorial](https://codeigniter.com/user_guide/tutorial/index.html)
- [Blade Templates Guide](https://laravel.com/docs/blade)
- [Cockpit CMS Quickstart](https://getcockpit.com/documentation)

---

**Built with** ❤️ **using CodeIgniter 4, BladeOne, and Cockpit CMS**
