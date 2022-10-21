<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Guía @yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    <script src="{{ asset('assets/js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '/'
        });
    </script>

    <!-- Dashboard Core -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{ asset('assets/plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/plugins/charts-c3/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('assets/plugins/input-mask/plugin.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/_app.css') }}" />
</head>
<body>
    <div class="page">
        @auth
            <div class="page-main">
                @include('partials.navigation')
                
                @include('partials.success-alert')

                @yield('content')
            </div>
            @include('partials.footer')
        @else
            <div class="page-single">
                <div class="container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endauth
    </div>

    @if (Auth::check() && in_array(Auth::guard()->user()->getGuardType(), ['teacher', 'student']))
        <script type="module">
            import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js'
            import { getMessaging, onMessage, getToken } from 'https://www.gstatic.com/firebasejs/9.10.0/firebase-messaging.js'

            const firebaseConfig = {
                apiKey: "AIzaSyBxy48WO_nASE2uVeopqElydRDzQJS58FI",
                authDomain: "guia-d25c6.firebaseapp.com",
                projectId: "guia-d25c6",
                storageBucket: "guia-d25c6.appspot.com",
                messagingSenderId: "20366400082",
                appId: "1:20366400082:web:32486f15acd26c2c711d8b",
                measurementId: "G-DZ671TQVVZ"
            };
            
            const app = initializeApp(firebaseConfig);

            const messaging = getMessaging(app);

            (() => {
                Notification.requestPermission().then((permission) => {
                    if (permission !== 'granted') {
                        console.log('Notification permission denied.');
                    }
                })

                getToken(
                    messaging,
                    { vapidKey: 'BKwm-KN83Ye-FQxIpBWW309TvbktD94C7BTQb3CdDDvU7Tm5kSsXcbQUJJQD8VPD-IJqVoV57O82ZHxghcHr2wE' }
                ).then((currentToken) => {
                    if (currentToken) {
                        $.ajaxSetup({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                        });
                        $.ajax({
                            url: '{{ route("save-device-token") }}',
                            type: 'POST',
                            data: {
                                token: currentToken
                            },
                            dataType: 'JSON',
                            success: function (response) {
                                // 
                            },
                            error: function (error) {
                                //
                            },
                        });
                    } else {
                        console.log('No registration token available. Request permission to generate one.');
                    }
                }).catch((err) => {
                    // 
                });
            })();

            onMessage(messaging, (payload) => {
                const title = payload.data.title;
                const options = {
                    body: payload.data.body,
                    icon: payload.data.image,
                    clickUrl: payload.data.clickUrl,
                };
                new Notification(title, options);
            });
        </script>
    @endif
</body>
</html>