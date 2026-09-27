<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'kh' ? 'km' : 'en' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() === 'kh' ? (($settings?->groom_name_kh ?: __('messages.wedding_celebration')) . ' និង ' . ($settings?->bride_name_kh ?: __('messages.wedding_celebration'))) : (($settings?->groom_name_en ?: __('messages.wedding_celebration')) . ' & ' . ($settings?->bride_name_en ?: __('messages.wedding_celebration'))) }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,300..700;1,300..700&family=Moul&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha384-iw3OoTErCYJJB9mCa8LNS2hbsQ7M3C0EpIsO/H5+EGAkPGc6rk+V8i04oW/K5xq0" crossorigin="anonymous">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            100: '#fef9c3',
                            300: '#fde047',
                            400: '#eab308',
                            500: '#d4af37',
                            600: '#b8860b',
                            700: '#996515',
                        },
                        equinox: {
                            orange: '#e65c00',
                            gold: '#F9D423',
                            amber: '#d97706',
                            dusk: '#2b1055'
                        },
                        burgundy: {
                            500: '#a31621',
                            700: '#800020',
                            900: '#4a0011',
                        },
                        cream: '#FFFDF9',
                        sand: '#F7F3E9'
                    },
                    fontFamily: {
                        khmerHead: ['Moul', 'serif'],
                        khmerBody: ['"Kantumruy Pro"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif']
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --primary-color: #D4AF37;
            --secondary-color: #8B0000;
        }

        .text-gold-100,
        .text-gold-300,
        .text-gold-400,
        .text-gold-500,
        .text-gold-600,
        .text-gold-700 {
            color: var(--primary-color) !important
        }

        .bg-gold-100,
        .bg-gold-300,
        .bg-gold-400,
        .bg-gold-500,
        .bg-gold-600,
        .bg-gold-700 {
            background-color: var(--primary-color) !important
        }

        .border-gold-400,
        .border-gold-500,
        .border-gold-600,
        .border-gold-700 {
            border-color: var(--primary-color) !important
        }

        .text-burgundy-500,
        .text-burgundy-700,
        .text-burgundy-800,
        .text-burgundy-900 {
            color: var(--secondary-color) !important
        }

        .bg-burgundy-500,
        .bg-burgundy-700,
        .bg-burgundy-800,
        .bg-burgundy-900 {
            background-color: var(--secondary-color) !important
        }

        .border-burgundy-700,
        .border-burgundy-900 {
            border-color: var(--secondary-color) !important
        }

        #rsvp .bg-white,
        #wishesContainer {
            color: #2D2727;
        }

        #rsvp .bg-white .text-stone-500,
        #rsvp .bg-white .text-stone-600,
        #rsvp .bg-white .text-stone-700,
        #rsvp .bg-white .text-burgundy-700,
        #rsvp .bg-white .text-burgundy-800,
        #rsvp .bg-white .text-burgundy-900,
        #wishesContainer .text-stone-500,
        #wishesContainer .text-stone-600,
        #wishesContainer .text-stone-700,
        #wishesContainer .text-burgundy-700,
        #wishesContainer .text-burgundy-800,
        #wishesContainer .text-burgundy-900 {
            color: #352D25 !important;
        }

        body {
            font-family: 'Kantumruy Pro', sans-serif;
            background-color: #FFFDF9;
            color: #2D2727;
            overflow-x: hidden;
        }

        .equinox-gradient-text {
            background: linear-gradient(135deg, #F9D423 0%, #e65c00 50%, #bf953f 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Canvas Overlay for Romduol Flowers */
        #romduol-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 40;
        }

        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #FFFDF9;
        }

        ::-webkit-scrollbar-thumb {
            background: #d4af37;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #800020;
        }

        /* Angkor Sunrise Hero Backdrop Styling */
        .angkor-hero-bg {
            isolation: isolate;
            background: linear-gradient(to bottom, rgba(43, 16, 85, 0.45), rgba(230, 92, 0, 0.60), rgba(255, 253, 249, 1)),
                var(--wedding-background, url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=2000&q=80'));
            background-size: var(--background-size, cover);
            background-position: center bottom;
            background-repeat: var(--background-repeat, no-repeat);
            background-attachment: var(--background-attachment, scroll);
        }

        .angkor-hero-bg[data-background-style="fixed_blur"]::before {
            content: "";
            position: absolute;
            inset: -8px;
            z-index: -1;
            background-image: var(--wedding-background, url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=2000&q=80'));
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            filter: blur(5px);
        }

        .angkor-hero-bg[data-background-style="contain"] {
            --background-size: contain;
            --background-repeat: no-repeat
        }

        .angkor-hero-bg[data-background-style="repeat"] {
            --background-size: auto;
            --background-repeat: repeat
        }

        .angkor-hero-bg[data-background-style="fixed_blur"] {
            --background-size: cover;
            --background-attachment: fixed
        }

        .gift-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 220ms ease;
        }

        .gift-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }

        dialog.gift-overlay::backdrop {
            background: transparent;
        }

        .gift-dialog {
            opacity: 0;
            transform: translateY(14px) scale(0.985);
            transition: opacity 220ms ease, transform 220ms ease;
        }

        .gift-overlay.is-open .gift-dialog {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .music-equalizer {
            display: none;
            height: 18px;
            align-items: center;
            gap: 2px;
        }

        .music-equalizer span {
            width: 3px;
            height: 5px;
            border-radius: 2px;
            background: currentColor;
            transform-origin: center;
        }

        #audioToggle.is-playing .music-equalizer {
            display: flex;
        }

        #audioToggle.is-playing #audioIcon {
            display: none;
        }

        #audioToggle.is-playing .music-equalizer span {
            animation: equalize 700ms ease-in-out infinite alternate;
        }

        #audioToggle.is-playing .music-equalizer span:nth-child(2) {
            animation-delay: 180ms;
        }

        #audioToggle.is-playing .music-equalizer span:nth-child(3) {
            animation-delay: 360ms;
        }

        @keyframes equalize {
            to {
                transform: scaleY(2.8);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .gift-overlay,
            .gift-dialog {
                transition: none;
            }

            .music-equalizer span {
                animation: none !important;
            }
        }
    </style>
</head>

<body class="relative bg-cream text-stone-800" data-primary-color="{{ $settings?->primary_color ?: '#D4AF37' }}" data-secondary-color="{{ $settings?->secondary_color ?: '#8B0000' }}">

    <canvas id="romduol-canvas" data-flower-style="{{ $settings?->flower_effect_style ?: 'rumdul_gold' }}"></canvas>

    <!-- Floating Traditional Audio Control Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button id="audioToggle" type="button" aria-label="{{ __('messages.play_music') }}" data-play-label="{{ __('messages.play_music') }}" data-pause-label="{{ __('messages.pause_music') }}" aria-pressed="false" class="flex items-center justify-center w-14 h-14 bg-burgundy-700 text-gold-300 rounded-full shadow-2xl border-2 border-gold-400 hover:scale-110 transition duration-300 group focus:outline-none" title="{{ __('messages.play_music') }}">
            <i id="audioIcon" class="fas fa-music text-xl group-hover:rotate-12 transition"></i>
            <span class="music-equalizer" aria-hidden="true"><span></span><span></span><span></span></span>
        </button>
    </div>
    <audio id="bgMusic" loop preload="metadata" src="{{ asset($settings?->background_audio_file ?: 'audio/wedding-song.mp3') }}"></audio>

    <button id="giftOpen" type="button" class="fixed bottom-6 left-4 md:left-6 z-50 inline-flex max-w-[calc(100vw-6rem)] items-center gap-2 rounded-full border-2 border-gold-400 bg-burgundy-700 px-4 py-3 text-sm md:text-base font-semibold text-gold-100 shadow-xl transition hover:bg-burgundy-900 focus:outline-none focus:ring-4 focus:ring-gold-300/60 animate-pulse" aria-haspopup="dialog" aria-controls="giftModal">
        <i class="fas fa-gift text-gold-300" aria-hidden="true"></i>
        <span>{{ __('messages.gift_button') }}</span>
    </button>

    <nav class="fixed top-0 left-0 w-full bg-cream/90 backdrop-blur-md z-40 border-b border-gold-500/30 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="font-khmerHead text-burgundy-700 text-base md:text-xl flex items-center gap-2">
                @if ($settings?->wedding_logo)<img src="{{ asset($settings->wedding_logo) }}" alt="{{ __('messages.wedding_celebration') }}" class="h-10 max-w-24 object-contain">@else<span class="text-equinox-amber text-2xl">❖</span>@endif {{ __('messages.wedding_celebration') }}
            </a>
            <div class="hidden lg:flex space-x-6 text-sm font-medium text-stone-700">
                <a href="#home" class="hover:text-burgundy-700 transition">{{ __('messages.nav_home') }}</a>
                <a href="#story" class="hover:text-burgundy-700 transition">{{ __('messages.nav_story') }}</a>
                <a href="#schedule" class="hover:text-burgundy-700 transition">{{ __('messages.nav_schedule') }}</a>
                <a href="#gallery" class="hover:text-burgundy-700 transition">{{ __('messages.nav_gallery') }}</a>
                <a href="#rsvp" class="hover:text-burgundy-700 transition">{{ __('messages.nav_rsvp') }}</a>
                <a href="#location" class="hover:text-burgundy-700 transition">{{ __('messages.nav_location') }}</a>
            </div>
            <div class="flex shrink-0 items-center gap-1" aria-label="{{ __('messages.switch_language') }}">
                <a href="{{ route('lang.switch', ['locale' => 'kh']) }}" class="rounded border px-2 py-1 text-xs {{ app()->getLocale() === 'kh' ? 'border-burgundy-700 bg-burgundy-700 text-white' : 'border-stone-300 text-stone-700' }}" @if (app()->getLocale() === 'kh') aria-current="true" @endif>ខ្មែរ</a>
                <a href="{{ route('lang.switch', ['locale' => 'en']) }}" class="rounded border px-2 py-1 text-xs {{ app()->getLocale() === 'en' ? 'border-burgundy-700 bg-burgundy-700 text-white' : 'border-stone-300 text-stone-700' }}" @if (app()->getLocale() === 'en') aria-current="true" @endif>EN</a>
            </div>
            <button id="menuBtn" class="lg:hidden text-burgundy-700 focus:outline-none" aria-label="{{ __('messages.open_menu') }}">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        <div id="mobileMenu" class="hidden lg:hidden bg-cream border-t border-gold-500/20 px-6 py-4 flex flex-col space-y-3 font-medium">
            <a href="#home" class="mobile-link text-stone-700 hover:text-burgundy-700">{{ __('messages.nav_home') }}</a>
            <a href="#story" class="mobile-link text-stone-700 hover:text-burgundy-700">{{ __('messages.nav_story') }}</a>
            <a href="#schedule" class="mobile-link text-stone-700 hover:text-burgundy-700">{{ __('messages.nav_schedule') }}</a>
            <a href="#gallery" class="mobile-link text-stone-700 hover:text-burgundy-700">{{ __('messages.nav_gallery') }}</a>
            <a href="#rsvp" class="mobile-link text-stone-700 hover:text-burgundy-700">{{ __('messages.nav_rsvp') }}</a>
            <a href="#location" class="mobile-link text-stone-700 hover:text-burgundy-700">{{ __('messages.nav_location') }}</a>
        </div>
    </nav>

    <section id="home" class="relative min-h-screen pt-24 pb-16 flex flex-col justify-center items-center text-center px-4 angkor-hero-bg" data-background-style="{{ $settings?->force_background_style ?: 'cover' }}" data-background-image="{{ $settings?->background_image ? asset($settings->background_image) : '' }}">

        <!-- Angkor Wat Sunrise Silhouette SVG Graphic Decorative Motifs -->
        <div class="w-full max-w-xl mx-auto mb-2 opacity-90">
            <svg viewBox="0 0 500 120" class="w-full h-auto text-gold-300 fill-current drop-shadow-md">
                <path d="M 250 10 L 260 40 L 255 40 L 265 60 L 245 60 L 250 40 Z" opacity="0.9" />
                <path d="M 210 30 L 220 55 L 215 55 L 222 75 L 205 75 Z" opacity="0.8" />
                <path d="M 290 30 L 300 55 L 295 55 L 302 75 L 285 75 Z" opacity="0.8" />
                <path d="M 170 50 L 178 70 L 165 70 Z" opacity="0.7" />
                <path d="M 330 50 L 338 70 L 325 70 Z" opacity="0.7" />
                <rect x="150" y="70" width="200" height="15" rx="2" />
                <circle cx="250" cy="35" r="28" class="text-equinox-gold fill-current opacity-40 animate-pulse" />
                <path d="M 50 85 Q 250 70 450 85" stroke="#F9D423" stroke-width="2" fill="none" />
            </svg>
        </div>

        <div class="bg-black/30 backdrop-blur-sm p-6 md:p-10 rounded-3xl border border-gold-400/40 shadow-2xl max-w-3xl w-full">
            @if ($settings?->wedding_logo)<img src="{{ asset($settings->wedding_logo) }}" alt="Wedding logo" class="mx-auto mb-5 max-h-24 max-w-48 object-contain">@endif
            <p class="font-khmerHead text-gold-300 text-base md:text-xl tracking-wide mb-2">{{ __('messages.wedding_greeting') }}</p>
            <h1 class="font-khmerHead text-3xl md:text-5xl lg:text-6xl text-white mb-2 leading-relaxed drop-shadow-md">
                {{ app()->getLocale() === 'kh' ? (($settings?->groom_name_kh ?: 'ឈ្មោះកូនប្រុស') . ' និង ' . ($settings?->bride_name_kh ?: 'ឈ្មោះកូនក្រមុំ')) : (($settings?->groom_name_en ?: 'Groom') . ' & ' . ($settings?->bride_name_en ?: 'Bride')) }}
            </h1>
            <p class="font-serif italic text-gold-300 text-xl md:text-3xl mb-6">{{ __('messages.invitation_short') }}</p>

            <p class="text-stone-100 max-w-xl mx-auto text-sm md:text-base leading-relaxed mb-8 font-light">
                {{ __('messages.invitation_text') }}
            </p>

            <div class="inline-block border-y-2 border-gold-400 py-3 px-8 mb-8 bg-black/20 rounded-lg">
                <p class="font-khmerHead text-lg md:text-xl text-gold-300">{{ app()->getLocale() === 'kh' ? ($settings?->wedding_date_kh ?: ($settings?->wedding_datetime?->translatedFormat('l, j F Y') ?? __('messages.wedding_date'))) : ($settings?->wedding_datetime?->translatedFormat('l, j F Y') ?? __('messages.wedding_date')) }}</p>
                <p class="text-xs md:text-sm text-stone-200 font-serif tracking-widest uppercase mt-1">{{ $settings?->location_name ?: 'Cambodia' }}</p>
            </div>

            <div id="countdown" data-date="{{ $weddingDate ?? '' }}" data-finished-message="{{ __('messages.wedding_started') }}" class="grid grid-cols-4 gap-2 md:gap-4 max-w-md mx-auto">
                <div class="bg-cream/90 backdrop-blur p-3 rounded-xl shadow-md border border-gold-500/30">
                    <span id="days" class="block font-serif text-2xl md:text-3xl font-bold text-burgundy-700">00</span>
                    <span class="text-[11px] md:text-xs text-stone-600 font-khmerBody">{{ __('messages.days') }}</span>
                </div>
                <div class="bg-cream/90 backdrop-blur p-3 rounded-xl shadow-md border border-gold-500/30">
                    <span id="hours" class="block font-serif text-2xl md:text-3xl font-bold text-burgundy-700">00</span>
                    <span class="text-[11px] md:text-xs text-stone-600 font-khmerBody">{{ __('messages.hours') }}</span>
                </div>
                <div class="bg-cream/90 backdrop-blur p-3 rounded-xl shadow-md border border-gold-500/30">
                    <span id="minutes" class="block font-serif text-2xl md:text-3xl font-bold text-burgundy-700">00</span>
                    <span class="text-[11px] md:text-xs text-stone-600 font-khmerBody">{{ __('messages.minutes') }}</span>
                </div>
                <div class="bg-cream/90 backdrop-blur p-3 rounded-xl shadow-md border border-gold-500/30">
                    <span id="seconds" class="block font-serif text-2xl md:text-3xl font-bold text-burgundy-700">00</span>
                    <span class="text-[11px] md:text-xs text-stone-600 font-khmerBody">{{ __('messages.seconds') }}</span>
                </div>
            </div>
        </div>

        <a href="#story" class="mt-8 animate-bounce text-gold-400 hover:text-white transition">
            <i class="fas fa-chevron-down text-2xl"></i>
        </a>
    </section>

    <section id="story" class="py-20 px-4 bg-cream">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-khmerHead text-2xl md:text-4xl text-burgundy-700 mb-2">{{ __('messages.couple') }}</h2>
                <div class="w-24 h-1 bg-equinox-amber mx-auto rounded-full mb-3"></div>
                <p class="font-serif italic text-gold-700">{{ __('messages.couple_profile') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-gold-500/30 shadow-lg text-center hover:shadow-xl transition group">
                    <div class="relative w-48 h-48 md:w-56 md:h-56 mx-auto mb-6 rounded-full overflow-hidden border-4 border-gold-500 p-1 bg-gradient-to-tr from-equinox-gold via-cream to-burgundy-700">
                        <img src="{{ $settings?->groom_photo ? asset($settings->groom_photo) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $settings?->groom_name_en ?: 'Groom' }}" class="w-full h-full object-cover rounded-full group-hover:scale-105 transition duration-500">
                    </div>
                    <h3 class="font-khmerHead text-xl text-burgundy-700 mb-1">{{ app()->getLocale() === 'kh' ? ($settings?->groom_name_kh ?: 'ឈ្មោះកូនប្រុស') : ($settings?->groom_name_en ?: 'Groom') }}</h3>
                    <p class="text-xs text-stone-500 mb-4">{{ __('messages.groom') }}</p>
                    @if ($settings?->groom_bio_text || $settings?->groom_bio)<p class="text-sm text-stone-600 leading-relaxed font-light">{{ $settings->groom_bio_text ?: $settings->groom_bio }}</p>@endif
                </div>

                <div class="bg-white p-6 md:p-8 rounded-2xl border border-gold-500/30 shadow-lg text-center hover:shadow-xl transition group">
                    <div class="relative w-48 h-48 md:w-56 md:h-56 mx-auto mb-6 rounded-full overflow-hidden border-4 border-gold-500 p-1 bg-gradient-to-tr from-equinox-gold via-cream to-burgundy-700">
                        <img src="{{ $settings?->bride_photo ? asset($settings->bride_photo) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $settings?->bride_name_en ?: 'Bride' }}" class="w-full h-full object-cover rounded-full group-hover:scale-105 transition duration-500">
                    </div>
                    <h3 class="font-khmerHead text-xl text-burgundy-700 mb-1">{{ app()->getLocale() === 'kh' ? ($settings?->bride_name_kh ?: 'ឈ្មោះកូនស្រី') : ($settings?->bride_name_en ?: 'Bride') }}</h3>
                    <p class="text-xs text-stone-500 mb-4">{{ __('messages.bride') }}</p>
                    @if ($settings?->bride_bio_text || $settings?->bride_bio)<p class="text-sm text-stone-600 leading-relaxed font-light">{{ $settings->bride_bio_text ?: $settings->bride_bio }}</p>@endif
                </div>
            </div>
        </div>
    </section>

    <section id="schedule" class="py-20 px-4 bg-sand border-y border-gold-500/20">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-khmerHead text-2xl md:text-4xl text-burgundy-700 mb-2">{{ __('messages.schedule_title') }}</h2>
                <div class="w-24 h-1 bg-gold-500 mx-auto rounded-full mb-3"></div>
                <p class="font-serif italic text-gold-700">{{ __('messages.schedule_subtitle') }}</p>
            </div>

            <div class="space-y-6">
                <div class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-md border-l-4 border-gold-500">
                    <div class="bg-burgundy-700 text-gold-300 p-6 flex flex-col justify-center items-center md:w-1/3 text-center">
                        <span class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-full border border-gold-400 bg-gold-100 text-burgundy-700" aria-hidden="true">
                            @if ($settings?->krong_pali_icon && str_starts_with($settings->krong_pali_icon, 'ceremony_icons/'))<img class="h-6 w-6 object-contain" src="{{ asset('storage/' . $settings->krong_pali_icon) }}" alt="">@else
                            @switch($settings?->krong_pali_icon ?: 'sun')
                            @case('scissors')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="6" cy="6" r="2.5" />
                                <circle cx="6" cy="18" r="2.5" />
                                <path d="m8 7.5 12 12M8 16.5 13 12m0 0 7-7" />
                            </svg>@break
                            @case('heart')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.8 8.8c0 5.3-8.8 10-8.8 10S3.2 14.1 3.2 8.8A4.3 4.3 0 0 1 12 6.7a4.3 4.3 0 0 1 8.8 2.1Z" />
                            </svg>@break
                            @case('glass')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 3h6l-1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 4 9l1-6Zm3 8.5V20m-3 0h6M14 3h6l1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 15 9l-1-6Zm3 8.5V20m-3 0h6" />
                            </svg>@break
                            @default<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="3.2" />
                                <path d="M12 2v1M12 13v1M5.6 5.6l.8.8m11.2-.8-.8.8M4 10h1m14 0h1M8 18c1.1-1.4 2.4-2 4-2s2.9.6 4 2M5.5 20c1.5-2.1 3.7-3.2 6.5-3.2s5 1.1 6.5 3.2" />
                            </svg>
                            @endswitch
                            @endif
                        </span>
                        <span class="font-khmerHead text-lg">{{ __('messages.krong_pali') }}</span>
                        <span class="mt-2 font-mono bg-burgundy-900 px-3 py-1 rounded-full text-xs text-gold-300">{{ $settings?->krong_pali_time ? \Illuminate\Support\Carbon::parse($settings->krong_pali_time)->format('g:i A') : __('messages.time_to_be_announced') }}</span>
                    </div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-center">
                        <h3 class="font-khmerHead text-base text-burgundy-900 mb-1">{{ __('messages.krong_pali_details') }}</h3>
                        <p class="text-sm text-stone-600 leading-relaxed">{{ $settings?->krong_pali_desc }}</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-md border-l-4 border-equinox-amber">
                    <div class="bg-equinox-amber text-white p-6 flex flex-col justify-center items-center md:w-1/3 text-center">
                        <span class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-full border border-gold-400 bg-gold-100 text-burgundy-700" aria-hidden="true">
                            @if ($settings?->hair_cutting_icon && str_starts_with($settings->hair_cutting_icon, 'ceremony_icons/'))<img class="h-6 w-6 object-contain" src="{{ asset('storage/' . $settings->hair_cutting_icon) }}" alt="">@else
                            @switch($settings?->hair_cutting_icon ?: 'scissors')
                            @case('sun')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="3.2" />
                                <path d="M12 2v1M12 13v1M5.6 5.6l.8.8m11.2-.8-.8.8M4 10h1m14 0h1M8 18c1.1-1.4 2.4-2 4-2s2.9.6 4 2M5.5 20c1.5-2.1 3.7-3.2 6.5-3.2s5 1.1 6.5 3.2" />
                            </svg>@break
                            @case('heart')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.8 8.8c0 5.3-8.8 10-8.8 10S3.2 14.1 3.2 8.8A4.3 4.3 0 0 1 12 6.7a4.3 4.3 0 0 1 8.8 2.1Z" />
                            </svg>@break
                            @case('glass')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 3h6l-1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 4 9l1-6Zm3 8.5V20m-3 0h6M14 3h6l1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 15 9l-1-6Zm3 8.5V20m-3 0h6" />
                            </svg>@break
                            @default<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="6" cy="6" r="2.5" />
                                <circle cx="6" cy="18" r="2.5" />
                                <path d="m8 7.5 12 12M8 16.5 13 12m0 0 7-7" />
                            </svg>
                            @endswitch
                            @endif
                        </span>
                        <span class="font-khmerHead text-lg">{{ __('messages.hair_cutting') }}</span>
                        <span class="mt-2 font-mono bg-amber-800 px-3 py-1 rounded-full text-xs text-white">{{ $settings?->hair_cutting_time ? \Illuminate\Support\Carbon::parse($settings->hair_cutting_time)->format('g:i A') : __('messages.time_to_be_announced') }}</span>
                    </div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-center">
                        <h3 class="font-khmerHead text-base text-burgundy-900 mb-1">{{ __('messages.hair_cutting_details') }}</h3>
                        <p class="text-sm text-stone-600 leading-relaxed">{{ $settings?->hair_cutting_desc }}</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-md border-l-4 border-gold-600">
                    <div class="bg-gold-600 text-white p-6 flex flex-col justify-center items-center md:w-1/3 text-center">
                        <span class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-full border border-gold-400 bg-gold-100 text-burgundy-700" aria-hidden="true">
                            @if ($settings?->knot_tying_icon && str_starts_with($settings->knot_tying_icon, 'ceremony_icons/'))<img class="h-6 w-6 object-contain" src="{{ asset('storage/' . $settings->knot_tying_icon) }}" alt="">@else
                            @switch($settings?->knot_tying_icon ?: 'heart')
                            @case('sun')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="3.2" />
                                <path d="M12 2v1M12 13v1M5.6 5.6l.8.8m11.2-.8-.8.8M4 10h1m14 0h1M8 18c1.1-1.4 2.4-2 4-2s2.9.6 4 2M5.5 20c1.5-2.1 3.7-3.2 6.5-3.2s5 1.1 6.5 3.2" />
                            </svg>@break
                            @case('scissors')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="6" cy="6" r="2.5" />
                                <circle cx="6" cy="18" r="2.5" />
                                <path d="m8 7.5 12 12M8 16.5 13 12m0 0 7-7" />
                            </svg>@break
                            @case('glass')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 3h6l-1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 4 9l1-6Zm3 8.5V20m-3 0h6M14 3h6l1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 15 9l-1-6Zm3 8.5V20m-3 0h6" />
                            </svg>@break
                            @default<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="12" r="5" />
                                <circle cx="16" cy="12" r="5" />
                                <path d="M10 12c.8-1.8 2-2.4 2-2.4s1.2.6 2 2.4c-.8 1.8-2 2.4-2 2.4s-1.2-.6-2-2.4Z" />
                            </svg>
                            @endswitch
                            @endif
                        </span>
                        <span class="font-khmerHead text-lg">{{ __('messages.knot_tying') }}</span>
                        <span class="mt-2 font-mono bg-gold-700 px-3 py-1 rounded-full text-xs text-white">{{ $settings?->knot_tying_time ? \Illuminate\Support\Carbon::parse($settings->knot_tying_time)->format('g:i A') : __('messages.time_to_be_announced') }}</span>
                    </div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-center">
                        <h3 class="font-khmerHead text-base text-burgundy-900 mb-1">{{ __('messages.knot_tying_details') }}</h3>
                        <p class="text-sm text-stone-600 leading-relaxed">{{ $settings?->knot_tying_desc }}</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-md border-l-4 border-burgundy-900">
                    <div class="bg-burgundy-900 text-gold-300 p-6 flex flex-col justify-center items-center md:w-1/3 text-center">
                        <span class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-full border border-gold-400 bg-gold-100 text-burgundy-700" aria-hidden="true">
                            @if ($settings?->evening_reception_icon && str_starts_with($settings->evening_reception_icon, 'ceremony_icons/'))<img class="h-6 w-6 object-contain" src="{{ asset('storage/' . $settings->evening_reception_icon) }}" alt="">@else
                            @switch($settings?->evening_reception_icon ?: 'glass')
                            @case('sun')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="3.2" />
                                <path d="M12 2v1M12 13v1M5.6 5.6l.8.8m11.2-.8-.8.8M4 10h1m14 0h1M8 18c1.1-1.4 2.4-2 4-2s2.9.6 4 2M5.5 20c1.5-2.1 3.7-3.2 6.5-3.2s5 1.1 6.5 3.2" />
                            </svg>@break
                            @case('scissors')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="6" cy="6" r="2.5" />
                                <circle cx="6" cy="18" r="2.5" />
                                <path d="m8 7.5 12 12M8 16.5 13 12m0 0 7-7" />
                            </svg>@break
                            @case('heart')<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.8 8.8c0 5.3-8.8 10-8.8 10S3.2 14.1 3.2 8.8A4.3 4.3 0 0 1 12 6.7a4.3 4.3 0 0 1 8.8 2.1Z" />
                            </svg>@break
                            @default<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 3h6l-1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 4 9l1-6Zm3 8.5V20m-3 0h6M14 3h6l1 6a3 3 0 0 1-3 2.5A3 3 0 0 1 15 9l-1-6Zm3 8.5V20m-3 0h6" />
                            </svg>
                            @endswitch
                            @endif
                        </span>
                        <span class="font-khmerHead text-lg">{{ __('messages.evening_reception') }}</span>
                        <span class="mt-2 font-mono bg-burgundy-700 px-3 py-1 rounded-full text-xs text-gold-300">{{ $settings?->evening_reception_time ? \Illuminate\Support\Carbon::parse($settings->evening_reception_time)->format('g:i A') : __('messages.time_to_be_announced') }}</span>
                    </div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-center">
                        <h3 class="font-khmerHead text-base text-burgundy-900 mb-1">{{ __('messages.evening_reception_details') }}</h3>
                        <p class="text-sm text-stone-600 leading-relaxed">{{ $settings?->evening_reception_desc }}</p>
                    </div>
                </div>
                @foreach ($settings?->additional_ceremonies ?? [] as $ceremony)
                <article class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-md border-l-4 border-gold-500">
                    <div class="bg-gold-700 text-white p-6 flex flex-col justify-center items-center md:w-1/3 text-center"><i class="fas fa-star text-3xl mb-2"></i><span class="font-khmerHead text-lg">{{ app()->getLocale() === 'kh' ? ($ceremony['title_kh'] ?? '') : ($ceremony['title_en'] ?? $ceremony['title_kh'] ?? '') }}</span><span class="mt-2 font-mono bg-burgundy-900 px-3 py-1 rounded-full text-xs">{{ !empty($ceremony['time']) ? \Illuminate\Support\Carbon::parse($ceremony['time'])->format('g:i A') : '' }}</span></div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-center">
                        <p class="text-sm text-stone-600 leading-relaxed">{{ $ceremony['description'] ?? '' }}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="gallery" class="py-20 px-4 bg-cream">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-khmerHead text-2xl md:text-4xl text-burgundy-700 mb-2">{{ __('messages.gallery_title') }}</h2>
                <div class="w-24 h-1 bg-gold-500 mx-auto rounded-full mb-3"></div>
                <p class="font-serif italic text-gold-700">{{ __('messages.gallery_subtitle') }}</p>
            </div>

            @if ($photos->isNotEmpty())
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($photos as $photo)
                <button type="button" data-lightbox-src="{{ asset($photo->photo_path) }}" aria-label="{{ __('messages.open_photo', ['number' => $photo->caption ?: __('messages.gallery_item')]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100"><img src="{{ asset($photo->photo_path) }}" alt="{{ $photo->caption ?: __('messages.gallery_item') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500"></button>
                @endforeach
            </div>
            @else
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <button type="button" aria-label="{{ __('messages.open_photo', ['number' => 1]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100" onclick="openLightbox('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80')">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=600&q=80" alt="{{ __('messages.gallery_item') }} 1" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </button>
                <button type="button" aria-label="{{ __('messages.open_photo', ['number' => 2]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100" onclick="openLightbox('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1200&q=80')">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=600&q=80" alt="{{ __('messages.gallery_item') }} 2" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </button>
                <button type="button" aria-label="{{ __('messages.open_photo', ['number' => 3]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=1200&q=80')">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80" alt="{{ __('messages.gallery_item') }} 3" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </button>
                <button type="button" aria-label="{{ __('messages.open_photo', ['number' => 4]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100" onclick="openLightbox('https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&w=1200&q=80')">
                    <img src="https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&w=600&q=80" alt="{{ __('messages.gallery_item') }} 4" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </button>
                <button type="button" aria-label="{{ __('messages.open_photo', ['number' => 5]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100" onclick="openLightbox('https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=1200&q=80')">
                    <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=600&q=80" alt="{{ __('messages.gallery_item') }} 5" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </button>
                <button type="button" aria-label="{{ __('messages.open_photo', ['number' => 6]) }}" class="w-full border-0 p-0 text-left overflow-hidden rounded-xl shadow-md cursor-pointer group aspect-square bg-stone-100" onclick="openLightbox('https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?auto=format&fit=crop&w=1200&q=80')">
                    <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?auto=format&fit=crop&w=600&q=80" alt="{{ __('messages.gallery_item') }} 6" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Modal Lightbox -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center p-4">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white text-3xl focus:outline-none hover:text-gold-400" aria-label="{{ __('messages.close') }}">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightboxImg" src="" alt="{{ __('messages.preview_photo') }}" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl object-contain">
    </div>

    <dialog id="giftModal" class="gift-overlay fixed inset-0 z-[70] m-0 max-h-none max-w-none flex items-center justify-center border-0 bg-stone-950/65 p-3 text-inherit backdrop-blur-sm md:p-6" aria-labelledby="giftTitle" aria-describedby="giftDescription">
        <div class="gift-dialog relative flex max-h-[94vh] w-full max-w-4xl flex-col overflow-hidden rounded-2xl border border-[#D4AF37] bg-cream/95 shadow-2xl" tabindex="-1">
            <header class="flex items-start justify-between gap-4 border-b border-gold-500/30 bg-white/70 px-5 py-4 md:px-7">
                <div>
                    <p class="mb-1 text-xs font-semibold uppercase tracking-widest text-gold-700">{{ __('messages.gift_subtitle') }}</p>
                    <h2 id="giftTitle" class="font-khmerHead text-lg leading-relaxed text-burgundy-900 md:text-2xl">{{ __('messages.gift_title') }}</h2>
                    <p id="giftDescription" class="font-serif text-sm text-stone-600">{{ __('messages.gift_title') }}</p>
                </div>
                <button id="giftClose" type="button" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-stone-600 transition hover:bg-stone-100 hover:text-burgundy-800 focus:outline-none focus:ring-2 focus:ring-gold-500" aria-label="{{ __('messages.close') }}">
                    <i class="fas fa-times text-lg" aria-hidden="true"></i>
                </button>
            </header>

            <div class="overflow-y-auto px-4 py-5 md:px-7 md:py-6">
                <div class="mb-5 grid grid-cols-2 rounded-lg border border-gold-500/40 bg-white/60 p-1" role="tablist" aria-label="{{ __('messages.gift_title') }}">
                    <button id="khqrTab" type="button" class="gift-tab rounded-md bg-burgundy-700 px-3 py-2.5 text-sm font-semibold text-white" role="tab" aria-selected="true" aria-controls="khqrPanel">{{ __('messages.khqr_code') }}</button>
                    <button id="bankTab" type="button" class="gift-tab rounded-md px-3 py-2.5 text-sm font-semibold text-stone-600 transition hover:bg-gold-100" role="tab" aria-selected="false" aria-controls="bankPanel" tabindex="-1">{{ __('messages.bank_transfer') }}</button>
                </div>

                <div id="khqrPanel" role="tabpanel" aria-labelledby="khqrTab">
                    <div class="grid gap-6 md:grid-cols-[minmax(0,1fr)_minmax(250px,0.85fr)] md:items-center">
                        <div class="flex flex-col items-center">
                            <div class="relative flex aspect-square w-full max-w-[270px] items-center justify-center rounded-xl border border-gold-500/50 bg-white p-4 shadow-sm">
                                <img id="khqrImage" src="{{ $settings?->qr_code_image ? asset($settings->qr_code_image) : asset('img/photo_2025-11-21_21-07-06 (1).svg') }}" class="h-full w-full object-contain" alt="{{ __('messages.khqr_code') }}">
                                <div id="khqrPlaceholder" class="hidden h-full w-full flex-col items-center justify-center gap-3 rounded-lg border border-dashed border-gold-500/50 bg-sand px-5 text-center">
                                    <span class="flex h-14 w-14 items-center justify-center rounded-full border border-gold-500 bg-white text-2xl text-burgundy-700"><i class="fas fa-qrcode" aria-hidden="true"></i></span>
                                    <p class="font-semibold text-burgundy-900">{{ __('messages.khqr_unavailable') }}</p>
                                    <p class="text-xs leading-relaxed text-stone-600">{{ __('messages.khqr_unavailable_help') }}</p>
                                </div>
                            </div>
                            <p id="khqrAmountCaption" data-empty-label="{{ __('messages.no_amount_selected') }}" data-selected-label="{{ __('messages.selected_contribution') }}" class="mt-3 font-serif text-sm text-stone-600">{{ __('messages.no_amount_selected') }}</p>
                        </div>

                        <div>
                            <p class="mb-3 text-sm font-semibold text-stone-700">{{ __('messages.choose_amount') }}</p>
                            <div class="grid grid-cols-3 gap-2" aria-label="{{ __('messages.select_gift_amount') }}">
                                <button type="button" class="gift-amount rounded-md border border-gold-500/50 bg-white px-3 py-2.5 font-serif font-semibold text-burgundy-800 transition hover:bg-gold-100" data-amount="10" aria-pressed="false">$10</button>
                                <button type="button" class="gift-amount rounded-md border border-gold-500/50 bg-white px-3 py-2.5 font-serif font-semibold text-burgundy-800 transition hover:bg-gold-100" data-amount="20" aria-pressed="false">$20</button>
                                <button type="button" class="gift-amount rounded-md border border-gold-500/50 bg-white px-3 py-2.5 font-serif font-semibold text-burgundy-800 transition hover:bg-gold-100" data-amount="50" aria-pressed="false">$50</button>
                                <button type="button" class="gift-amount rounded-md border border-gold-500/50 bg-white px-3 py-2.5 font-serif font-semibold text-burgundy-800 transition hover:bg-gold-100" data-amount="100" aria-pressed="false">$100</button>
                                <button id="customAmountButton" type="button" class="col-span-2 rounded-md border border-gold-500/50 bg-white px-3 py-2.5 text-sm font-semibold text-burgundy-800 transition hover:bg-gold-100" aria-pressed="false">{{ __('messages.custom_amount') }}</button>
                            </div>
                            <label id="customAmountWrap" class="mt-3 hidden text-sm font-medium text-stone-700" for="customAmount">{{ __('messages.amount_usd') }}
                                <input id="customAmount" type="number" min="1" step="0.01" inputmode="decimal" class="mt-1 w-full rounded-md border border-stone-300 bg-white px-3 py-2 text-sm outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-200" placeholder="{{ __('messages.enter_amount') }}">
                            </label>
                            <p class="mt-4 text-xs leading-relaxed text-stone-500">{{ __('messages.qr_amount_help') }}</p>
                            <button id="downloadKhqr" type="button" class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-md bg-burgundy-700 px-4 py-3 text-sm font-semibold text-gold-100 transition hover:bg-burgundy-900 disabled:cursor-not-allowed disabled:bg-stone-300 disabled:text-stone-500" disabled>
                                <i class="fas fa-download" aria-hidden="true"></i> {{ __('messages.download_qr') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div id="bankPanel" class="hidden" role="tabpanel" aria-labelledby="bankTab" hidden>
                    <p class="mb-4 text-sm leading-relaxed text-stone-600">{{ __('messages.select_bank_help') }}</p>
                    @php($giftBanks = [
                    ['key' => 'aba', 'label' => 'ABA Bank', 'enabled' => $settings?->enable_aba, 'name' => $settings?->aba_account_name, 'usd' => $settings?->aba_account_usd, 'khr' => $settings?->aba_account_khr, 'icon' => 'fa-university', 'tone' => 'red'],
                    ['key' => 'acleda', 'label' => 'ACLEDA Bank', 'enabled' => $settings?->enable_acleda, 'name' => $settings?->acleda_account_name, 'usd' => $settings?->acleda_account_usd, 'khr' => $settings?->acleda_account_khr, 'icon' => 'fa-landmark', 'tone' => 'blue'],
                    ['key' => 'wing', 'label' => 'Wing Bank', 'enabled' => $settings?->enable_wing, 'name' => $settings?->wing_account_name, 'usd' => $settings?->wing_account_usd, 'khr' => $settings?->wing_account_khr, 'icon' => 'fa-wallet', 'tone' => 'green'],
                    ])
                    @if (collect($giftBanks)->every(fn ($bank) => ! $bank['enabled']))<p class="text-sm text-stone-600">{{ __('messages.no_bank_accounts') }}</p>@endif
                    <div class="grid gap-3 md:grid-cols-3">
                        @forelse ($giftBanks as $bank)
                        @if ($bank['enabled'])
                        <article class="rounded-lg border border-gold-500/40 bg-white p-4" data-bank-card="{{ $bank['key'] }}" data-account-name="{{ $bank['name'] }}">
                            <div class="mb-4 flex items-center gap-3"><span class="flex h-10 w-10 items-center justify-center rounded-md bg-{{ $bank['tone'] }}-50 text-{{ $bank['tone'] }}-800"><i class="fas {{ $bank['icon'] }}" aria-hidden="true"></i></span>
                                <h3 class="font-semibold text-stone-800">{{ $bank['label'] }}</h3>
                            </div>
                            <p class="mb-3 text-xs text-stone-500">{{ __('messages.account_name') }}: <span data-bank-name="{{ $bank['key'] }}" class="font-medium text-stone-800">{{ $bank['name'] ?: __('messages.not_configured') }}</span></p>
                            <div class="space-y-3">
                                @foreach (['USD' => $bank['usd'], 'KHR' => $bank['khr']] as $currency => $account)
                                <div class="flex items-end justify-between gap-2 border-t border-stone-100 pt-2">
                                    <div>
                                        <p class="text-xs text-stone-500">{{ $currency }} {{ __('messages.account_name') }}</p>
                                        <p class="font-mono text-sm text-stone-800" data-account-currency="{{ $currency }}">{{ $account ?: __('messages.not_configured') }}</p>
                                    </div><button class="copy-account inline-flex shrink-0 items-center gap-1 rounded-md border border-gold-500/50 px-2 py-1.5 text-xs font-semibold text-burgundy-800 transition hover:bg-gold-100 disabled:cursor-not-allowed disabled:opacity-50" data-bank="{{ $bank['key'] }}" data-currency="{{ $currency }}" type="button" @disabled(!$account)><i class="fas fa-copy" aria-hidden="true"></i> {{ __('messages.copy') }}</button>
                                </div>
                                @endforeach
                            </div>
                        </article>
                        @endif
                        @empty
                        <p class="text-sm text-stone-600">{{ __('messages.no_bank_accounts') }}</p>
                        @endforelse
                    </div>
                </div>

                <form id="giftConfirmationForm" class="mt-6 border-t border-gold-500/30 pt-5" action="{{ route('wish.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="attendance_status" value="Yes">
                    <div class="mb-4 flex items-center gap-2 text-burgundy-900"><i class="fas fa-envelope-open-text text-gold-700" aria-hidden="true"></i>
                        <h3 class="font-semibold">{{ __('messages.send_note') }}</h3><span class="text-xs text-stone-500">{{ __('messages.optional') }}</span>
                    </div>
                    <div class="grid gap-3 md:grid-cols-2">
                        <label class="text-xs font-semibold text-stone-700" for="giftGuestName">{{ __('messages.your_name') }}
                            <input id="giftGuestName" name="guest_name" type="text" maxlength="100" required value="{{ old('guest_name') }}" class="mt-1 w-full rounded-md border border-stone-300 bg-white px-3 py-2 text-sm font-normal outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-200" placeholder="{{ __('messages.guest_name') }}">
                        </label>
                        <label class="text-xs font-semibold text-stone-700" for="giftReceipt">{{ __('messages.transfer_receipt') }}
                            <input id="giftReceipt" name="receipt_image" type="file" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-xs font-normal text-stone-600 file:mr-2 file:rounded file:border-0 file:bg-gold-100 file:px-3 file:py-2 file:font-semibold file:text-burgundy-800">
                            @error('receipt_image')<span class="mt-1 block text-xs text-red-700">{{ $message }}</span>@enderror
                        </label>
                        <label class="text-xs font-semibold text-stone-700 md:col-span-2" for="giftMessage">{{ __('messages.message') }}
                            <textarea id="giftMessage" name="message" rows="2" maxlength="2000" class="mt-1 w-full rounded-md border border-stone-300 bg-white px-3 py-2 text-sm font-normal outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-200" placeholder="{{ __('messages.share_wishes_placeholder') }}">{{ old('message') }}</textarea>
                        </label>
                    </div>
                    <p class="mt-2 text-xs text-stone-500">{{ __('messages.receipt_privacy') }}</p>
                    <button type="submit" class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-md border border-gold-600 bg-white px-4 py-2.5 text-sm font-semibold text-burgundy-800 transition hover:bg-gold-100"><i class="fas fa-paper-plane" aria-hidden="true"></i> {{ __('messages.send_wishes') }}</button>
                </form>
            </div>
        </div>
    </dialog>
    <output id="giftToast" data-copy-success="{{ __('messages.copied') }}" data-copy-error="{{ __('messages.clipboard_unavailable') }}" class="fixed bottom-24 left-1/2 z-[80] -translate-x-1/2 translate-y-2 rounded-md bg-stone-900 px-4 py-3 text-sm text-white opacity-0 shadow-xl transition duration-200" aria-live="polite"></output>

    <section id="rsvp" class="py-20 px-4 bg-sand border-t border-gold-500/20">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-khmerHead text-2xl md:text-4xl text-burgundy-700 mb-2">{{ __('messages.rsvp_title') }}</h2>
                <div class="w-24 h-1 bg-gold-500 mx-auto rounded-full mb-3"></div>
                <p class="font-serif italic text-gold-700">{{ __('messages.rsvp_title') }}</p>
            </div>

            @if (session('status'))<output class="mb-6 block rounded-lg border border-green-700/20 bg-green-50 px-4 py-3 text-sm text-green-900">{{ session('status') }}</output>@endif
            @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-700/20 bg-red-50 px-4 py-3 text-sm text-red-900" role="alert">
                <p class="font-semibold">{{ __('messages.check_submission') }}</p>
                <ul class="mt-2 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gold-500/30">
                    <h3 class="font-khmerHead text-lg text-burgundy-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-envelope-open-text text-equinox-amber"></i> {{ __('messages.rsvp_form') }}
                    </h3>
                    <form id="rsvpForm" class="space-y-4" action="{{ route('wish.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="guestName" class="block text-xs font-semibold text-stone-700 mb-1">{{ __('messages.full_name') }} *</label>
                            <input type="text" id="guestName" name="guest_name" value="{{ old('guest_name') }}" maxlength="100" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none text-sm" placeholder="{{ __('messages.example_name') }}">
                        </div>
                        <div>
                            <label for="attendance" class="block text-xs font-semibold text-stone-700 mb-1">{{ __('messages.attendance') }} *</label>
                            <select id="attendance" name="attendance_status" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none text-sm">
                                <option value="Yes" @selected(old('attendance_status', 'Yes' )==='Yes' )>{{ __('messages.joyfully_accept') }}</option>
                                <option value="No" @selected(old('attendance_status')==='No' )>{{ __('messages.regretfully_decline') }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="guestCount" class="block text-xs font-semibold text-stone-700 mb-1">{{ __('messages.number_guests') }}</label>
                            <input type="number" id="guestCount" name="guest_count" min="1" max="10" value="{{ old('guest_count', 1) }}" class="w-full px-4 py-2.5 rounded-lg border border-stone-300 focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none text-sm">
                        </div>
                        <div>
                            <label for="wishMessage" class="block text-xs font-semibold text-stone-700 mb-1">{{ __('messages.wishes') }} *</label>
                            <textarea id="wishMessage" name="message" rows="3" maxlength="2000" required class="w-full px-4 py-2.5 rounded-lg border border-stone-300 focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none text-sm" placeholder="{{ __('messages.wish_placeholder') }}">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="w-full bg-burgundy-700 hover:bg-burgundy-900 text-gold-300 font-khmerHead py-3 rounded-lg shadow-md transition duration-300 flex justify-center items-center gap-2">
                            <i class="fas fa-paper-plane"></i> {{ __('messages.send_wishes') }}
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gold-500/30 flex flex-col h-[480px]">
                    <h3 class="font-khmerHead text-lg text-burgundy-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-heart text-burgundy-700"></i> {{ __('messages.guest_wishes_title') }}
                    </h3>
                    <div id="wishesContainer" class="flex-1 overflow-y-auto pr-2 space-y-4" aria-live="polite">
                        @forelse ($wishes as $wish)
                        <article class="bg-sand/60 p-4 rounded-xl border border-gold-500/20">
                            <div class="flex justify-between items-center gap-3 mb-1">
                                <h4 class="font-khmerHead text-sm text-burgundy-900">{{ $wish->guest_name }}</h4>
                                <span class="text-[10px] text-stone-500">{{ $wish->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-stone-700 leading-relaxed font-light">{{ $wish->message }}</p>
                            <p class="mt-2 text-[10px] text-burgundy-700">{{ $wish->attendance_status === 'Yes' ? __('messages.will_attend') : __('messages.unable_to_attend') }}</p>
                        </article>
                        @empty
                        <p class="rounded-xl border border-gold-500/20 bg-sand/60 p-4 text-sm text-stone-600">{{ __('messages.first_wish') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="location" class="py-20 px-4 bg-cream">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="font-khmerHead text-2xl md:text-4xl text-burgundy-700 mb-2">{{ __('messages.venue_title') }}</h2>
                <div class="w-24 h-1 bg-gold-500 mx-auto rounded-full mb-3"></div>
                <p class="font-serif italic text-gold-700">{{ __('messages.venue_location') }}</p>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gold-500/30 grid grid-cols-1 md:grid-cols-2">
                <div class="p-8 flex flex-col justify-center">
                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-equinox-amber mb-2">{{ __('messages.venue_title') }}</span>
                    <h3 class="font-khmerHead text-xl text-burgundy-900 mb-4">{{ $settings?->location_name ?: __('messages.venue_details_pending') }}</h3>
                    <p class="text-stone-600 text-sm leading-relaxed mb-6">
                        <i class="fas fa-map-marker-alt text-burgundy-700 mr-2"></i>
                        {{ $settings?->location_name ?: __('messages.venue_details_pending') }}
                    </p>
                    <div>
                        <a href="{{ $settings?->location_map_url ?: 'https://maps.google.com/?q='.urlencode($settings?->location_name ?: 'Cambodia') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-gold-500 hover:bg-gold-600 text-burgundy-900 font-semibold px-6 py-3 rounded-xl shadow-md transition">
                            <i class="fas fa-directions"></i> {{ __('messages.open_maps') }}
                        </a>
                    </div>
                </div>
                <div class="relative min-h-[300px] bg-stone-200">
                    <iframe title="{{ __('messages.map_to_venue', ['venue' => $settings?->location_name ?: __('messages.venue_title')]) }}"
                        class="w-full h-full border-0 min-h-[300px]"
                        src="https://www.google.com/maps?q={{ urlencode($settings?->location_name ?: 'Cambodia') }}&amp;output=embed"
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-burgundy-900 text-gold-300 py-12 px-4 text-center border-t-2 border-gold-500">
        <div class="max-w-3xl mx-auto space-y-4">
            <h3 class="font-khmerHead text-xl text-gold-300">{{ __('messages.thank_you') }}</h3>
            <p class="text-xs text-stone-300">{{ __('messages.thank_you_message') }}</p>
            <div class="w-16 h-0.5 bg-gold-500/50 mx-auto my-4"></div>
            <p class="text-xs text-stone-400 font-serif">© {{ now()->year }} {{ app()->getLocale() === 'kh' ? ($settings?->groom_name_kh ?: 'កូនកំលោះ') : ($settings?->groom_name_en ?: 'Groom') }} &amp; {{ app()->getLocale() === 'kh' ? ($settings?->bride_name_kh ?: 'កូនក្រមុំ') : ($settings?->bride_name_en ?: 'Bride') }} {{ __('messages.wedding') }}</p>
        </div>
    </footer>

    <script>
        window.addEventListener('storage', event => {
            if (event.key === 'wedding_data_updated') window.location.reload();
        });

        document.documentElement.style.setProperty('--primary-color', document.body.dataset.primaryColor || '#D4AF37');
        document.documentElement.style.setProperty('--secondary-color', document.body.dataset.secondaryColor || '#8B0000');
        const heroSection = document.getElementById('home');
        if (heroSection.dataset.backgroundImage) {
            heroSection.style.setProperty('--wedding-background', `url("${heroSection.dataset.backgroundImage}")`);
        }

        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });

        const weddingDateValue = document.getElementById('countdown').dataset.date;
        const weddingDate = weddingDateValue ? new Date(weddingDateValue).getTime() : NaN;

        function updateCountdown() {
            if (!Number.isFinite(weddingDate)) return;
            const now = new Date().getTime();
            const distance = weddingDate - now;

            if (distance < 0) {
                const finishedMessage = document.getElementById('countdown').dataset.finishedMessage;
                document.getElementById('countdown').innerHTML = `<div class="col-span-4 text-burgundy-700 font-khmerHead text-xl">${finishedMessage}</div>`;
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').innerText = String(days).padStart(2, '0');
            document.getElementById('hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
            document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();

        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightbox').classList.remove('hidden');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
        }

        document.querySelectorAll('[data-lightbox-src]').forEach(button => {
            button.addEventListener('click', () => openLightbox(button.dataset.lightboxSrc));
        });

        let isPlaying = false;
        const audioToggle = document.getElementById('audioToggle');
        const bgMusic = document.getElementById('bgMusic');

        function setMusicPlaying(playing) {
            isPlaying = playing;
            audioToggle.title = playing ? audioToggle.dataset.pauseLabel : audioToggle.dataset.playLabel;
            audioToggle.setAttribute('aria-label', audioToggle.title);
            audioToggle.setAttribute('aria-pressed', String(playing));
            audioToggle.classList.toggle('is-playing', playing);
            audioToggle.classList.toggle('animate-pulse', playing);
        }

        function playTrack() {
            const playback = bgMusic.play();
            if (playback) playback.catch(() => setMusicPlaying(false));
        }

        bgMusic.addEventListener('play', () => setMusicPlaying(true));
        bgMusic.addEventListener('pause', () => setMusicPlaying(false));
        bgMusic.addEventListener('error', () => setMusicPlaying(false));

        audioToggle.addEventListener('click', () => {
            if (bgMusic.paused) {
                playTrack();
            } else {
                bgMusic.pause();
            }
        });

        document.addEventListener('click', (event) => {
            if (!isPlaying && !event.target.closest('#audioToggle')) playTrack();
        }, {
            once: true
        });

        /* Romduol Flower Canvas Falling Effect Animation */
        const canvas = document.getElementById('romduol-canvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        const romduols = Array.from({
            length: 22
        }, () => ({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            scale: Math.random() * 0.7 + 0.5,
            speedY: Math.random() * 0.9 + 0.4,
            speedX: Math.random() * 0.6 - 0.3,
            rotation: Math.random() * Math.PI * 2,
            rotSpeed: (Math.random() - 0.5) * 0.02,
            opacity: Math.random() * 0.5 + 0.4
        }));

        function drawRomduolFlower(r) {
            ctx.save();
            ctx.translate(r.x, r.y);
            ctx.rotate(r.rotation);
            ctx.scale(r.scale, r.scale);

            const size = 16;
            const flowerStyle = canvas.dataset.flowerStyle;

            if (flowerStyle !== 'rumdul_gold') {
                if (flowerStyle === 'sparkle_gold') {
                    ctx.beginPath();
                    ctx.moveTo(0, -size * 1.5);
                    ctx.lineTo(size * 0.25, -size * 0.25);
                    ctx.lineTo(size * 1.5, 0);
                    ctx.lineTo(size * 0.25, size * 0.25);
                    ctx.lineTo(0, size * 1.5);
                    ctx.lineTo(-size * 0.25, size * 0.25);
                    ctx.lineTo(-size * 1.5, 0);
                    ctx.lineTo(-size * 0.25, -size * 0.25);
                    ctx.closePath();
                    ctx.fillStyle = `rgba(255, 215, 95, ${r.opacity})`;
                    ctx.shadowColor = 'rgba(255, 210, 80, 0.8)';
                    ctx.shadowBlur = 8;
                    ctx.fill();
                    ctx.restore();
                    return;
                }
                const jasmine = flowerStyle === 'jasmine_white';
                const lotus = flowerStyle === 'lotus_petal';
                const petalCount = lotus ? 10 : jasmine ? 8 : 6;
                for (let i = 0; i < petalCount; i++) {
                    ctx.save();
                    ctx.rotate((i * Math.PI * 2) / petalCount);
                    ctx.beginPath();
                    ctx.ellipse(0, -size * 0.72, lotus ? size * 0.42 : size * 0.32, size * 0.72, 0, 0, Math.PI * 2);
                    ctx.fillStyle = jasmine ? `rgba(255, 255, 245, ${r.opacity})` : lotus ? `rgba(240, 130, 175, ${r.opacity})` : `rgba(190, 54, 83, ${r.opacity})`;
                    ctx.strokeStyle = jasmine ? `rgba(218, 202, 150, ${r.opacity})` : lotus ? `rgba(153, 47, 104, ${r.opacity})` : `rgba(112, 20, 49, ${r.opacity})`;
                    ctx.lineWidth = 0.8;
                    ctx.fill();
                    ctx.stroke();
                    ctx.restore();
                }
                ctx.beginPath();
                ctx.arc(0, 0, size * 0.22, 0, Math.PI * 2);
                ctx.fillStyle = jasmine ? `rgba(218, 172, 45, ${r.opacity})` : lotus ? `rgba(255, 211, 225, ${r.opacity})` : `rgba(112, 20, 49, ${r.opacity})`;
                ctx.fill();
                ctx.restore();
                return;
            }

            for (let i = 0; i < 3; i++) {
                ctx.save();
                ctx.rotate((i * 120 * Math.PI) / 180);
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.quadraticCurveTo(-size * 0.8, -size * 1.2, 0, -size * 2);
                ctx.quadraticCurveTo(size * 0.8, -size * 1.2, 0, 0);
                ctx.fillStyle = `rgba(234, 179, 8, ${r.opacity})`;
                ctx.fill();
                ctx.lineWidth = 1;
                ctx.strokeStyle = `rgba(184, 134, 11, ${r.opacity * 0.8})`;
                ctx.stroke();
                ctx.restore();
            }

            for (let i = 0; i < 3; i++) {
                ctx.save();
                ctx.rotate(((i * 120 + 60) * Math.PI) / 180);
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.quadraticCurveTo(-size * 0.5, -size * 0.8, 0, -size * 1.3);
                ctx.quadraticCurveTo(size * 0.5, -size * 0.8, 0, 0);
                ctx.fillStyle = `rgba(253, 224, 71, ${r.opacity})`;
                ctx.fill();
                ctx.restore();
            }

            ctx.beginPath();
            ctx.arc(0, 0, 4, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(128, 0, 32, ${r.opacity})`;
            ctx.fill();

            ctx.restore();
        }

        function animateRomduol() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            romduols.forEach(r => {
                r.y += r.speedY;
                r.x += Math.sin(r.y * 0.01) * 0.5;
                r.rotation += r.rotSpeed;

                if (r.y > canvas.height + 20) {
                    r.y = -20;
                    r.x = Math.random() * canvas.width;
                }
                drawRomduolFlower(r);
            });
            requestAnimationFrame(animateRomduol);
        }
        animateRomduol();

        const giftConfig = {
            banks: {}
        };
        document.querySelectorAll('[data-bank-card]').forEach(card => {
            const key = card.dataset.bankCard;
            giftConfig.banks[key] = {
                name: card.dataset.accountName,
                accounts: {}
            };
            card.querySelectorAll('[data-account-currency]').forEach(account => {
                const value = account.textContent.trim();
                giftConfig.banks[key].accounts[account.dataset.accountCurrency] = value === 'Not configured' ? '' : value;
            });
        });

        const giftModal = document.getElementById('giftModal');
        const giftDialog = giftModal.querySelector('.gift-dialog');
        const giftOpen = document.getElementById('giftOpen');
        const giftClose = document.getElementById('giftClose');
        const giftToast = document.getElementById('giftToast');
        const khqrImage = document.getElementById('khqrImage');
        const khqrPlaceholder = document.getElementById('khqrPlaceholder');
        const downloadKhqr = document.getElementById('downloadKhqr');
        const customAmount = document.getElementById('customAmount');
        let selectedGiftAmount = '';
        let toastTimer;
        let previousFocus = null;

        function setKhqrImageAvailability(isAvailable) {
            khqrImage.classList.toggle('hidden', !isAvailable);
            khqrPlaceholder.classList.toggle('hidden', isAvailable);
            khqrPlaceholder.classList.toggle('flex', !isAvailable);
            downloadKhqr.disabled = !isAvailable;
        }

        khqrImage.addEventListener('load', () => setKhqrImageAvailability(true));
        khqrImage.addEventListener('error', () => setKhqrImageAvailability(false));
        if (khqrImage.complete) setKhqrImageAvailability(khqrImage.naturalWidth > 0);

        function openGiftModal() {
            previousFocus = document.activeElement;
            giftModal.showModal();
            giftModal.classList.add('is-open');
            document.body.classList.add('overflow-hidden');
            giftDialog.focus();
            giftClose.focus();
        }

        function closeGiftModal() {
            giftModal.classList.remove('is-open');
            if (giftModal.open) giftModal.close();
            document.body.classList.remove('overflow-hidden');
            if (previousFocus) previousFocus.focus();
        }

        function showGiftToast(message) {
            giftToast.textContent = message;
            giftToast.classList.remove('opacity-0', 'translate-y-2');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => giftToast.classList.add('opacity-0', 'translate-y-2'), 2400);
        }

        function setGiftAmount(amount, isCustom = false) {
            selectedGiftAmount = amount;
            document.querySelectorAll('.gift-amount').forEach(button => {
                const selected = !isCustom && button.dataset.amount === amount;
                button.setAttribute('aria-pressed', String(selected));
                button.classList.toggle('bg-burgundy-700', selected);
                button.classList.toggle('text-white', selected);
                button.classList.toggle('bg-white', !selected);
            });
            const customSelected = isCustom;
            document.getElementById('customAmountButton').setAttribute('aria-pressed', String(customSelected));
            document.getElementById('customAmountWrap').classList.toggle('hidden', !customSelected);
            const amountCaption = document.getElementById('khqrAmountCaption');
            amountCaption.textContent = amount ? amountCaption.dataset.selectedLabel.replace(':amount', amount) : amountCaption.dataset.emptyLabel;
        }

        function selectGiftTab(selectedTab) {
            const isKhqr = selectedTab === 'khqr';
            const khqrTab = document.getElementById('khqrTab');
            const bankTab = document.getElementById('bankTab');
            const khqrPanel = document.getElementById('khqrPanel');
            const bankPanel = document.getElementById('bankPanel');

            khqrTab.setAttribute('aria-selected', String(isKhqr));
            bankTab.setAttribute('aria-selected', String(!isKhqr));
            khqrTab.tabIndex = isKhqr ? 0 : -1;
            bankTab.tabIndex = isKhqr ? -1 : 0;
            khqrTab.classList.toggle('bg-burgundy-700', isKhqr);
            khqrTab.classList.toggle('text-white', isKhqr);
            khqrTab.classList.toggle('text-stone-600', !isKhqr);
            bankTab.classList.toggle('bg-burgundy-700', !isKhqr);
            bankTab.classList.toggle('text-white', !isKhqr);
            bankTab.classList.toggle('text-stone-600', isKhqr);
            khqrPanel.hidden = !isKhqr;
            khqrPanel.classList.toggle('hidden', !isKhqr);
            bankPanel.hidden = isKhqr;
            bankPanel.classList.toggle('hidden', isKhqr);
        }

        giftOpen.addEventListener('click', openGiftModal);
        giftClose.addEventListener('click', closeGiftModal);
        giftModal.addEventListener('click', event => {
            if (event.target === giftModal) closeGiftModal();
        });
        giftModal.addEventListener('cancel', event => {
            event.preventDefault();
            closeGiftModal();
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Tab' && giftModal.classList.contains('is-open')) {
                const focusable = [...giftDialog.querySelectorAll('button:not(:disabled), input:not(:disabled), textarea:not(:disabled), [tabindex="0"]')].filter(element => !element.closest('[hidden], .hidden') && element.getClientRects().length > 0);
                const first = focusable[0];
                const last = focusable[focusable.length - 1];
                if (event.shiftKey && document.activeElement === first) {
                    event.preventDefault();
                    last.focus();
                } else if (!event.shiftKey && document.activeElement === last) {
                    event.preventDefault();
                    first.focus();
                }
            }
        });

        document.getElementById('khqrTab').addEventListener('click', () => selectGiftTab('khqr'));
        document.getElementById('bankTab').addEventListener('click', () => selectGiftTab('bank'));
        document.querySelectorAll('.gift-tab').forEach((tab, index, tabs) => {
            tab.addEventListener('keydown', event => {
                if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
                event.preventDefault();
                const nextIndex = (index + (event.key === 'ArrowRight' ? 1 : tabs.length - 1)) % tabs.length;
                tabs[nextIndex].focus();
                selectGiftTab(nextIndex === 0 ? 'khqr' : 'bank');
            });
        });

        document.querySelectorAll('.gift-amount').forEach(button => {
            button.addEventListener('click', () => setGiftAmount(button.dataset.amount));
        });
        document.getElementById('customAmountButton').addEventListener('click', () => {
            setGiftAmount(customAmount.value, true);
            customAmount.focus();
        });
        customAmount.addEventListener('input', () => {
            if (document.getElementById('customAmountButton').getAttribute('aria-pressed') === 'true') {
                setGiftAmount(customAmount.value, true);
            }
        });

        downloadKhqr.addEventListener('click', async () => {
            if (!khqrImage.src || downloadKhqr.disabled) return;
            const link = document.createElement('a');
            link.href = khqrImage.src;
            link.download = 'wedding-khqr.svg';
            link.click();
        });

        Object.entries(giftConfig.banks).forEach(([bank, details]) => {
            const nameElement = document.querySelector(`[data-bank-name="${bank}"]`);
            nameElement.textContent = details.name || 'Not configured';
            document.querySelectorAll(`[data-bank-card="${bank}"] [data-account-currency]`).forEach(accountElement => {
                const account = details.accounts?.[accountElement.dataset.accountCurrency];
                accountElement.textContent = account || 'Not configured';
            });
            document.querySelectorAll(`.copy-account[data-bank="${bank}"]`).forEach(button => {
                const account = details.accounts?.[button.dataset.currency];
                button.disabled = !account;
            });
        });

        document.querySelectorAll('.copy-account').forEach(button => {
            button.addEventListener('click', async () => {
                const bankDetails = giftConfig.banks[button.dataset.bank];
                const account = bankDetails.accounts?.[button.dataset.currency];
                if (!account) return;
                try {
                    await navigator.clipboard.writeText(account);
                    showGiftToast(giftToast.dataset.copySuccess);
                } catch {
                    showGiftToast(giftToast.dataset.copyError);
                }
            });
        });
    </script>
</body>

</html>
