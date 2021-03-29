<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // get method
    public function products()
    {
        $products=Product::all();
        return view('backend.contents.products.products-list',compact('products'));
    }

    //post method
    public function create(Request $request)
    {
        Product::create([
            'name' => $request -> name,
            'quantity' => $request -> quantity,
            'price'=> $request -> price
        ]);
        return redirect()->back();
    }
//DELETE METHOD
    public function delete($id){
        $products=Product::find($id);
        $products->delete();
        return redirect()->route('products.list');
    }

    //edit view
    public function edit($id)
    {

        $products = Product::find($id);
        return view('backend.contents.products.product-edit-list',['products'=>$products]);
    }

// update method
    public function update(Request $request)
    {
        $products=Product::find($request->id);
        $products->name=$request->name;
        $products->quantity=$request->quantity;
        $products->price=$request->price;
        $products->save();
        return redirect()->route('products.list');

    }
}
