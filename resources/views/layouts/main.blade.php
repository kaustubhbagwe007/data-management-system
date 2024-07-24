<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>Admin Panel</title>

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        
        @include('components.sidebar')

        <div class="main">
            
            @include('components.header')

            <main class="content">
                
                <!-- 
                    used to show notification is success once session set from controller 
                    notification shown on crud operations
                -->
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible mb-5">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> {{ Session::get('success') }}
                    </div>
                @endif

                @yield('main')

            </main>

            @include('components.footer')
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
