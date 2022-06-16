<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FAQs @yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/_app.css') }}" />
</head>
<body>
    <div class="page">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="RIUF" class="img-fluid">
                        </a>
                    </div>
    
                    <div class="col-lg-10 mt-1">
                        <h1 class="page-title">Frequently Asked Questions</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-main">
            @yield('b-content')
        </div>
    </div>
</body>
</html>