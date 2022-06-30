<!DOCTYPE html>
<html>
    <head>
        <title>Restoran-if430</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        
        <link rel="stylesheet" href="{{asset('css/v_login.css')}}">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@900&display=swap" rel="stylesheet">
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
    {{-- <div class="container">
        <div class='modal fade' id='login' tabindex='-1' role='dialog'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title text-center'>Login</h1>
                    </div>
                    <div class='modal-body'>
                        <form method='/' action='index.php'>
                            <div class='form-group row'>
                                <label class='col-sm-3' for='username'>Username:</label>
                                <div class='col-sm-6'>
                                    <input class='form-control' type='text' name='username'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-3' for='password'>Password:</label>
                                <div class='col-sm-6'>
                                    <input class='form-control' type='password' name='password'>
                                </div>
                            </div>
                            <?php //if(isset($valid)&&!$valid){ ?>
                            <p class='text-danger'>Invalid credentials.</p>
                            <?php //} ?>
                            <input type='hidden' name='do' value='check_loginuser.php'>
                            <button type='submit' name='submit' class='btn btnprimary'>Login</button>
                            <button type='submit' name='loc' value='register_user.php' class='btn btn-warning'>Register</button>
                            <button class='btn btn-warning'>
                                <a href="/">Home</a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="header">
        <h1>Login</h1>
        <h2>Login to order your favourite pizza!</h2>
    </div>
    
    <div class="FormContainer">
       
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="name-section" style="margin-top: 50px;">
                <input type="text" name="username" autocomplete="off" placeholder=" " required/>
                <label for="username" class="label-name">
                    <span class="content-name">Username</span>
                </label>
            </div>
            <div class="text-danger">
                @error('username'){{ $message }}@enderror
                @if (session('failed'))
                    {{ session('failed') }}
                @endif
            </div>

            <div class="name-section">
                <input type="password" name="password_input" placeholder=" " required/>
                <label for="password_input" class="label-name">
                    <span class="content-name">Password</span>
                </label>
            </div>

            <div class="text-danger">
                @error('password_input'){{ $message }}@enderror
            </div>

            <div 
                class="g-recaptcha" 
                data-sitekey="6LdDEIEaAAAAAG5pqhaUhyLxVO57VHB9XAbrMpoQ"
                data-theme="dark"
                style="margin-top: 10px;">
            </div>
            
            <button type='submit' name='submit' class='btn1'>Login</button>
            <a class='btn2' href="/register">Register</a>
            <a class='btn3' href="/">Home</a>
        </form>    
        
            
        
    </div>


    {{-- <script  src='https://code.jquery.com/jquery-3.2.1.min.js' ></script>
    <script  src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' ></script> --}}
    {{-- <script type="text/javascript">
        
        $(document).ready(function() {
                
                $('#login').modal({
                    keyboard: false,
                    show: true,
                    backdrop: 'static'
                });
            });
    </script> --}}
    </body>
</html>