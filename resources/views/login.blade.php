<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Grapiku Docs</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="icon" href="{{ URL::asset('img/favicon-docs.png') }}">
    <link href="{{ URL::asset('css/mdb.min.css'); }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        h4 {
            font-family: "Montserrat";
            font-weight: 700;
        }

        .form-label {
            font-family: "Raleway";
        }

        body {
            background-image: url("{{URL::asset('img/mylogin.jpg')}}");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .input-group-text {
            border: none;
        }
    </style>
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <!-- <div class="d-flex aligns-items-center justify-content-center card w-50 mx-auto">
        <div class="card-body">
            <h2 class="text-center">Grapiku docs</h3>
                <hr>
                @if(session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{session('error')}}
                </div>
                @endif
                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    <hr>
                    <p class="text-center">Belum punya akun? <a href="#">Register</a> sekarang!</p>
                </form>
        </div>
    </div> -->
    <div class="row d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="col-10 col-md-6 col-lg-3 col-xl-3">
            <div class="card" style="border-radius: 20px;">
                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger">
                        <b>Opps!</b> {{session('error')}}
                    </div>
                    @endif
                    <form action="{{ route('actionlogin') }}" method="post">
                        @csrf
                        <div class="mb-3 text-center">
                            <img src="{{URL::asset('img/grapiku-docs.png');}}">
                        </div>
                        <div class="mb-2 text-center">
                            <h4>Welcome</h4>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" placeholder="Masukkan Email" class="form-control primary" required />
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4 input-group">
                            <input type="password" id="password" name="password" placeholder="Masukkan Password" class="input form-control" required />
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="{{URL::asset('js/mdb.min.js');}}"></script>

</html>