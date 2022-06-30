<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Restoran-if430</title>
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap-4.6.0-dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap-4.6.0-dist/js/bootstrap.min.js') }}"></script> --}}

    
    <link rel="stylesheet" href="{{asset('css/v_register.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
        <h1>Register</h1>
        <h2>Register before logging in!</h2>
    </div>

    <div class="FormContainer">
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="name-section" >
                <input type="text" name="first_name" autocomplete="off" placeholder=" "
                value="{{ old('first_name') }}" required/>
                <label for="first_name" class="label-name">
                    <span class="content-name">First Name</span>
                </label>
            </div>
            <div class="text-danger">
                @error('first_name'){{ $message }}@enderror
                
                @if (session('failed'))
                    {{ session('failed') }}
                @endif
            </div>

            <div class="name-section" >     
                <input type="text" name="last_name" autocomplete="off" placeholder=" "
                value="{{ old('last_name') }}" required/>
                <label for="last_name" class="label-name">
                    <span class="content-name">Last Name</span>
                </label>
            </div>
            <div class="text-danger">
                @error('last_name'){{ $message }}@enderror
            </div>

            <div class="name-section" style="margin-top:30px;">
                <label for="birth_date" class="BirthdayInput"> Birth Day</label>
                <input type="date" name="birth_date" id="birth_date"
                value="{{ old('birth_date') }}" required/>
            </div>
            <div class="text-danger">
                @error('birth_date'){{ $message }}@enderror
            </div>

            <div class="radio-btn">
                <p>Please select your gender:</p>
                    <input type="radio" id="male" name="sex" value="Male"
                    @if (old('sex') === "Male") 
                        checked
                    @endif required/>
                    <label for="male">Male</label><br>
                    <input type="radio" id="female" name="sex" value="Female"
                    @if (old('sex') === "Female") 
                        checked
                    @endif required/>
                    <label for="female">Female</label><br>
            </div>
            <div class="text-danger-sex">
                @error('sex'){{ $message }}@enderror
            </div>

            <div class="name-section">
                <input type="text" name="username" autocomplete="off" placeholder=" "
                value="{{ old('username') }}" required/>
                <label for="username" class="label-name">
                    <span class="content-name">Username</span>
                </label>
            </div>
            <div class="text-danger">
                @error('username'){{ $message }}@enderror
            </div>

            <div class="name-section">
                <input type="password" name="password_input" placeholder=" "
                value="{{ old('password_input') }}" required/>
                <label for="password_input" class="label-name">
                    <span class="content-name">Password</span>
                </label>
            </div>
            <div class="text-danger">
                @error('password_input'){{ $message }}@enderror
            </div>

            <div class="name-section">
                <input type="password" name="confirm_password" autocomplete="off" placeholder=" "
                value="{{ old('confirm_password') }}" required/>
                <label for="confirm_password" class="label-name">
                    <span class="content-name">Confirm Password</span>
                </label>
            </div>
            <div class="text-danger">
                @error('confirm_password'){{ $message }}@enderror
            </div>

            <button type='submit' name='submit' class='btn1'>Register</button>
            <a class='btn2' href="/login">Login</a>
            <a class='btn3' href="/">Home</a>
        </form> 
        
            
          
    </div>
</body>
</html>