# CodeIgniter 4 + Cockpit CMS + Blade Starter

A modern starter template integrating **CodeIgniter 4**, **BladeOne templating**, and **Cockpit CMS** as a headless content management system.

## 🚀 Features

- **CodeIgniter 4** - Lightweight, fast PHP framework
- **BladeOne** - Powerful Blade templating engine (via `eftec/bladeone`)
- **daisyUI** - Beautiful UI components built on Tailwind CSS
- **Tailwind CSS v4** - Modern utility-first CSS framework
- **Cockpit CMS** - Headless CMS for flexible content management
- **API-Driven** - No local database required
- **Modern Stack** - PHP 8.1+, Composer-based dependencies

## 📋 What's Included

- ✅ Services layer for clean architecture
- ✅ WebController base class for web pages
- ✅ BladeOne templating engine fully integrated with CI4
- ✅ Example Blade layouts and components
- ✅ CockpitService with built-in caching

## 📦 Installation

### Requirements

- PHP 8.1 or higher
- Composer
- Node.js & npm (for Tailwind CSS and daisyUI)
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
   cp env.example .env
   ```

   Edit `.env` and configure:
   - `app.baseURL` - Your application URL
   - Cockpit CMS API settings (if using)

4. **Install frontend dependencies**
   ```bash
   npm install
   ```

5. **Build CSS (Tailwind + daisyUI)**
   ```bash
   npm run build:css
   ```

   Or watch for changes during development:
   ```bash
   npm run watch:css
   ```

6. **Set permissions**
   ```bash
   chmod -R 755 writable/
   ```

7. **Start development server**
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

class Home extends WebController
{
    public function index()
    {
        return $this->render('welcome', [
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

## 🎨 Styling with daisyUI

This starter includes **Tailwind CSS v4** and **daisyUI** for beautiful, responsive UI components.

### Using daisyUI Components

daisyUI provides pre-styled components that work out of the box:

```blade
{{-- Buttons --}}
<button class="btn btn-primary">Primary Button</button>
<button class="btn btn-secondary">Secondary</button>

{{-- Cards --}}
<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">Card Title</h2>
        <p>Card content goes here</p>
        <div class="card-actions justify-end">
            <button class="btn btn-primary">Action</button>
        </div>
    </div>
</div>

{{-- Hero Section --}}
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold">Hello there</h1>
            <p class="py-6">Beautiful UI with daisyUI components</p>
            <button class="btn btn-primary">Get Started</button>
        </div>
    </div>
</div>
```

### Theme Support

The starter includes automatic dark/light theme switching:
- Theme toggle in the navbar
- Persisted in localStorage
- Supports all daisyUI themes

### Development Workflow

1. **Watch CSS during development:**
   ```bash
   npm run watch:css
   ```

2. **Use daisyUI components in your Blade views**
3. **Apply Tailwind utilities for custom styling**

### Resources

- [daisyUI Components](https://daisyui.com/components/) - Component library
- [daisyUI Themes](https://daisyui.com/docs/themes/) - Pre-built themes
- [Tailwind CSS Docs](https://tailwindcss.com/docs) - Utility classes

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

class Articles extends WebController
{
    public function index()
    {
        // Fetch from Cockpit CMS using the CockpitService (with caching)
        $articles = $this->cockpit->getCollectionCached('articles', ['published' => true]);

        // Render with Blade
        return $this->render('articles.index', [
            'articles' => $articles
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
│   ├── Libraries/           # BladeView, CockpitService
│   └── ...
├── public/                  # Web root
│   ├── css/
│   │   ├── input.css        # Tailwind + daisyUI input
│   │   └── output.css       # Compiled CSS
│   └── index.php            # Application entry point
├── writable/
│   └── cache/blade/         # Blade compiled templates
├── vendor/                  # Composer dependencies
├── node_modules/            # NPM dependencies
├── .env                     # Environment configuration
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
├── tailwind.config.js       # Tailwind configuration
├── BLADE.md                 # Blade documentation
├── CLAUDE.md                # Project context (for AI)
└── README.md                # This file
```

## 🛠️ Development

### Blade Features Available

- Layouts and template inheritance (`@extends`, `@section`)
- Components and includes (`@include`, `@component`)
- Control structures (`@if`, `@foreach`, `@for`)
- Custom directives
- Automatic XSS protection
- Template caching for performance

### Services Layer

```php
use Config\Services;

// Get BladeView instance
$blade = Services::blade();
$blade->render('viewname', $data);

// Get CockpitService instance
$cockpit = Services::cockpit();
$data = $cockpit->getSingletonCached('homepage');

// Clear Blade cache
Services::blade()->clearCache();

// Add custom directive
Services::blade()->directive('datetime', function($expression) {
    return "<?php echo ($expression)->format('Y-m-d H:i'); ?>";
});
```

## 📚 Documentation

- **[BLADE.md](BLADE.md)** - Complete BladeOne integration guide
- **[CLAUDE.md](CLAUDE.md)** - Project context and AI instructions
- [CodeIgniter 4 User Guide](https://codeigniter.com/user_guide/)
- [BladeOne GitHub](https://github.com/EFTEC/BladeOne)
- [Laravel Blade Docs](https://laravel.com/docs/blade) (Syntax reference)
- [daisyUI Components](https://daisyui.com/components/) - UI component library
- [Tailwind CSS Docs](https://tailwindcss.com/docs) - Utility-first CSS
- [Cockpit CMS API](https://getcockpit.com/documentation/api)

## 🎯 Architecture

This project follows a **headless CMS architecture**:

1. **Cockpit CMS** - Manages content via API
2. **CodeIgniter 4** - Handles routing, business logic, API consumption
3. **Blade Templates** - Renders views with daisyUI components
4. **daisyUI + Tailwind** - Provides beautiful, responsive styling
5. **No Database** - All content comes from Cockpit API

```
┌─────────────┐      ┌──────────────┐      ┌──────────────┐      ┌─────────────┐
│             │      │              │      │              │      │             │
│ Cockpit CMS │─────▶│ CodeIgniter 4│─────▶│    Blade     │─────▶│   daisyUI   │
│    (API)    │ JSON │  (Controller)│ Data │  (Template)  │ HTML │   Styling   │
│             │      │              │      │              │      │             │
└─────────────┘      └──────────────┘      └──────────────┘      └─────────────┘
```

## 🔧 Configuration

### Important Files

- **`.env`** - Environment configuration
- **`app/Config/Services.php`** - Service definitions (blade, cockpit)
- **`app/Controllers/WebController.php`** - Base controller for web pages
- **`app/Libraries/BladeView.php`** - Blade integration library
- **`app/Libraries/CockpitService.php`** - Cockpit CMS API client with caching

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

**Built with** ❤️ **using CodeIgniter 4, BladeOne, daisyUI, and Cockpit CMS**
