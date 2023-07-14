<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Boekoe - Profile</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('/')}}assets/img/favicon-2.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/all.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/style.css">
</head>

<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light p-1 border-bottom" id="nav-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="nav-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
                        <span class="image-circle"><img src="{{Auth::user()->image? Auth::user()->image_url:Auth::user()->default_img}}" width="30" alt=""></span>
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('user.home')}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{url('logout')}}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-muted"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR END -->
<!-- HEADER -->
<section class="header py-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="headings">
                    <h3><a href="{{route('bookshop.home')}}" class="text-blue"> Boekoe.</a></h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="shopping-cart text-right">
                    <a href="{{route('cart')}}" class="text-white"><i class="fas fa-shopping-cart fa-2x m-1"></i>
                        @if(Cart::content()->count())
                            <span class="count-cart">{{Cart::content()->count()}}</span>
                        @endif
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- HEADER END -->

@yield('content')

<footer class="py-3 text-center border-top bg-light">
    <div class="container">
        <div class="go-to-top mb-2">
            <a href="#nav-top" class="text-muted" title="Go to top"><i class="fas fa-angle-double-up"></i></a>
        </div>
    </div>
</footer>



<!-- jQuery -->
<script type="text/javascript" src="{{asset('/')}}assets/js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('/')}}assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript" src="{{asset('/')}}assets/js/script.js"></script>

</body>

</html>
