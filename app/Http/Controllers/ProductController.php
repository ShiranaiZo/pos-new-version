<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::latest()->get();

        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_method', '_token', 'image');

        $destination = 'assets/attachments/products/';

        $file = $request->file('image');

        if ($file) {
            $file_name = uniqid().'_'.time().'.'.$file->getClientOriginalExtension();
            $move = $file->move($destination, $file_name);

            if ($move) {
                $data['image'] = $destination.$file_name;
            }
        }

        $product = Product::create($data);

        return redirect('products')->with('success', 'Product Saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Example of validation
        // $request->validate([
        //     'role' => 'required',
        //     'email'=>'required|unique:users,email,'.$id.',id,deleted_at,NULL|email:rfc,filter',
        //     'name'=>'required',
        //     'username'=>'required|unique:users,username,'.$id.',id,deleted_at,NULL',
        //     'password'=>'nullable|min:8',
        //     'image'=>'nullable|image',
        //     'your_name_form'=>'required',
        // ]);

        $data = $request->except('_method', '_token', 'image');

        $product = Product::find($id);

        $file = $request->file('image');

        $destination = 'assets/attachments/products/';

        if ($file) {
            $file_name = uniqid().'_'.time().'.'.$file->getClientOriginalExtension();
            $move = $file->move($destination, $file_name);

            if ($move) {
                $data['image'] = $destination.$file_name;
            }
        }


        $product->update($data);

        return redirect('products')->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('products')->with('success', 'Product Deleted!');
    }
}
