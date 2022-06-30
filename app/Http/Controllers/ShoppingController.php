<?php

namespace App\Http\Controllers;

use App\Models\ShoppingModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use GuzzleHttp\Psr7\Request;

class ShoppingController extends Controller
{

    public function __construct()
    {
        $this->ShoppingModel = new ShoppingModel();
        $this->ProductModel = new ProductModel();
        $this->UserModel = new UserModel();
        // $this->middleware('auth');
    }


    public function index()
    {
        $data = [
            'shopping' => $this->ShoppingModel->allData(),
        ];
        return view('shopping_cart/v_shopping_cart', $data);
    }

    public function addPage()
    {
        $data = [
            'user' => $this->UserModel->allData(),
            'product' => $this->ProductModel->allData()
        ];
        return view('shopping_cart/v_add_shopping_cart', $data);
    }

    public function addData()
    {
        Request()->validate([
            'user_id' => 'required|exists:users,user_id',
            'product_id' => 'required|exists:tbl_product,product_id',
            'quantity' => 'required|numeric|min:0'
        ]);

        // Jika validasi berhasil, maka simpan data
        
        // --> Upload gambar / foto 
        $nextID = $this->ShoppingModel->getBiggestID()->shopping_cart_id + 1;
        $productPrice = $this->ProductModel->detailData(Request()->product_id)->price;
        $total = $productPrice * Request()->quantity;

        $data = [
            'shopping_cart_id' => $nextID,
            'user_id' => Request()->user_id,
            'product_id' => Request()->product_id,
            'quantity' => Request()->quantity,
            'total' => $total
        ];
        
        $query = $this->ShoppingModel->addData($data);

        if($query)
        {
            return redirect()->route('shopping_cart')->with('success', 'Data Added Successfully!!!');
        }
        else
        {
            return redirect()->route('shopping_cart')->with('failed', 'Something went wrong');
        }
    }

    public function editPage($shopping_cart_id)
    {
        if(!$this->ShoppingModel->detailData($shopping_cart_id))
        {
            abort(404);
        }

        $shoppingDetailData = $this->ShoppingModel->detailData($shopping_cart_id); 
        $productID = $shoppingDetailData->product_id;
        $userID = $shoppingDetailData->user_id;

        $userDetailData = $this->UserModel->detailData($userID); 
        $productDetailData = $this->ProductModel->detailData($productID); 

        $data =[
            'currShopping' => $shoppingDetailData,
            'currUser' => $userDetailData,
            'currProduct' => $productDetailData,
            'user' => $this->UserModel->allData(),
            'product' => $this->ProductModel->allData()
        ];
        return view("shopping_cart/v_edit_shopping_cart", $data);
    }

    public function editData($shopping_cart_id)
    {
        Request()->validate([
            'user_id' => 'required|exists:users,user_id',
            'product_id' => 'required|exists:tbl_product,product_id',
            'quantity' => 'required|numeric|min:0'
        ]);

        // Jika validasi berhasil, maka simpan data
        
        // --> Upload gambar / foto 
        $productPrice = $this->ProductModel->detailData(Request()->product_id)->price;
        $total = $productPrice * Request()->quantity;

        $data = [
            'user_id' => Request()->user_id,
            'product_id' => Request()->product_id,
            'quantity' => Request()->quantity,
            'total' => $total
        ];
        
        $query = $this->ShoppingModel->editData($shopping_cart_id, $data);

        if($query)
        {
            return redirect()->route('shopping_cart')->with('success', 'Data Updated Successfully!!!');
        }
        else
        {
            return redirect()->route('shopping_cart')->with('failed', 'Something went wrong');
        }
    }

    public function deleteData($shopping_cart_id)
    {
        $query = $this->ShoppingModel->deleteData($shopping_cart_id);

        if($query)
        {
            return redirect()->route('shopping_cart')->with('success', 'Data Deleted Successfully !!!');
        }
        else
        {
            return redirect()->route('shopping_cart')->with('failed', 'Something went wrong');
        }
    }
}
