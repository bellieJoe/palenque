<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />



    <style>
        body {
            background-color: #FDFDFC;
            color: #1b1b18;
        }

        .hero {
            background-color: #9373f6;
            color: white;
            background-position: center center;
            background-size: cover;
            padding: 5rem 1.5rem;
            min-height: 350px;
        }

        .custom-shadow {
            box-shadow: inset 0 0 0 1px rgba(26,26,0,0.16);
        }

        .btn-primary-custom {
            background-color: #563dea;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: #452fc2;
            color: white !important;
        }
    </style>
</head>
<body class="d-flex vh-100">

    <!-- Header -->
    {{-- <header class="w-100 mb-4" style="max-width: 900px;">
        @if (Route::has('login'))
            <div class="d-flex justify-content-end">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-dark btn-sm">
                        Dashboard
                    </a>
                @endauth
            </div>
        @endif
    </header> --}}

    <!-- Main Content -->
    <div class="container h-100">
        <br><br><br><br>
        <br><br><br><br>
        <div class="">

            <div class="row justify-content-center  overflow-hidden ">
                <!-- Text Section -->
                <div class="col-12 col-lg-6 bg-white p-4 p-lg-5 custom-shadow order-1 order-lg-2">
                    <div class="row align-items-center h-100">
                        <div class="" id="login-text">
                            {{-- <h1 class="h5 fw-medium">Palenque</h1> --}}
                            <img src="{{ asset('logo-text.png')}}" alt="">
                            <p class="text-muted">
                                Empowering local markets with smart tools to manage stalls efficiently and monitor prices effortlessly.
                            </p>
                            
                            @auth
                                    <a
                                    href="{{ url('/dashboard') }}"
                                    class="btn btn-primary-custom text-white btn-sm px-4"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a href="#" class="btn btn-primary-custom text-white btn-sm px-4" onclick="showLoginForm()">
                                    Login
                                </a>
                            @endauth
                        </div>
                        <div class=""  id="login-form">
                            <form action="{{ route('login') }}" method="POST" class="">
                                @csrf
                                <h5 class="text-center">Login</h5>
                                <p class="text-muted text-center">Enter your email and password below to log in</p>
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary  btn-sm px-4 me-2" onclick="hideLoginForm()">Back</button>
                                    <button type="submit" class="btn btn-primary-custom text-white btn-sm px-4">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <!-- Hero Image -->
                <div class="col-12 col-lg-5 hero custom-shadow order-2 order-lg-1">
                </div>
    
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function(){
        $("#login-text").show();
        $("#login-form").hide();
        $(".hero").css("background-image", "url('{{ asset('assets/images/fish-close.png') }}')");
    });

    function showLoginForm() {
        $("#login-text").fadeOut(200, function () {
            $("#login-form").fadeIn(300);
            $(".hero").css("background-image", "url('{{ asset('assets/images/fish-open.png') }}')");
        });
    }

    function hideLoginForm() {
        $("#login-form").fadeOut(200, function () {
            $("#login-text").fadeIn(300);
            $(".hero").css("background-image", "url('{{ asset('assets/images/fish-close.png') }}')");
        });
    }
</script>
</html>