<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">

        <div class="row ">
            <div class="col-md-12">
                <h3 class="text-center">This is the welcome page</h3>
            </div>
            <div class="col-md-8 offset-md-2">
                @guest
                <div class="row justify-content-center mt-4">
                    @if(Route::has('login'))
                    <div class="col-md-4 offset-md-1">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block">Login</a>
                    </div>
                    @endif
                    @if (Route::has('register'))
                        
                    <div class="col-md-4 offset-md-1">
                        <a href="{{ route('register') }}" class="btn btn-secondary btn-block">
                            Register
                        </a>
                    </div>
                    @endif
                </div>
                @else

                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-block mt-5" onclick="event.preventDefault();
                    document.getElementById('user-logout-form').submit();">
       {{ __('User Logout') }}
                    </a>
                        <form id="user-logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                @endguest
            </div>

        </div>

        <div class="row mt-5">

            @guest('admin')
            @if(Route::has('admin.login'))    
            <a href="{{ route('admin.login') }}" class="btn btn-primary btn-block">Admin Login</a>
            @endif
            @else

                <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-block" onclick="event.preventDefault();
                document.getElementById('admin-logout-form').submit();">
   {{ __('Admin Logout') }}
                </a>
                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

            @endguest
        </div>
    </div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel">
            @component('components.who')
              
            @endcomponent
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>
