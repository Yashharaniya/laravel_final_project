<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
class AdminController extends Controller
{

    public function category()
    {
        $data=category::all();
        return view('admin.category',compact('data'));
    }
    
    public function add_product(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category' => 'required|exists:categories,id',
        'quantity' => 'required|integer',
        'price' => 'required|numeric',
        'discount_price' => 'required|numeric',
    ]);

    // Handle the image upload
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
    }

    // Save product data to the database
         Product::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageName ?? null,
        'category_id' => $request->category,
        'quantity' => $request->quantity,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
    ]);

    return redirect()->back()->with('message', 'Product added successfully');
}


    public function view_product()
    {
        $data=category::all();
        return view('admin.product',compact('data'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }
     public function showpro()
    {
           $products = Product::with('category')->get();
        return view('admin.showpro', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Category;
        $data->Category_name = $request->category; // Ensure this matches the column name in your table

        $data->save();

        return redirect()->back()->with('message', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function showEditForm($id)
{
    $product = Product::findOrFail($id); // Fetch the product by ID
    $data = Category::all(); // Fetch all categories

    return view('admin.update', compact('product', 'data'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id); // Fetch the product by ID

    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'quantity' => 'required|integer',
        'price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'category_id' => 'required|exists:categories,id', // Validate the category ID
        'image' => 'nullable|image|max:2048', // Validate the image if present
    ]);
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }
    // Update the product with validated data
    $product->title = $request->input('title');
    $product->description = $request->input('description');
    $product->quantity = $request->input('quantity');
    $product->price = $request->input('price');
    $product->discount_price = $request->input('discount_price');
    $product->category_id = $request->input('category_id'); // Update the category ID


    $product->save(); // Save the updated product

    return redirect()->route('show_update_product', $id)->with('message', 'Product updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $data = Category::find($id);

    if ($data) {
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    } else {
        return redirect()->back()->with('error', 'Category not found');
    }
    }
    public function delete_product(string $id)
    {
        $data = Product::find($id);
    
        if ($data) {
            $data->delete();
            return redirect()->back()->with('message', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }
}
