@extends('layouts.master')

@section('title', 'About Us - CI4 + Cockpit + Blade')

@section('header', 'About Us')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Hero Section --}}
    <div class="hero bg-gradient-to-r from-primary to-secondary text-primary-content rounded-box mb-8">
        <div class="hero-content text-center py-12">
            <div class="max-w-2xl">
                <h1 class="text-5xl font-bold mb-4">About Our Project</h1>
                <p class="text-lg opacity-90">
                    A modern starter template combining the power of CodeIgniter 4, BladeOne templating,
                    daisyUI components, and Cockpit CMS.
                </p>
            </div>
        </div>
    </div>

    {{-- Mission Statement --}}
    <div class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h2 class="card-title text-3xl mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                </svg>
                Our Mission
            </h2>
            <p class="text-lg leading-relaxed">
                This starter project aims to provide developers with a robust foundation for building
                modern web applications. By combining CodeIgniter 4's lightweight framework with powerful
                templating and a headless CMS approach, we enable rapid development of scalable,
                API-driven applications with beautiful user interfaces.
            </p>
        </div>
    </div>

    {{-- Technology Stack --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title">
                    <div class="badge badge-primary">Backend</div>
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <strong>CodeIgniter 4</strong>
                            <p class="text-sm opacity-70">Lightweight PHP framework with excellent performance</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-2xl">⚡</span>
                        <div>
                            <strong>BladeOne</strong>
                            <p class="text-sm opacity-70">Powerful templating engine for clean, maintainable views</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-2xl">🚀</span>
                        <div>
                            <strong>Cockpit CMS</strong>
                            <p class="text-sm opacity-70">Headless CMS for flexible content management</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title">
                    <div class="badge badge-secondary">Frontend</div>
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="text-2xl">🎨</span>
                        <div>
                            <strong>daisyUI</strong>
                            <p class="text-sm opacity-70">Beautiful component library with pre-built UI elements</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-2xl">🎯</span>
                        <div>
                            <strong>Tailwind CSS v4</strong>
                            <p class="text-sm opacity-70">Utility-first CSS framework for rapid styling</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-2xl">🌓</span>
                        <div>
                            <strong>Dark Mode</strong>
                            <p class="text-sm opacity-70">Built-in theme switching with localStorage persistence</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Features Timeline --}}
    <div class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h2 class="card-title text-3xl mb-6">Key Features</h2>
            <ul class="timeline timeline-vertical">
                <li>
                    <div class="timeline-start timeline-box">
                        <strong>No Database Required</strong>
                        <p class="text-sm">All content is API-driven from Cockpit CMS</p>
                    </div>
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <hr class="bg-primary" />
                </li>
                <li>
                    <hr class="bg-primary" />
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="timeline-end timeline-box">
                        <strong>Built-in Caching</strong>
                        <p class="text-sm">CockpitService includes automatic API response caching</p>
                    </div>
                    <hr class="bg-primary" />
                </li>
                <li>
                    <hr class="bg-primary" />
                    <div class="timeline-start timeline-box">
                        <strong>Clean Architecture</strong>
                        <p class="text-sm">Services layer with WebController base class</p>
                    </div>
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <hr />
                </li>
                <li>
                    <hr />
                    <div class="timeline-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="timeline-end timeline-box">
                        <strong>Modern UI</strong>
                        <p class="text-sm">Responsive design with daisyUI components</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    {{-- Call to Action --}}
    <div class="alert alert-info shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <h3 class="font-bold">Ready to get started?</h3>
            <div class="text-sm">Check out the documentation to learn more about using this starter template.</div>
        </div>
        <div>
            <a href="/" class="btn btn-sm btn-primary">Go Home</a>
            <a href="/contact" class="btn btn-sm btn-ghost">Contact Us</a>
        </div>
    </div>
</div>
@endsection
