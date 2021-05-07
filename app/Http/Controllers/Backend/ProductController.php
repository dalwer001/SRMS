<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\Task;
use Illuminate\Http\Request;

class ProductController extends Controller
{



    // get method
    public function products(Request $request)
    {

        if ($request->input('category_id')) {
            $products = Product::where('category_id', $request->input('category_id'))->paginate(5);
        } else {
            $products = Product::paginate(5);
        }

        $categories = ProductCategories::all();

        return view('backend.contents.products.products-list', compact('products', 'categories'));
    }

    //product search
    public function search(Request $request)
    {
        //     $search=$request->search;
        //     if($search){
        //         $product=Product::where('name','like','%'.$search.'%')->paginate(5);
        //     }else
        //     {
        //         $product=Product::with('productCategory')->paginate(5);
        //     }

        //     // where(name=%search%)
        //     $title="Search result";
        //     return view('backend.contents.products.products-list',compact('title','product','search'));
    }



    //post method
    public function create(Request $request)
    {
        //        dd($request->file('product_image')->getClientOriginalExtension());

        $file_name = '';
        //step1: check request has file?
        if ($request->hasFile('product_image')) {
            //file is valid or not
            $file = $request->file('product_image');
            if ($file->isValid()) {
                //generate unique file name
                $file_name = date('Ymdhms') . '.' . $file->getClientOriginalExtension();

                //store image into local directory
                $file->storeAs('product', $file_name);
            }
        }


        $request->validate([
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required'

        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $file_name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price

        ]);
        return redirect()->back()->with('success-message', 'Product Created Successfully.');
    }


    //DELETE METHOD
    public function delete($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect()->route('products.list');
    }

    //edit view
    public function edit($id)
    {

        $products = Product::find($id);
        return view('backend.contents.products.product-edit-list', compact('products'));
    }

    // update method
    public function update(Request $request)
    {

        $products = Product::find($request->id);
        $products->update([
            'name' => $request->name,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('products.list');
    }


    //categories get method
    public function categories()
    {
        $productCategories = ProductCategories::all();
        return view('backend.contents.products.product-categories-list', compact('productCategories'));
    }



    //product categories post method
    public function category_create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:productCategories',
            'description' => 'required'
        ]);

        ProductCategories::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect()->route('products.categories');
    }

    //
    public function category_delete($id)
    {
        $productCategory = ProductCategories::find($id);
        $productCategory->delete();
        return redirect()->route('products.categories');
    }
}
