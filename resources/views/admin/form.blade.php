<!doctype html>
<html lang="{{ app()->getLocale() === 'kh' ? 'km' : 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.admin_title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4f1e9;
            color: #302f29;
            font-family: 'Kantumruy Pro', sans-serif
        }

        .admin-shell {
            max-width: 980px;
            margin: 42px auto;
            padding: 0 18px
        }

        .admin-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid #d8d1c4;
            padding-bottom: 20px;
            margin-bottom: 26px
        }

        .admin-head h1 {
            font-family: Georgia, serif;
            font-size: 28px;
            margin: 0
        }

        .admin-head p {
            color: #6f6a5e;
            margin: 5px 0 0
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            border-bottom: 1px solid #e2ddd3;
            padding-bottom: 9px;
            margin: 25px 0 18px
        }

        .form-label {
            font-weight: 600;
            font-size: 14px
        }

        .form-control {
            border-color: #d5cdbf;
            border-radius: 3px
        }

        .btn {
            border-radius: 3px
        }

        .current-qr {
            max-width: 160px;
            max-height: 160px;
            object-fit: contain;
            border: 1px solid #ded8cd;
            padding: 5px;
            background: white
        }

        .admin-section {
            padding: 22px 0;
            border-bottom: 1px solid #ddd5c8;
            scroll-margin-top: 20px
        }

        .admin-section h2 {
            font: 600 18px Georgia, serif;
            margin: 0 0 18px
        }

        .profile-preview {
            width: 104px;
            height: 104px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #d4af37
        }

        .logo-preview {
            max-width: 180px;
            max-height: 110px;
            object-fit: contain;
            border: 1px solid #ded8cd;
            padding: 6px;
            background: white
        }

        .photo-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px
        }

        .photo-item {
            position: relative;
            border: 1px solid #d8d1c4;
            background: white;
            padding: 8px;
            cursor: grab
        }

        .photo-item img {
            display: block;
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover
        }

        .photo-item.dragging {
            opacity: .45
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 12px
        }

        .preview-tile {
            border: 1px solid #d8d1c4;
            background: white;
            padding: 8px
        }

        .preview-tile img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover
        }

        .ceremony-row {
            position: relative;
            padding: 16px 0;
            border-bottom: 1px dashed #d8d1c4
        }

        .bank-row {
            padding: 18px 0;
            border-bottom: 1px solid #e2ddd3
        }

        .admin-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 24px
        }

        .admin-nav a {
            color: #6d492d
        }

        .theme-preview {
            min-height: 82px;
            border: 1px solid #d8d1c4;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #fff
        }
    </style>
</head>

