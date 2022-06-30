<?php

namespace App\Http\Controllers;

use App\Models\UserModel;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->UserModel = new UserModel();
        // $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'user' => $this->UserModel->allData(),
        ];
        return view('user/v_user', $data);
    }

    public function addPage()
    {
        return view('user/v_add_user');
    }

    public function addData()
    {
        Request()->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'username' => 'required||alpha_dash|min:5|unique:users,username',
            'password_input' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            'confirm_password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:password_input',
            'birth_date' => 'required|date|before_or_equal:-18 year',
            'sex' => 'required',
            'type' => 'required'
        ], [
            'username.unique' => 'This username has already been used',
            'birth_date.before_or_equal' => 'User must be at least 18 years old.',
            'confirm_password.same' => 'Confirm password must be the same as password.'
        ]);

        // Jika validasi berhasil, maka simpan data
        
        // --> Upload gambar / foto 
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
            'type' => Request()->type
        ];
        
        $query = $this->UserModel->addData($data);

        if($query)
        {
            return redirect()->route('user')->with('success', 'Data Added Successfully!!!');
        }
        else
        {
            return redirect()->route('user')->with('failed', 'Something went wrong');
        }
    }

    public function editPage($user_id)
    {
        if(!$this->UserModel->detailData($user_id))
        {
            abort(404);
        }

        $data =[
            'user' => $this->UserModel->detailData($user_id),
        ];
        return view("user/v_edit_user", $data);
    }

    public function editData($user_id)
    {
        $password = Request()->password;

        Request()->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'username' => 'required||alpha_dash|min:5',
            'password_input' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            'confirm_password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:password_input',
            'birth_date' => 'required|date|before_or_equal:-18 year',
            'sex' => 'required',
            'type' => 'required'
        ], [
            'username.unique' => 'This username has already been used',
            'birth_date.before_or_equal' => 'User must be at least 18 years old.',
            'confirm_password.same' => 'Confirm password must be the same as password.'
        ]);

        // Jika validasi berhasil, maka simpan data
        
        // --> Upload gambar / foto 
        $salt = rand(100, 100000);
        $hashedPassword = hash("sha256", Request()->password_input . $salt, false);

        $data = [
            'first_name' => Request()->first_name,
            'last_name' => Request()->last_name,
            'username' => Request()->username,
            'password' => $hashedPassword,
            'salt' => $salt,
            'birth_date' => Request()->birth_date,
            'sex' => Request()->sex,
            'type' => Request()->type
        ];
        
        $query = $this->UserModel->editData($user_id, $data);

        $isDataExactlyTheSame = !empty($this->UserModel->checkVerySpecificData($data));

        if($isDataExactlyTheSame)
        {
            $query = true;
        }

        if($query)
        {
            return redirect()->route('user')->with('success', 'Data Updated Successfully!!!');
        }
        else
        {
            return redirect()->route('user')->with('failed', 'Something went wrong');
        }
    }

    public function deleteData($user_id)
    {
        $query = $this->UserModel->deleteData($user_id);

        if($query)
        {
            return redirect()->route('user')->with('success', 'Data Deleted Successfully !!!');
        }
        else
        {
            return redirect()->route('user')->with('failed', 'Something went wrong');
        }
    }
}
