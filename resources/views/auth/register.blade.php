<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{asset('log-in/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log-in/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(log-in/images/BOOKS.jpg);">
                    <span class="login100-form-title-1">
                         REGISTER
                    </span>
                </div>

                <form method="POST" action="{{route('register')}}" class="login100-form validate-form">
                    @csrf

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">{{ __('Name') }}</span>
                        <input id="name" class="input100{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" type="text" name="name" placeholder="Masukan Nama Anda" autofocus>
                        <span class="focus-input100"></span>
                    </div>

                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
            
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">

                        <span class="label-input100">{{ __('E-Mail') }}</span>
                        <input id="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" type="email" name="email" placeholder="Masukan Alamat Email" autofocus>
                        <span class="focus-input100"></span>
                    </div>

                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">{{ __('Password') }}</span>
                        <input class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" type="password" name="password" placeholder="Masukan password">
                        <span class="focus-input100"></span>
                    </div>

                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                          
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">{{ __('Confirm Password') }}</span>
                        <input class="input100" id="password-confirm" type="password" name="password_confirmation" placeholder="Masukan ulang password">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                        {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<!--===============================================================================================-->
    <script src="{{asset('log-in/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('log-in/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('log-in/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('log-in/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('log-in/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('log-in/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('log-in/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('log-in/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('log-in/js/main.js')}}"></script>

</body>
</html>
