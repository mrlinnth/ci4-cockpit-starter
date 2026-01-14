# CodeIgniter 4 + Cockpit CMS + Blade Starter

A modern starter template integrating **CodeIgniter 4**, **BladeOne templating**, and **Cockpit CMS** as a headless content management system.

---

## Quick Start

```bash
# Clone and setup
git clone <repository-url> && cd ci4-cockpit-starter
composer install

# Configure environment
cp env.example .env
# Edit .env with your settings

# Install frontend dependencies
npm install

# Build CSS
npm run build:css

# Set permissions
chmod -R 755 writable/

# Start server
php spark serve
```

Visit: `http://localhost:8080`

---

## Features

### Core Technologies
- **CodeIgniter 4** - Lightweight, fast PHP framework
- **BladeOne** - Powerful Blade templating engine (via `eftec/bladeone`)
- **Cockpit CMS** - Headless CMS for flexible content management

### Frontend Stack
- **Tailwind CSS v4** - Modern utility-first CSS framework
- **daisyUI** - Beautiful UI components built on Tailwind CSS
- **API-Driven** - No local database required

### Developer Experience
- **PHP 8.1+** - Modern PHP with Composer-based dependencies
- **Services Layer** - Clean architecture with service classes
- **Built-in Caching** - Optimized Cockpit API calls
- **Theme Support** - Automatic dark/light theme switching

---

## What's Included

- ✅ `WebController` base class for web pages
- ✅ `BladeView` service with CI4 integration
- ✅ `CockpitService` with built-in caching
- ✅ Example Blade layouts and components
- ✅ Pre-configured Tailwind CSS + daisyUI
- ✅ Environment-based configuration

---

## Installation

### Requirements

- Running Cockpit CMS and API Key
- PHP 8.1 or higher
- Composer
- Node.js & npm (for Tailwind CSS and daisyUI)
- Required PHP extensions: `intl`, `mbstring`, `json`, `libcurl`

### Detailed Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ci4-cockpit-starter
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp env.example .env
   ```
   
   Edit `.env` and configure:
   - `app.baseURL` - Your application URL
   - Cockpit CMS API settings

4. **Install frontend dependencies**
   ```bash
   npm install
   ```

5. **Build CSS (Tailwind + daisyUI)**
   ```bash
   npm run build:css
   ```
   
   For development with auto-reload:
   ```bash
   npm run watch:css
   ```

6. **Set writable permissions**
   ```bash
   chmod -R 755 writable/
   ```

7. **Start development server**
   ```bash
   php spark serve
   ```

---

## Using Blade Templates

### Basic Example

**Controller** (`app/Controllers/Home.php`):
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

**View** (`app/Views/welcome.blade.php`):
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

### Available Features

- Template inheritance (`@extends`, `@section`)
- Components and includes (`@include`, `@component`)
- Control structures (`@if`, `@foreach`, `@for`)
- Custom directives
- Automatic XSS protection
- Template caching

> For complete Blade documentation, see **[BLADE.md](BLADE.md)**

---

## Styling with daisyUI

### Quick Examples

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

{{-- Hero --}}
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

- Automatic dark/light theme toggle
- Persisted in localStorage
- Supports all daisyUI themes

### Development Workflow

1. Watch CSS during development: `npm run watch:css`
2. Use daisyUI components in your Blade views
3. Apply Tailwind utilities for custom styling

### Resources

- [daisyUI Components](https://daisyui.com/components/)

---

## Cockpit CMS Integration

### Configuration

Add to your `.env`:
```env
# The base URL of your Cockpit CMS instance
# Without trailing slash
cockpit.apiUrl = https://your-cockpit-instance.com
cockpit.apiToken = your-api-token-here
```

### Example Usage

**Controller** (`app/Controllers/Articles.php`):
```php
<?php

namespace App\Controllers;

class Articles extends WebController
{
    public function index()
    {
        // Fetch from Cockpit CMS (with caching)
        $articles = $this->cockpit->getCollectionCached('articles', ['published' => true]);
        
        return $this->render('articles.index', [
            'articles' => $articles
        ]);
    }
}
```

**View** (`app/Views/articles/index.blade.php`):
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

---

## Project Structure

```
ci4-cockpit-starter/
├── app/
│   ├── Config/              # Configuration files
│   │   ├── Routes.php       # Application Routes
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
├── .env.example             # Environment configuration
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
├── tailwind.config.js       # Tailwind configuration
├── BLADE.md                 # Blade documentation
├── CLAUDE.md                # Project context
└── README.md                # This file
```

---

## Architecture

```
┌─────────────┐      ┌──────────────┐      ┌──────────────┐      ┌─────────────┐
│             │      │              │      │              │      │             │
│ Cockpit CMS │─────▶│ CodeIgniter 4│─────▶│    Blade     │─────▶│   daisyUI   │
│    (API)    │ JSON │  (Controller)│ Data │  (Template)  │ HTML │   Styling   │
│             │      │              │      │              │      │             │
└─────────────┘      └──────────────┘      └──────────────┘      └─────────────┘
```

**Flow:**
1. **Cockpit CMS** - Manages content via API
2. **CodeIgniter 4** - Handles routing, business logic, API consumption
3. **Blade Templates** - Renders views with daisyUI components
4. **daisyUI + Tailwind** - Provides beautiful, responsive styling

**Key Principles:**
- No local database required
- API-driven architecture
- Content managed externally
- Clean separation of concerns

---

## Development

### Services Layer

```php
use Config\Services;

// BladeView service
$blade = Services::blade();
$blade->render('viewname', $data);

// CockpitService with caching
$cockpit = Services::cockpit();
$data = $cockpit->getSingletonCached('homepage');

// Clear Blade cache
Services::blade()->clearCache();

// Custom directives
Services::blade()->directive('datetime', function($expression) {
    return "<?php echo ($expression)->format('Y-m-d H:i'); ?>";
});
```

### Important Configuration Files

- **`.env`** - Environment configuration
- **`app/Config/Routes.php`** - Application routes
- **`app/Config/Services.php`** - Service definitions
- **`app/Controllers/WebController.php`** - Base controller
- **`app/Libraries/BladeView.php`** - Blade integration
- **`app/Libraries/CockpitService.php`** - Cockpit API client

---

## Documentation

### Internal Documentation
- **[BLADE.md](BLADE.md)** - Complete BladeOne integration guide
- **[CLAUDE.md](CLAUDE.md)** - Project context and AI instructions

### External Resources
- [CodeIgniter 4 User Guide](https://codeigniter.com/user_guide/)
- [BladeOne GitHub](https://github.com/EFTEC/BladeOne)
- [Laravel Blade Docs](https://laravel.com/docs/blade)
- [daisyUI Components](https://daisyui.com/components/)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Cockpit CMS API](https://getcockpit.com/documentation/api)

---

## Contributing

This is a starter template. Fork it, customize it, and make it your own!

---

## License

MIT License - Feel free to use this starter for any project.

---

## Support

- **Issues**: Check the CodeIgniter and BladeOne documentation
- **BladeOne Package**: [EFTEC/BladeOne](https://github.com/EFTEC/BladeOne)
- **CI4 Forum**: [forum.codeigniter.com](https://forum.codeigniter.com)

---

**Built with** ❤️ **using CodeIgniter 4, BladeOne, daisyUI, and Cockpit CMS**
