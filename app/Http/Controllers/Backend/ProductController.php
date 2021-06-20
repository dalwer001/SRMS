<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductCategory;
use App\Models\Task;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{



    // get method
    public function products(Request $request)
    {
        // dd($request->input('category_id'));
        $categories = ProductCategories::all();

        if ($request->input('category_id')) {
            $products = Product::where('category_id', $request->input('category_id'))->paginate(10);
            return view('backend.contents.products.products-list', compact('products', 'categories'));

            // dd($products);
        } else {
            $products = Product::paginate(10);
        }

        $search = $request->input('search');

        if ($request->has('search')) {
            $products = Product::where('name', 'like', "%{$search}%")->paginate(10);
        } else {
            $products = Product::paginate(10);
        }



        return view('backend.contents.products.products-list', compact('products', 'categories', 'search'));
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
            'generic' => 'required',
            'category_id' => 'required',
            'quantity' => 'required|gt:0',
            'unit_price' => 'required|gt:0'
        ]);


        Product::create([
            'name' => $request->name,
            'generic' => $request->generic,
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
        try {
            $products->delete();
            return redirect()->route('products.list')->with('error-message', 'Product deleted successfully.');
        } catch (Throwable $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error-message', 'This product already given as a task or have sale.');
            }
            return back();
        }
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
        // $request->validate([
        //     'quantity' => 'required',
        // ]);

        $products = Product::find($request->id);

        $request->validate([

            'quantity' => 'required|gt:0',
            'unit_price' => 'required|gt:0'
        ]);

        if ($request->hasFile('product_image')) {

            $image_path = public_path() . '/files/product/' . $products->image;

            if ($products->image) {
                unlink($image_path);
            }

            $file_name = '';

            $file = $request->file('product_image');
            if ($file->isValid()) {
                $file_name = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('product', $file_name);
            }

            $products->update([
                'image' => $file_name
            ]);
        }
        $products->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price
        ]);

        return redirect()->route('products.list')->with('success-message', 'Product updated successfully');
    }


    //categories get method
    public function categories(Request $request)
    {
        $categories = ProductCategories::paginate(10);

        $search = $request->input('search');

        if ($request->has('search')) {
            $categories = ProductCategories::where('name', 'like', "%{$search}%")->paginate(10);
        } else {
            $categories = ProductCategories::paginate(10);
        }

        // dd($productCategories);

        return view('backend.contents.products.product-categories-list', compact('categories', 'search'));
    }



    //product categories post method
    public function category_create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_categories',
            'description' => 'required'
        ]);

        ProductCategories::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('products.categories')->with('success-message', 'Employee created successfully.');
    }

    //
    public function category_delete($id)
    {
        $productCategory = ProductCategories::find($id);
        try {
            $productCategory->delete();
            return redirect()->route('products.categories');
        } catch (Throwable $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error-message', 'This product category already have products.');
            }
            return back();
        }
    }

    //category edit
    public function category_edit($id)
    {
        $productCategory = ProductCategories::find($id);
        return view('backend.contents.products.product-categories-edit-list', compact('productCategory'));
    }

    public function category_update(Request $request)
    {

        $productCategory = ProductCategories::find($request->id);

        $productCategory->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('products.categories')->with('success-message', 'Product Category updated successfully');
    }

    // public function productCategorySearch(Request $request)
    // {
    //     // dd($request->all());

    //     $search = $request->search;

    //     if ($search) {
    //         $categories = ProductCategories::where('name', 'like', '%' . $search . '%')->paginate(10);
    //     } else {
    //         $categories = ProductCategories::paginate(10);
    //     }


    //     // where(name=%search%)
    //     $title = "Search result";
    //     return view('backend.contents.products.product-categories-list', compact('title', 'categories', 'search'));
    // }


    public function statusUpdate($id, $status)
    {
        $products = Product::find($id);
        $products->update(['status' => $status]);

        return redirect()->back()->with('success-message', $products->name . ' is ' . $status . '.');
    }
}
