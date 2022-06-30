<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingModel;
use App\Models\UserModel;
use App\Models\ProductModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->ShoppingModel = new ShoppingModel();
        $this->ProductModel = new ProductModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [
            'shopping' => $this->ShoppingModel->allData(),
            'product' => $this->ProductModel->allData()
        ];

        
        return view('v_home', $data);
    }

    public function order()
    {
        if(session()->has('LoggedUser'))
        {
            Request()->validate([
                'quantity' => 'required|numeric|min:0'
            ]);

            $nextID = $this->ShoppingModel->getBiggestID()->shopping_cart_id + 1;
            $productPrice = $this->ProductModel->detailData(Request()->product_id)->price;
            $total = $productPrice * Request()->quantity;

            $data = [
                'shopping_cart_id' => $nextID,
                'user_id' => session('LoggedUser'),
                'product_id' => Request()->product_id,
                'quantity' => Request()->quantity,
                'total' => $total
            ];

            $query = $this->ShoppingModel->addData($data);
            return redirect('/');
        }
        else
        {
            return redirect('/login')->with('failed', 'Please login to order food / drink');
        }
    }

    public function deleteOrder($shopping_cart_id)
    {
        $this->ShoppingModel->deleteData($shopping_cart_id);

        return redirect('/');
    }
}
