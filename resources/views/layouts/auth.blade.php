<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">  
    @yield('title')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/css/uikit.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit-icons.min.js"></script>
</head>
<body>
    <div class="uk-background-primary uk-light uk-margin-bottom">
        <div class="uk-container">
            <nav class="uk-navbar-container uk-navbar-transparent uk-margin" uk-navbar>
                <div class="uk-navbar-left">
                    <div class="uk-navbar-item">
                        <a href="/" class="uk-logo uk-text-uppercase uk-flex uk-flex-middle" style="color: #fff;">
                            <span uk-icon="icon: users; ratio:1.7" class="uk-margin-small-right"></span>{{ config('app.name') }}
                        </a>
                    </div>
                </div>
                <div class="uk-navbar-right">
                @auth
                    <div class="uk-navbar-item uk-visible@s">
                        {{ Auth::user()->name }}
                    </div>  
                    <div class="uk-navbar-item uk-hidden@s">
                        <a href="#sidebar" class="uk-icon-link" uk-icon="menu" uk-toggle="target: #sidebar"></a>
                    </div>              
                @endauth
                </div>
            </nav>              
        </div>
    </div>
    <div class="uk-container" style="min-height: calc(100vh - 161px);">
        @yield('content')
    </div>
    <section class="uk-section uk-section-xsmall uk-section-muted uk-text-center uk-text-small uk-text-uppercase" style="background: #f3f3f3;">
        &copy; @php echo date('Y'); @endphp
    </section>
</body>
</html>