<body>
    <main class="admin-shell">
        <header class="admin-head">
            <div>
                <h1>{{ __('messages.admin_title') }}</h1>
                <p>{{ __('messages.admin_subtitle') }}</p>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-2">
                <nav class="btn-group" aria-label="{{ __('messages.switch_language') }}">
                    <a class="btn btn-sm {{ app()->getLocale() === 'kh' ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('lang.switch', ['locale' => 'kh']) }}" @if (app()->getLocale() === 'kh') aria-current="true" @endif>kh</a>
                    <a class="btn btn-sm {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-outline-secondary' }}" href="{{ route('lang.switch', ['locale' => 'en']) }}" @if (app()->getLocale() === 'en') aria-current="true" @endif>Eng</a>
                </nav>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-secondary" type="submit">{{ __('messages.sign_out') }}</button></form>
            </div>
        </header>

        <nav class="admin-nav" aria-label="{{ __('messages.settings_sections') }}">
            <a class="btn btn-sm btn-outline-secondary" href="#profiles">{{ __('messages.profiles') }}</a>
            <a class="btn btn-sm btn-outline-secondary" href="#schedule">{{ __('messages.schedule') }}</a>
            <a class="btn btn-sm btn-outline-secondary" href="#gallery">{{ __('messages.gallery') }}</a>
            <a class="btn btn-sm btn-outline-secondary" href="#effects">{{ __('messages.effects_audio') }}</a>
            <a class="btn btn-sm btn-outline-secondary" href="#gifts">{{ __('messages.gifts') }}</a>
        </nav>

        @if (session('status'))<output class="alert alert-success d-block">{{ session('status') }}</output>@endif
        @if ($settings?->slug)
        <div class="input-group mb-3">
            <span class="input-group-text">{{ __('messages.preview') }}</span>
            <input class="form-control" type="url" value="{{ route('wedding.preview', ['slug' => $settings->slug]) }}" readonly aria-label="{{ __('messages.preview') }}">
            <a class="btn btn-outline-primary" href="{{ route('wedding.preview', ['slug' => $settings->slug]) }}" target="_blank" rel="noopener noreferrer">{{ __('messages.preview') }}</a>
        </div>
        @endif
        @if ($errors->any())<div class="alert alert-danger"><strong>{{ __('messages.review_fields') }}</strong>
            <ul class="mb-0 mt-2">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>@endif

        @php
        $timeForInput = static function ($value) {
        if (! $value) return '';
        try { return \Illuminate\Support\Carbon::parse($value)->format('H:i'); }
        catch (\Throwable) { return ''; }
        };
        $customCeremonies = old('additional_ceremonies');
        $ceremonyIcons = ['sun' => __('messages.icon_sun'), 'scissors' => __('messages.icon_scissors'), 'heart' => __('messages.icon_heart'), 'glass' => __('messages.icon_glass')];
        if ($customCeremonies === null) {
        $customCeremonies = collect($settings?->additional_ceremonies ?? [])->map(function ($ceremony) use ($timeForInput) {
        $ceremony['time'] = $timeForInput($ceremony['time'] ?? null);
        return $ceremony;
        })->all();
        }
        @endphp

        <form id="weddingSettingsForm" method="POST" action="{{ route('wedding.update') }}" enctype="multipart/form-data">
            @csrf
            <section class="admin-section" id="theme" aria-labelledby="theme-title">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <h2 class="section-title" id="theme-title">{{ __('messages.visual_theme') }}</h2>
                    <button class="btn btn-sm btn-outline-secondary mb-3" id="resetColorBtn" type="button">{{ __('messages.reset_colors') }}</button>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-md-3"><label class="form-label" for="primary_color">{{ __('messages.primary_accent') }}</label><input class="form-control form-control-color color-control" type="color" id="primary_color" name="primary_color" value="{{ old('primary_color', $settings?->primary_color ?: '#D4AF37') }}"></div>
                    <div class="col-md-3"><label class="form-label" for="secondary_color">{{ __('messages.secondary_accent') }}</label><input class="form-control form-control-color color-control" type="color" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $settings?->secondary_color ?: '#8B0000') }}"></div>
                    <div class="col-md-6">
                        <div class="theme-preview" id="theme-preview"><strong>{{ __('messages.khmer_wedding') }}</strong><button type="button" class="btn btn-sm" id="theme-preview-button">{{ __('messages.preview') }}</button></div>
                    </div>
                    <div class="col-12">
                        <div class="row g-3 align-items-start justify-content-center">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="background_image">{{ __('messages.full_screen_background') }}</label>
                                <input class="form-control" type="file" id="background_image" name="background_image" accept="image/jpeg,image/png,image/webp">
                                <div class="form-text">{{ __('messages.image_file_help') }}</div>
                                @if ($settings?->background_image)<img class="logo-preview mt-2" src="{{ asset($settings->background_image) }}" alt="{{ __('messages.current_background') }}">@endif
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="force_background_style">{{ __('messages.background_display_mode') }}</label>
                                <select class="form-select" id="force_background_style" name="force_background_style">
                                    <option value="cover" @selected(old('force_background_style', $settings?->force_background_style ?? 'cover') === 'cover')>{{ __('messages.cover') }}</option>
                                    <option value="contain" @selected(old('force_background_style', $settings?->force_background_style) === 'contain')>{{ __('messages.contain') }}</option>
                                    <option value="repeat" @selected(old('force_background_style', $settings?->force_background_style) === 'repeat')>{{ __('messages.repeat') }}</option>
                                    <option value="fixed_blur" @selected(old('force_background_style', $settings?->force_background_style) === 'fixed_blur')>{{ __('messages.fixed_blur') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="admin-section" id="profiles" aria-labelledby="couple-title">
                <h2 class="section-title" id="couple-title">{{ __('messages.couple') }}</h2>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="groom_name_kh">{{ __('messages.groom_name_kh') }}</label><input class="form-control" id="groom_name_kh" name="groom_name_kh" value="{{ old('groom_name_kh', $settings?->groom_name_kh) }}" required maxlength="255"></div>
                    <div class="col-md-6"><label class="form-label" for="groom_name_en">{{ __('messages.groom_name_en') }}</label><input class="form-control" id="groom_name_en" name="groom_name_en" value="{{ old('groom_name_en', $settings?->groom_name_en) }}" required maxlength="255"></div>
                    <div class="col-md-6"><label class="form-label" for="bride_name_kh">{{ __('messages.bride_name_kh') }}</label><input class="form-control" id="bride_name_kh" name="bride_name_kh" value="{{ old('bride_name_kh', $settings?->bride_name_kh) }}" required maxlength="255"></div>
                    <div class="col-md-6"><label class="form-label" for="bride_name_en">{{ __('messages.bride_name_en') }}</label><input class="form-control" id="bride_name_en" name="bride_name_en" value="{{ old('bride_name_en', $settings?->bride_name_en) }}" required maxlength="255"></div>
                    <div class="col-md-6"><label class="form-label" for="groom_bio_text">{{ __('messages.groom_bio') }}</label><textarea class="form-control" id="groom_bio_text" name="groom_bio_text" rows="3" maxlength="3000">{{ old('groom_bio_text', $settings?->groom_bio_text ?: $settings?->groom_bio) }}</textarea>
                        <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                    </div>
                    <div class="col-md-6"><label class="form-label" for="bride_bio_text">{{ __('messages.bride_bio') }}</label><textarea class="form-control" id="bride_bio_text" name="bride_bio_text" rows="3" maxlength="3000">{{ old('bride_bio_text', $settings?->bride_bio_text ?: $settings?->bride_bio) }}</textarea>
                        <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                    </div>
                    <div class="col-md-4"><label class="form-label" for="groom_photo">{{ __('messages.groom_photo') }}</label><input class="form-control image-preview-input" type="file" id="groom_photo" name="groom_photo" accept="image/jpeg,image/png,image/webp" data-preview="#groom-photo-preview">@if ($settings?->groom_photo)<img class="profile-preview mt-2" id="groom-photo-preview" src="{{ asset($settings->groom_photo) }}" alt="{{ __('messages.current_groom_photo') }}">@else<img class="profile-preview mt-2 d-none" id="groom-photo-preview" alt="{{ __('messages.groom_photo_preview') }}">@endif</div>
                    <div class="col-md-4"><label class="form-label" for="bride_photo">{{ __('messages.bride_photo') }}</label><input class="form-control image-preview-input" type="file" id="bride_photo" name="bride_photo" accept="image/jpeg,image/png,image/webp" data-preview="#bride-photo-preview">@if ($settings?->bride_photo)<img class="profile-preview mt-2" id="bride-photo-preview" src="{{ asset($settings->bride_photo) }}" alt="{{ __('messages.current_bride_photo') }}">@else<img class="profile-preview mt-2 d-none" id="bride-photo-preview" alt="{{ __('messages.bride_photo_preview') }}">@endif</div>
                    <div class="col-md-4"><label class="form-label" for="wedding_logo">{{ __('messages.wedding_logo') }}</label><input class="form-control image-preview-input" type="file" id="wedding_logo" name="wedding_logo" accept="image/jpeg,image/png,image/webp" data-preview="#wedding-logo-preview">@if ($settings?->wedding_logo)<img class="logo-preview mt-2" id="wedding-logo-preview" src="{{ asset($settings->wedding_logo) }}" alt="{{ __('messages.current_logo') }}">@else<img class="logo-preview mt-2 d-none" id="wedding-logo-preview" alt="{{ __('messages.logo_preview') }}">@endif</div>
                </div>
            </section>

            <section class="admin-section" aria-labelledby="event-title">
                <h2 class="section-title" id="event-title">{{ __('messages.date_venue') }}</h2>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="wedding_date_kh">{{ __('messages.wedding_date_kh') }}</label><input class="form-control" id="wedding_date_kh" name="wedding_date_kh" value="{{ old('wedding_date_kh', $settings?->wedding_date_kh) }}" maxlength="255" placeholder="{{ __('messages.wedding_date_placeholder') }}"></div>
                    <div class="col-md-6"><label class="form-label" for="wedding_datetime">{{ __('messages.wedding_date_time') }}</label><input class="form-control" type="datetime-local" id="wedding_datetime" name="wedding_datetime" value="{{ old('wedding_datetime', $settings?->wedding_datetime?->format('Y-m-d\\TH:i')) }}" required></div>
                    <div class="col-md-6"><label class="form-label" for="location_name">{{ __('messages.venue_name') }}</label><input class="form-control" id="location_name" name="location_name" value="{{ old('location_name', $settings?->location_name) }}" required maxlength="255"></div>
                    <div class="col-md-6"><label class="form-label" for="location_map_url">{{ __('messages.maps_url') }}</label><input class="form-control" type="url" id="location_map_url" name="location_map_url" value="{{ old('location_map_url', $settings?->location_map_url) }}" maxlength="2048" placeholder="https://maps.google.com/..."></div>
                </div>
            </section>

            <section class="admin-section" id="schedule" aria-labelledby="schedule-title">
                <h2 id="schedule-title">{{ __('messages.traditional_ceremonies') }}</h2>
                <div class="row g-3">
                    <div class="col-md-6 ceremony-row">
                        <h3 class="h6">{{ __('messages.krong_pali') }}</h3><label class="form-label" for="krong_pali_icon">{{ __('messages.default_icon') }}</label><select class="form-select mb-2" id="krong_pali_icon" name="krong_pali_icon">@foreach ($ceremonyIcons as $icon => $label)<option value="{{ $icon }}" @selected(old('krong_pali_icon', in_array($settings?->krong_pali_icon, array_keys($ceremonyIcons), true) ? $settings->krong_pali_icon : 'sun') === $icon)>{{ $label }}</option>@endforeach</select><label class="form-label" for="krong_pali_icon_image">{{ __('messages.custom_icon_image') }}</label><input class="form-control form-control-sm mb-2" type="file" id="krong_pali_icon_image" name="krong_pali_icon_image" accept="image/png,image/jpeg,image/svg+xml,image/webp">@if ($settings?->krong_pali_icon && str_starts_with($settings->krong_pali_icon, 'ceremony_icons/'))<img class="logo-preview mb-2" style="width:64px;height:64px" src="{{ asset('storage/' . $settings->krong_pali_icon) }}" alt="{{ __('messages.current_krong_pali_icon') }}">@endif<label class="form-label" for="krong_pali_time">{{ __('messages.time') }}</label><input class="form-control mb-2" type="time" id="krong_pali_time" name="krong_pali_time" value="{{ old('krong_pali_time', $timeForInput($settings?->krong_pali_time)) }}"><label class="form-label" for="krong_pali_desc">{{ __('messages.details') }}</label><textarea class="form-control" id="krong_pali_desc" name="krong_pali_desc" rows="2" maxlength="2000">{{ old('krong_pali_desc', $settings?->krong_pali_desc) }}</textarea>
                        <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                    </div>
                    <div class="col-md-6 ceremony-row">
                        <h3 class="h6">{{ __('messages.hair_cutting') }}</h3><label class="form-label" for="hair_cutting_icon">{{ __('messages.default_icon') }}</label><select class="form-select mb-2" id="hair_cutting_icon" name="hair_cutting_icon">@foreach ($ceremonyIcons as $icon => $label)<option value="{{ $icon }}" @selected(old('hair_cutting_icon', in_array($settings?->hair_cutting_icon, array_keys($ceremonyIcons), true) ? $settings->hair_cutting_icon : 'scissors') === $icon)>{{ $label }}</option>@endforeach</select><label class="form-label" for="hair_cutting_icon_image">{{ __('messages.custom_icon_image') }}</label><input class="form-control form-control-sm mb-2" type="file" id="hair_cutting_icon_image" name="hair_cutting_icon_image" accept="image/png,image/jpeg,image/svg+xml,image/webp">@if ($settings?->hair_cutting_icon && str_starts_with($settings->hair_cutting_icon, 'ceremony_icons/'))<img class="logo-preview mb-2" style="width:64px;height:64px" src="{{ asset('storage/' . $settings->hair_cutting_icon) }}" alt="{{ __('messages.current_hair_cutting_icon') }}">@endif<label class="form-label" for="hair_cutting_time">{{ __('messages.time') }}</label><input class="form-control mb-2" type="time" id="hair_cutting_time" name="hair_cutting_time" value="{{ old('hair_cutting_time', $timeForInput($settings?->hair_cutting_time)) }}"><label class="form-label" for="hair_cutting_desc">{{ __('messages.details') }}</label><textarea class="form-control" id="hair_cutting_desc" name="hair_cutting_desc" rows="2" maxlength="2000">{{ old('hair_cutting_desc', $settings?->hair_cutting_desc) }}</textarea>
                        <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                    </div>
                    <div class="col-md-6 ceremony-row">
                        <h3 class="h6">{{ __('messages.knot_tying') }}</h3><label class="form-label" for="knot_tying_icon">{{ __('messages.default_icon') }}</label><select class="form-select mb-2" id="knot_tying_icon" name="knot_tying_icon">@foreach ($ceremonyIcons as $icon => $label)<option value="{{ $icon }}" @selected(old('knot_tying_icon', in_array($settings?->knot_tying_icon, array_keys($ceremonyIcons), true) ? $settings->knot_tying_icon : 'heart') === $icon)>{{ $label }}</option>@endforeach</select><label class="form-label" for="knot_tying_icon_image">{{ __('messages.custom_icon_image') }}</label><input class="form-control form-control-sm mb-2" type="file" id="knot_tying_icon_image" name="knot_tying_icon_image" accept="image/png,image/jpeg,image/svg+xml,image/webp">@if ($settings?->knot_tying_icon && str_starts_with($settings->knot_tying_icon, 'ceremony_icons/'))<img class="logo-preview mb-2" style="width:64px;height:64px" src="{{ asset('storage/' . $settings->knot_tying_icon) }}" alt="{{ __('messages.current_knot_tying_icon') }}">@endif<label class="form-label" for="knot_tying_time">{{ __('messages.time') }}</label><input class="form-control mb-2" type="time" id="knot_tying_time" name="knot_tying_time" value="{{ old('knot_tying_time', $timeForInput($settings?->knot_tying_time)) }}"><label class="form-label" for="knot_tying_desc">{{ __('messages.details') }}</label><textarea class="form-control" id="knot_tying_desc" name="knot_tying_desc" rows="2" maxlength="2000">{{ old('knot_tying_desc', $settings?->knot_tying_desc) }}</textarea>
                        <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                    </div>
                    <div class="col-md-6 ceremony-row">
                        <h3 class="h6">{{ __('messages.evening_reception') }}</h3><label class="form-label" for="evening_reception_icon">{{ __('messages.default_icon') }}</label><select class="form-select mb-2" id="evening_reception_icon" name="evening_reception_icon">@foreach ($ceremonyIcons as $icon => $label)<option value="{{ $icon }}" @selected(old('evening_reception_icon', in_array($settings?->evening_reception_icon, array_keys($ceremonyIcons), true) ? $settings->evening_reception_icon : 'glass') === $icon)>{{ $label }}</option>@endforeach</select><label class="form-label" for="evening_reception_icon_image">{{ __('messages.custom_icon_image') }}</label><input class="form-control form-control-sm mb-2" type="file" id="evening_reception_icon_image" name="evening_reception_icon_image" accept="image/png,image/jpeg,image/svg+xml,image/webp">@if ($settings?->evening_reception_icon && str_starts_with($settings->evening_reception_icon, 'ceremony_icons/'))<img class="logo-preview mb-2" style="width:64px;height:64px" src="{{ asset('storage/' . $settings->evening_reception_icon) }}" alt="{{ __('messages.current_evening_reception_icon') }}">@endif<label class="form-label" for="evening_reception_time">{{ __('messages.time') }}</label><input class="form-control mb-2" type="time" id="evening_reception_time" name="evening_reception_time" value="{{ old('evening_reception_time', $timeForInput($settings?->evening_reception_time)) }}"><label class="form-label" for="evening_reception_desc">{{ __('messages.details') }}</label><textarea class="form-control" id="evening_reception_desc" name="evening_reception_desc" rows="2" maxlength="2000">{{ old('evening_reception_desc', $settings?->evening_reception_desc) }}</textarea>
                        <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                    </div>
                </div>
                <div id="custom-ceremonies" data-next-index="{{ count($customCeremonies) }}">
                    @foreach ($customCeremonies as $index => $ceremony)
                    <div class="ceremony-row custom-ceremony" data-ceremony-row>
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h6">{{ __('messages.additional_ceremony') }}</h3><button type="button" class="btn btn-sm btn-outline-danger" data-remove-ceremony>{{ __('messages.remove') }}</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label" for="ceremony-{{ $index }}-title_kh">{{ __('messages.khmer_title') }}</label><input class="form-control" id="ceremony-{{ $index }}-title_kh" name="additional_ceremonies[{{ $index }}][title_kh]" value="{{ $ceremony['title_kh'] ?? '' }}" maxlength="255"></div>
                            <div class="col-md-6"><label class="form-label" for="ceremony-{{ $index }}-title_en">{{ __('messages.english_title') }}</label><input class="form-control" id="ceremony-{{ $index }}-title_en" name="additional_ceremonies[{{ $index }}][title_en]" value="{{ $ceremony['title_en'] ?? '' }}" maxlength="255"></div>
                            <div class="col-md-4"><label class="form-label" for="ceremony-{{ $index }}-time">{{ __('messages.time') }}</label><input class="form-control" type="time" id="ceremony-{{ $index }}-time" name="additional_ceremonies[{{ $index }}][time]" value="{{ $timeForInput($ceremony['time'] ?? null) }}"></div>
                            <div class="col-md-8"><label class="form-label" for="ceremony-{{ $index }}-description">{{ __('messages.details') }}</label><textarea class="form-control" id="ceremony-{{ $index }}-description" name="additional_ceremonies[{{ $index }}][description]" rows="2" maxlength="2000">{{ $ceremony['description'] ?? '' }}</textarea>
                                <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="btn btn-outline-secondary mt-3" type="button" id="add-ceremony">{{ __('messages.add_ceremony') }}</button>
                <template id="ceremony-template">
                    <div class="ceremony-row custom-ceremony" data-ceremony-row>
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h6">{{ __('messages.additional_ceremony') }}</h3><button type="button" class="btn btn-sm btn-outline-danger" data-remove-ceremony>{{ __('messages.remove') }}</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label" for="ceremony-field-title_kh">{{ __('messages.khmer_title') }}</label><input class="form-control" id="ceremony-field-title_kh" data-name="title_kh" maxlength="255"></div>
                            <div class="col-md-6"><label class="form-label" for="ceremony-field-title_en">{{ __('messages.english_title') }}</label><input class="form-control" id="ceremony-field-title_en" data-name="title_en" maxlength="255"></div>
                            <div class="col-md-4"><label class="form-label" for="ceremony-field-time">{{ __('messages.time') }}</label><input class="form-control" type="time" id="ceremony-field-time" data-name="time"></div>
                            <div class="col-md-8"><label class="form-label" for="ceremony-field-description">{{ __('messages.details') }}</label><textarea class="form-control" id="ceremony-field-description" data-name="description" rows="2" maxlength="2000"></textarea>
                                <div class="form-text">{{ __('messages.shared_content_helper') }}</div>
                            </div>
                        </div>
                    </div>
                </template>
            </section>

            <section class="admin-section" id="gallery" aria-labelledby="gallery-title">
                <h2 id="gallery-title">{{ __('messages.pre_wedding_gallery') }}</h2>
                <p class="text-secondary">{{ __('messages.gallery_reorder_help') }}</p>
                <div class="photo-list mb-3" id="existing-photos">
                    @foreach ($photos as $photo)
                    <article class="photo-item" draggable="true" data-photo-item>
                        <input type="hidden" name="photo_order[]" value="{{ $photo->id }}">
                        <img src="{{ asset($photo->photo_path) }}" alt="{{ $photo->caption ?: 'Gallery' }}">
                        <label class="form-check mt-2"><input class="form-check-input" type="checkbox" name="delete_photos[]" value="{{ $photo->id }}"><span class="form-check-label">{{ __('messages.delete') }}</span></label>
                    </article>
                    @endforeach
                </div>
                <label class="form-label" for="pre_wedding_photos">{{ __('messages.upload_gallery_photos') }}</label>
                <input class="form-control" type="file" id="pre_wedding_photos" name="pre_wedding_photos[]" accept="image/jpeg,image/png,image/webp" multiple>
                <div class="form-text">{{ __('messages.photo_upload_help') }}</div>
                <div class="preview-grid mt-3" id="new-photo-previews"></div>
            </section>

            <section class="admin-section" id="effects" aria-labelledby="effects-title">
                <h2 id="effects-title">{{ __('messages.effects_and_audio') }}</h2>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="flower_effect_style">{{ __('messages.falling_flower_style') }}</label><select class="form-select" id="flower_effect_style" name="flower_effect_style">
                            <option value="rumdul_gold" @selected(old('flower_effect_style', $settings?->flower_effect_style ?? 'rumdul_gold') === 'rumdul_gold')>{{ __('messages.flower_romduol') }}</option>
                            <option value="jasmine_white" @selected(old('flower_effect_style', $settings?->flower_effect_style) === 'jasmine_white')>{{ __('messages.flower_jasmine') }}</option>
                            <option value="rose_petal" @selected(old('flower_effect_style', $settings?->flower_effect_style) === 'rose_petal')>{{ __('messages.flower_rose') }}</option>
                            <option value="lotus_petal" @selected(old('flower_effect_style', $settings?->flower_effect_style) === 'lotus_petal')>{{ __('messages.flower_lotus') }}</option>
                            <option value="sparkle_gold" @selected(old('flower_effect_style', $settings?->flower_effect_style) === 'sparkle_gold')>{{ __('messages.flower_sparkles') }}</option>
                        </select></div>
                    <div class="col-md-6"><label class="form-label" for="background_audio_file">{{ __('messages.background_music') }}</label><input class="form-control" type="file" id="background_audio_file" name="background_audio_file" accept="audio/mpeg,.mp3">
                        <div class="form-text">{{ __('messages.maximum_8_mb') }} @if ($settings?->background_audio_file)<a href="{{ asset($settings->background_audio_file) }}" target="_blank" rel="noopener">{{ __('messages.play_current_file') }}</a>@endif</div>
                    </div>
                </div>
            </section>

            <section class="admin-section" id="gifts" aria-labelledby="gift-title">
                <h2 class="section-title" id="gift-title">{{ __('messages.traditional_gifts') }}</h2>
                @foreach (['aba' => 'ABA Bank', 'acleda' => 'ACLEDA Bank', 'wing' => 'Wing Bank'] as $bank => $bankLabel)
                <fieldset class="bank-row">
                    <legend class="h6">{{ $bankLabel }}</legend>
                    <label class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" name="enable_{{ $bank }}" value="1" @checked(old('enable_'.$bank, $settings?->{'enable_'.$bank} ?? false))><span class="form-check-label">{{ __('messages.show_bank') }}</span></label>
                    <div class="row g-3">
                        <div class="col-md-4"><label class="form-label" for="{{ $bank }}_account_name">{{ __('messages.account_holder') }}</label><input class="form-control" id="{{ $bank }}_account_name" name="{{ $bank }}_account_name" value="{{ old($bank.'_account_name', $settings?->{$bank.'_account_name'}) }}" maxlength="255"></div>
                        <div class="col-md-4"><label class="form-label" for="{{ $bank }}_account_usd">{{ __('messages.usd_account') }}</label><input class="form-control" id="{{ $bank }}_account_usd" name="{{ $bank }}_account_usd" value="{{ old($bank.'_account_usd', $settings?->{$bank.'_account_usd'}) }}" maxlength="100"></div>
                        <div class="col-md-4"><label class="form-label" for="{{ $bank }}_account_khr">{{ __('messages.khr_account') }}</label><input class="form-control" id="{{ $bank }}_account_khr" name="{{ $bank }}_account_khr" value="{{ old($bank.'_account_khr', $settings?->{$bank.'_account_khr'}) }}" maxlength="100"></div>
                    </div>
                </fieldset>
                @endforeach
                <div class="mt-3"><label class="form-label" for="qr_code_image">{{ __('messages.khqr_image') }}</label><input class="form-control" type="file" id="qr_code_image" name="qr_code_image" accept="image/jpeg,image/png,image/webp">
                    <div class="form-text">{{ __('messages.khqr_file_help') }}</div>
                    @if ($settings?->qr_code_image)<img class="current-qr mt-2" src="{{ asset($settings->qr_code_image) }}" alt="{{ __('messages.current_khqr') }}">@endif
                </div>
            </section>

            <div class="d-flex flex-wrap gap-2 mt-4 mb-5"><button class="btn btn-success px-4" id="save-wedding-settings" type="submit">{{ __('messages.save_details') }}</button><a class="btn btn-outline-secondary" href="{{ route('wedding.show') }}?v={{ time() }}" target="_blank" rel="noopener">{{ __('messages.preview_invitation') }}</a></div>
        </form>
    </main>
    <script>
        const adminMessages = @json(['photoCaption' => __('messages.photo_caption'), 'remove' => __('messages.remove')]);
        const weddingSettingsForm = document.getElementById('weddingSettingsForm');
        const saveWeddingSettings = () => localStorage.setItem('wedding_data_updated', Date.now());
        weddingSettingsForm.addEventListener('submit', saveWeddingSettings);
        document.getElementById('save-wedding-settings').addEventListener('click', saveWeddingSettings);

        const primaryColor = document.getElementById('primary_color');
        const secondaryColor = document.getElementById('secondary_color');
        const themePreview = document.getElementById('theme-preview');
        const themePreviewButton = document.getElementById('theme-preview-button');
        const updateThemePreview = () => {
            themePreview.style.borderColor = primaryColor.value;
            themePreview.style.color = secondaryColor.value;
            themePreviewButton.style.backgroundColor = primaryColor.value;
            themePreviewButton.style.color = secondaryColor.value;
        };
        [primaryColor, secondaryColor].forEach(input => input.addEventListener('input', updateThemePreview));
        updateThemePreview();
        document.getElementById('resetColorBtn').addEventListener('click', () => {
            primaryColor.value = '#D4AF37';
            secondaryColor.value = '#8B0000';
            updateThemePreview();
        });

        const ceremonyList = document.getElementById('custom-ceremonies');
        let ceremonyIndex = Number(ceremonyList.dataset.nextIndex);
        document.getElementById('add-ceremony').addEventListener('click', () => {
            if (ceremonyList.querySelectorAll('[data-ceremony-row]').length >= 12) return;
            const row = document.getElementById('ceremony-template').content.firstElementChild.cloneNode(true);
            row.querySelectorAll('[data-name]').forEach(input => {
                const fieldName = input.dataset.name;
                input.name = `additional_ceremonies[${ceremonyIndex}][${fieldName}]`;
                input.id = `ceremony-${ceremonyIndex}-${fieldName}`;
                row.querySelector(`label[for="ceremony-field-${fieldName}"]`).htmlFor = input.id;
            });
            ceremonyIndex++;
            ceremonyList.append(row);
        });
        ceremonyList.addEventListener('click', event => {
            if (event.target.closest('[data-remove-ceremony]')) event.target.closest('[data-ceremony-row]').remove();
        });

        const photoInput = document.getElementById('pre_wedding_photos');
        const previewList = document.getElementById('new-photo-previews');
        let selectedPhotos = [];
        photoInput.addEventListener('change', () => {
            selectedPhotos = [...photoInput.files];
            renderPhotoPreviews();
        });

        function renderPhotoPreviews() {
            previewList.replaceChildren();
            selectedPhotos.forEach((file, index) => {
                const tile = document.createElement('div');
                tile.className = 'preview-tile';
                const image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                const caption = document.createElement('input');
                caption.type = 'text';
                caption.name = `photo_captions[${index}]`;
                caption.maxLength = 255;
                caption.className = 'form-control form-control-sm mt-2';
                caption.placeholder = adminMessages.photoCaption;
                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'btn btn-sm btn-outline-danger mt-2 w-100';
                remove.textContent = adminMessages.remove;
                remove.addEventListener('click', () => {
                    selectedPhotos.splice(index, 1);
                    const transfer = new DataTransfer();
                    selectedPhotos.forEach(selected => transfer.items.add(selected));
                    photoInput.files = transfer.files;
                    renderPhotoPreviews();
                });
                tile.append(image, caption, remove);
                previewList.append(tile);
            });
        }

        const existingPhotos = document.getElementById('existing-photos');
        let draggedPhoto = null;
        existingPhotos.querySelectorAll('[data-photo-item]').forEach(item => {
            item.addEventListener('dragstart', () => {
                draggedPhoto = item;
                item.classList.add('dragging');
            });
            item.addEventListener('dragend', () => {
                item.classList.remove('dragging');
                draggedPhoto = null;
            });
            item.addEventListener('dragover', event => event.preventDefault());
            item.addEventListener('drop', event => {
                event.preventDefault();
                if (!draggedPhoto || draggedPhoto === item) return;
                const bounds = item.getBoundingClientRect();
                existingPhotos.insertBefore(draggedPhoto, event.clientY < bounds.top + bounds.height / 2 ? item : item.nextSibling);
            });
        });
    </script>
</body>

</html>