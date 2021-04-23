<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductController extends Controller
{



    // get method
    public function products()
    {
            
        $categories=ProductCategories::all();
        $products = Product::paginate(3);
        return view('backend.contents.products.products-list', compact('products','categories'));
    }


    //post method
    public function create(Request $request)
    {
        //        dd($request->file('product_image')->getClientOriginalExtension());

        $file_name='';
        //step1: check request has file?
        if($request->hasFile('product_image'))
        {
            //file is valid or not
            $file=$request->file('product_image');
            if($file->isValid())
            {
                //generate unique file name
                $file_name=date('Ymdhms').'.'.$file->getClientOriginalExtension();

                //store image into local directory
                $file->storeAs('product',$file_name);
            }

        }

        $request->validate([
            'name' => 'required',
            'category_id'=>'required',
            'image'=>'required',
            'quantity'=>'required'

        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image'=>$file_name,
            'quantity' => $request->quantity

        ]);
        return redirect()->back()->with('success-message','Product Created Successfully.');
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
        $products->name = $request->name;
        $products->quantity = $request->quantity;

        $products->save();
        return redirect()->route('products.list');
    }

    //categories get method
    public function categories()
    {
        $productCategories= ProductCategories::all();
        return view('backend.contents.products.product-categories-list',compact('productCategories'));
    }

    //product categories post method
    public function category_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description'=>'required'

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
