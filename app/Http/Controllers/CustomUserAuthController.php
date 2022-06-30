<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LoginModel;

use App\Models\RegisterModel;

use App\Models\UserModel;

class CustomUserAuthController extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->LoginModel = new LoginModel();
        $this->RegisterModel = new RegisterModel();
    }

    public function login()
    {
        return view('v_login');
    }

    public function register()
    {
        return view('v_register');
    }

    public function registerSubmit()
    {
        Request()->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'username' => 'required||alpha_dash|min:5|unique:users,username',
            'password_input' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            'confirm_password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:password_input',
            'birth_date' => 'required|date|before_or_equal:-18 year',
            'sex' => 'required'
        ], [
            'username.unique' => 'This username has already been used',
            'birth_date.before_or_equal' => 'User must be at least 18 years old.',
            'confirm_password.same' => 'Confirm password must be the same as password.'
        ]);

        $nextID = $this->UserModel->getBiggestID()->user_id + 1;
        $salt = rand(100, 100000);
        $hashedPassword = hash("sha256", Request()->password_input . $salt, false);

        $data = [
            'user_id' => $nextID,
            'first_name' => Request()->first_name,
            'last_name' => Request()->last_name,
            'username' => Request()->username,
            'password' => $hashedPassword,
            'salt' => $salt,
            'birth_date' => Request()->birth_date,
            'sex' => Request()->sex,
            'type' => "user"
        ];

        $query = $this->UserModel->addData($data);

        if($query)
        {
            return redirect()->route('login');
        }
        else
        {
            return redirect()->route('register')->with('failed', 'Something went wrong');
        }
    }   

    public function loginSubmit()
    {
        Request()->validate([
            'username' => 'required||alpha_dash|min:5',
            'password_input' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
        ]);

        if(isset($_POST['g-recaptcha-response']))
        {
            $captcha = $_POST['g-recaptcha-response'];
            $str = "https://www.google.com/recaptcha/api/siteverify?"
                ."secret=6LdDEIEaAAAAAH6-m4xpyeZyPiEPTp3kzAMFh5_v"
                ."&response=".$captcha."&remoteip" . $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents($str);
            $response_arr = (array) json_decode($response);
            if($response_arr["success"] == false)
            {
                return back()->with('failed', 'Recaptcha failed');
            }
        } 
        else
        {
            return back()->with('failed', 'Recaptcha failed');
        } 

        $userData = $this->UserModel->getByUsername(Request()->username);
        if($userData)
        {
            $salt = $userData->salt;
            $hashedPassword = hash("sha256", Request()->password_input . $salt, false);

            if($userData->password == $hashedPassword)
            {
                if($userData->type == 'admin')
                {
                    Request()->session()->put('LoggedAdmin', $userData->user_id);

                    return redirect('/product');
                }
                else if($userData->type == 'user')
                {
                    Request()->session()->put('LoggedUser', $userData->user_id);

                    return redirect('/');
                }
            }
            else
            {
                return back()->with('failed', 'Incorrect Username / Password');
            }
        }
        else
        {
            return back()->with('failed', 'Incorrect Username / Password');
        }
    }

    function logout()
    {
        if(session()->has('LoggedAdmin'))
        {
            session()->pull('LoggedAdmin');
            return redirect('/');
        }
        else if(session()->has('LoggedUser'))
        {
            session()->pull('LoggedUser');
            return redirect('/');
        }
    }
}