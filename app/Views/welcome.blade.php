@extends('layouts.master')

@section('title', 'Welcome to CI4 + Cockpit + Blade')

@section('header', 'Welcome to CodeIgniter 4 + Cockpit CMS')

@section('content')
<div style="text-align: center; padding: 3rem 0;">
    <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #2c3e50;">
        🚀 Blade Templating Enabled!
    </h2>
    <p style="font-size: 1.2rem; color: #7f8c8d; margin-bottom: 2rem;">
        Your CodeIgniter 4 + Cockpit CMS starter is now powered by Laravel Blade templating engine
    </p>

    <div style="max-width: 800px; margin: 0 auto; text-align: left;">
        <h3 style="margin: 2rem 0 1rem; color: #34495e;">Features</h3>
        <ul style="list-style: none; padding: 0;">
            <?php $features = ['BladeOne templating engine (EFTEC)', 'CodeIgniter 4 framework', 'Cockpit CMS integration ready', 'Blade layouts and components support', 'Custom Blade directives available', 'No database required - API-driven content']; ?>
            @foreach($features as $feature)
                <li style="padding: 0.5rem 0; border-bottom: 1px solid #ecf0f1;">
                    ✓ {{ $feature }}
                </li>
            @endforeach
        </ul>

        <h3 style="margin: 2rem 0 1rem; color: #34495e;">Quick Start</h3>
        <div style="background: #ecf0f1; padding: 1.5rem; border-radius: 5px;">
            <h4 style="margin-bottom: 0.5rem;">In your controller:</h4>
            <pre style="background: #2c3e50; color: #ecf0f1; padding: 1rem; border-radius: 3px; overflow-x: auto;"><code>public function index()
{
    return view_blade('welcome', [
        'title' => 'My Page',
        'data' => $cockpitData
    ]);
}</code></pre>

            <h4 style="margin: 1.5rem 0 0.5rem;">Or use the BladeView library:</h4>
            <pre style="background: #2c3e50; color: #ecf0f1; padding: 1rem; border-radius: 3px; overflow-x: auto;"><code>$blade = new \App\Libraries\BladeView();
echo $blade->render('welcome', $data);</code></pre>
        </div>

        <h3 style="margin: 2rem 0 1rem; color: #34495e;">Documentation</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 0.5rem 0;">
                <a href="https://laravel.com/docs/blade" style="color: #3498db; text-decoration: none;">
                    📖 Laravel Blade Documentation
                </a>
            </li>
            <li style="padding: 0.5rem 0;">
                <a href="https://codeigniter.com/user_guide/" style="color: #3498db; text-decoration: none;">
                    📖 CodeIgniter 4 User Guide
                </a>
            </li>
            <li style="padding: 0.5rem 0;">
                <a href="https://getcockpit.com/documentation/api" style="color: #3498db; text-decoration: none;">
                    📖 Cockpit CMS API Documentation
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@push('styles')
<style>
    a {
        color: #3498db;
        text-decoration: none;
        transition: color 0.3s;
    }
    a:hover {
        color: #2980b9;
        text-decoration: underline;
    }
</style>
@endpush
