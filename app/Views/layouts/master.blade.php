<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CI4 + Cockpit CMS Starter')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        header h1 {
            font-size: 1.5rem;
        }
        main {
            min-height: calc(100vh - 200px);
        }
        footer {
            background: #34495e;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <h1>@yield('header', 'CodeIgniter 4 + Cockpit CMS + Blade')</h1>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} CI4 Cockpit Starter | Powered by Blade Templating</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
