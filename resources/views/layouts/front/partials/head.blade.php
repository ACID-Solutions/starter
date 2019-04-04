<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-language" content="{{ implode(',', LaravelLocalization::getSupportedLanguagesKeys()) }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta content="{{ csrf_token() }}" name="csrf-token" />
    @if(app()->environment() !== 'production'){!! SEO::generate() !!}@else{!! SEO::generate(true) !!}@endif
    <link href="{{ mix('css/front.css') }}" rel="stylesheet" />
    @if(! empty($css))<link href="{{ $css }}" rel="stylesheet" />@endif
    @if($gtm = $settings->google_tag_manager)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $gtm }}');
        </script>
    @endif
    @include('layouts.common.partials.javascript')
</head>
