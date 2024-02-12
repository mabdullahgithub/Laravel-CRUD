<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(4);
        return view('products.index', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha|between:4,9',
            'description' => 'required|alpha|max:65535',
            'image' => 'required|image|mimes:jpeg,png,bmp,gif,svg,webp|max:2048',
        ]);
    
        if ($validator->validate()) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
    
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $imageName;
    
            if ($product->save()) {
                session()->flash('success', 'Product created successfully.');
                return response()->json(['success' => true, 'message' => 'Product Created Successfully']);
            } else {
                session()->flash('error', 'Something went wrong!');
                return back()->withInput();
            }
        } else {
            return back()
                ->withErrors($validator) // Pass the validation errors back to the form
                ->withInput();
        }
        return redirect('/products/create');
    }

    public function edit($id)
    {
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('products.index')
            ->with('error', 'Product not found.');
    }

    return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'nullable|image',
        ]);
        $product = Product::where('id', $id)->first();
        $product->name = $request->name;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $product->image = $filename;
        }

        if ($product->save()) {
            session()->flash('success', 'Product Updated successfully.');
        }

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
    $product = Product::find($id);
    if (!$product) {
        return redirect()->route('products.index')
            ->with('error', 'Product not found.');
    }

    $product->delete();
    session()->flash('success', 'Product deleted successfully.');

    return redirect()->route('products.index');
    }

    public function show($id)
    {
    $product = Product::find($id);

    return view('products.show', compact('product'));
    }

}