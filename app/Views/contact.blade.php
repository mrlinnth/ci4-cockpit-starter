@extends('layouts.master')

@section('title', 'Contact Us - CI4 + Cockpit + Blade')

@section('header', 'Contact Us')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Hero Section --}}
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold mb-4">Get In Touch</h1>
        <p class="text-lg opacity-70">
            Have questions about this starter template? We'd love to hear from you.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Contact Form --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">Send us a message</h2>

                <form class="space-y-4">
                    {{-- Name Input --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Your Name</span>
                        </label>
                        <input type="text" placeholder="John Doe" class="input input-bordered" required />
                    </div>

                    {{-- Email Input --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email Address</span>
                        </label>
                        <input type="email" placeholder="john@example.com" class="input input-bordered" required />
                    </div>

                    {{-- Subject Input --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Subject</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Select a topic</option>
                            <option>General Inquiry</option>
                            <option>Technical Support</option>
                            <option>Feature Request</option>
                            <option>Bug Report</option>
                            <option>Other</option>
                        </select>
                    </div>

                    {{-- Message Textarea --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Message</span>
                        </label>
                        <textarea class="textarea textarea-bordered h-32" placeholder="Your message here..." required></textarea>
                        <label class="label">
                            <span class="label-text-alt">Your message will help us assist you better</span>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="space-y-6">
            {{-- Contact Methods --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4">Contact Information</h2>

                    <div class="space-y-4">
                        {{-- Email --}}
                        <div class="flex items-start gap-4">
                            <div class="avatar placeholder">
                                <div class="bg-primary text-primary-content rounded-full w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold">Email</h3>
                                <p class="text-sm opacity-70">contact@example.com</p>
                                <p class="text-sm opacity-70">support@example.com</p>
                            </div>
                        </div>

                        {{-- GitHub --}}
                        <div class="flex items-start gap-4">
                            <div class="avatar placeholder">
                                <div class="bg-secondary text-secondary-content rounded-full w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold">GitHub</h3>
                                <p class="text-sm opacity-70">github.com/mrlinnth/ci4-cockpit-starter</p>
                                <a href="https://github.com/mrlinnth/ci4-cockpit-starter" class="link link-primary text-sm" target="_blank">View Repository</a>
                            </div>
                        </div>

                        {{-- Documentation --}}
                        <div class="flex items-start gap-4">
                            <div class="avatar placeholder">
                                <div class="bg-accent text-accent-content rounded-full w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold">Documentation</h3>
                                <p class="text-sm opacity-70">Check out our comprehensive docs</p>
                                <a href="https://github.com/mrlinnth/ci4-cockpit-starter#readme" class="link link-primary text-sm" target="_blank">Read Documentation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAQ Card --}}
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4">Quick Help</h2>

                    <div class="join join-vertical w-full">
                        <div class="collapse collapse-arrow join-item border border-base-300">
                            <input type="radio" name="faq-accordion" />
                            <div class="collapse-title font-medium">
                                How do I get started?
                            </div>
                            <div class="collapse-content">
                                <p class="text-sm opacity-70">Follow the installation guide in the README.md file. Make sure you have PHP 8.1+, Composer, and Node.js installed.</p>
                            </div>
                        </div>

                        <div class="collapse collapse-arrow join-item border border-base-300">
                            <input type="radio" name="faq-accordion" />
                            <div class="collapse-title font-medium">
                                Do I need a database?
                            </div>
                            <div class="collapse-content">
                                <p class="text-sm opacity-70">No! This starter uses Cockpit CMS as a headless CMS, so all content comes from the API. No local database is required.</p>
                            </div>
                        </div>

                        <div class="collapse collapse-arrow join-item border border-base-300">
                            <input type="radio" name="faq-accordion" />
                            <div class="collapse-title font-medium">
                                Can I customize the design?
                            </div>
                            <div class="collapse-content">
                                <p class="text-sm opacity-70">Absolutely! The project uses daisyUI and Tailwind CSS, making it easy to customize colors, themes, and components.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            <div class="card bg-gradient-to-r from-primary to-secondary text-primary-content shadow-xl">
                <div class="card-body text-center">
                    <h3 class="card-title justify-center text-xl">Connect with us</h3>
                    <p class="opacity-90 text-sm">Follow for updates and news</p>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="btn btn-circle btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-circle btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Info Alert --}}
    <div class="alert shadow-lg mt-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <h3 class="font-bold">Note</h3>
            <div class="text-sm">This is a demo contact form. In a production environment, you would integrate it with your backend API or email service.</div>
        </div>
    </div>
</div>
@endsection
