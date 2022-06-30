<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use GuzzleHttp\Psr7\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->ProductModel = new ProductModel();  
        // $this->middleware('auth');  
    }

    public function index()
    {
        $data = [
            'product' => $this->ProductModel->allData(),
        ];
        return view('product/v_product', $data);
    }

    public function detail($product_id)
    {
        if(!$this->ProductModel->detailData($product_id))
        {
            abort(404);
        }

        $data = [
            'product' => $this->ProductModel->detailData($product_id),
        ];
        return view('product/v_detail_product', $data);
    }

    public function addPage()
    {
        return view('product/v_add_product');
    }

    public function addData()
    {
        Request()->validate([
            'name' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'description' => 'required|max:240',
            'category' => 'required',
            'picture' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2048'
        ]);

        // Jika validasi berhasil, maka simpan data
        
        // --> Upload gambar / foto 
        $nextID = $this->ProductModel->getBiggestID()->product_id + 1;

        $file = Request()->picture;
        $fileName = $nextID . '.' . $file->extension();
        $file->move(public_path('product_images'), $fileName);

        $data = [
            'product_id' => $nextID,
            'name' => Request()->name,
            'price' => Request()->price,
            'description' => Request()->description,
            'category' => Request()->category,
            'picture' => $fileName
        ];
        
        $query = $this->ProductModel->addData($data);

        if($query)
        {
            return redirect()->route('product')->with('success', 'Data Added Successfully!!!');
        }
        else
        {
            return redirect()->route('product')->with('failed', 'Something went wrong');
        }
        
    }
    
    public function editPage($product_id)
    {
        if(!$this->ProductModel->detailData($product_id))
        {
            abort(404);
        }

        $data =[
            'product' => $this->ProductModel->detailData($product_id),
        ];
        return view("product/v_edit_product", $data);
    }

    public function editData($product_id)
    {
        Request()->validate([
            'name' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'description' => 'required|max:240',
            'category' => 'required',
            'picture' => 'image|mimes:jpg,jpeg,bmp,png|max:2048'
        ]);

        // Jika validasi berhasil, maka simpan data

        if(Request()->picture != "")
        {
            // --> Upload gambar / foto 

            $file = Request()->picture;
            $fileName = $product_id . '.' . $file->extension();
            $file->move(public_path('product_images'), $fileName);

            $data = [
                'name' => Request()->name,
                'price' => Request()->price,
                'description' => Request()->description,
                'category' => Request()->category,
                'picture' => $fileName
            ];
            
            $query = $this->ProductModel->editData($product_id, $data);

            $isDataExactlyTheSame = !empty($this->ProductModel->checkVerySpecificData($data));

            if($isDataExactlyTheSame)
            {
                $query = true;
            }
        }
        else
        {
            $data = [
                'name' => Request()->name,
                'price' => Request()->price,
                'description' => Request()->description,
                'category' => Request()->category
            ];
            
            $query = $this->ProductModel->editData($product_id, $data);
        }

        if($query)
        {
            return redirect()->route('product')->with('success', 'Data Updated Successfully!!!');
        }
        else
        {
            return redirect()->route('product')->with('failed', 'Something went wrong');
        }
    }

    public function deleteData($product_id)
    {
        // Hapus foto
        $product = $this->ProductModel->detailData($product_id);
        if($product->picture != "")
        {
            unlink(public_path('/product_images/') . $product->picture);
        }

        // Hapus data dalam database
        $query = $this->ProductModel->deleteData($product_id);

        if($query)
        {
            return redirect()->route('product')->with('success', 'Data Deleted Successfully !!!');
        }
        else
        {
            return redirect()->route('product')->with('failed', 'Something went wrong');
        }
    }
}
