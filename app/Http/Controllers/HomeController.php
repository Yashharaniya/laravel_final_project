<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use Stripe\Stripe;

class HomeController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        return view('user.cart', ['cart' => $cartItems, 'subtotal' => $subtotal]);
    }
    

    public function removeFromCart(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');
        Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return redirect()->route('cart.show')->with('success', 'Product quantity updated.');
    }

    // Other methods...

    public function shop()
    {
        $categories = Category::all();
        $products = Product::paginate(8);

        return view('user.shop', compact('categories', 'products'));
    }

    public function checkout(Request $request)
    {
        // Perform any additional checks or validations here if needed
    
        // Clear the cart after checkout (example: remove all items from the cart)
        Cart::where('user_id', Auth::id())->delete();
    
        // Redirect to a thank you page or wherever appropriate after successful payment
        return redirect()->route('thankyou')->with('success', 'Payment successful!');
    

    }
    

    public function contactus()
    {
        return view('user.contact');
    }

    public function sendContactUsEmail(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $data = $request->only('fname', 'lname', 'email', 'message');

        Mail::to('info@yashfurnicher.com')->send(new ContactUsMail($data));

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function blogg()
    {
        return view('user.blogg');
    }

    public function services()
    {
        return view('user.services');
    }

    public function about()
    {
        return view('user.about');
    }

    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                return view('user.index');
            } elseif ($usertype == 'admin') {
                return view('admin.adminhome');
            }
        }

        return view('user.index'); // Default to user.index if not authenticated
    }

    public function post()
    {
        return view("post");
    }
}
