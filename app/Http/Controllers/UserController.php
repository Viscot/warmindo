<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    //

    public function index()
    {
        $categories = Category::all();
        $menus = Menu::where('status', 'masih')->with('category')->get();
        return view('customer.index', compact('categories', 'menus'));
    }


    public function showByCategory($id)
    {
        $category = Category::where('id', $id)->first();
        $menus = Menu::where('status', 'masih')->with('category')->where('category_id', $id)->get();
        return view('customer.by-category', compact('category', 'menus'));
    }


    public function searchByName(Request $request)
    {
        $name = $request->query('name');
        $categories = Category::all();
        $menus = Menu::where('status', 'masih')
            ->where('name', 'like', '%' . $name . '%')
            ->with('category')
            ->get();
        return view('customer.index', compact('categories', 'menus'));
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function cart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->where('status', 'pending')->with('details', 'details.menu')->orderBy('created_at', 'asc')->get();
        return view('customer.cart', compact('carts'));
    }

    public function order()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->where('status', '<>', 'pending')->orderBy('created_at', 'desc')->get();
        return view('customer.order', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required'
        ]);

        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->where('status', 'pending')->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id, 'status' => 'pending']);
        }

        $cart->load('details', 'details.menu');

        foreach ($cart->details as $key => $value) {
            if ($value->menu->id == $request->menu_id) {
                return redirect()->back()->with('error', 'ops menu kamu sudah ditambahkan ke cart silahkan checkout sekarang');
            }
        }
        $cartItem = $cart->details()->where('menu_id', $request->menu_id)->first();

        $menu = Menu::where('id', $request->menu_id)->first();

        CartItem::create([
            'cart_id' => $cart->id,
            'menu_id' => $request->menu_id,
            'total_price' => $menu->price
        ]);
        $cart->price += $menu->price;
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function cancelOrder(Request $request)
    {
        Cart::where('id', $request->id)->update([
            'status' => 'cancel'
        ]);

        return redirect()->back()->with('success', 'Item update successfully.');
    }



    public function updateCartItem(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartId = $cartItem->cart_id;

        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $cartItem->menu->price * $request->quantity
        ]);


        $cart = Cart::where('id', $cartId)->with('details')->first();

        $totalPrice = 0;

        foreach ($cart->details as $key => $value) {
            # code...
            $totalPrice += $value->total_price;
        }
        $cart->price = $totalPrice;
        $cart->save();
        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }

    public function removeCartItem(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart successfully.');
    }


    public function checkout()
    {
        // Dapatkan keranjang belanja yang masih berstatus 'pending' untuk pengguna saat ini
        $cart = Cart::where('user_id', auth()->user()->id)->where('status', 'pending')->first();

        $cart->update(['status' => 'proses']);


        return redirect()->back()->with('success', 'Checkout successful. Your order has been placed.');
    }






    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $destinationPath = public_path('/images');

        // Delete the old image if it exists
        if ($user->image && File::exists($destinationPath . '/' . $user->image)) {
            File::delete($destinationPath . '/' . $user->image);
        }

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($destinationPath, $imageName);

        $user->image = $imageName;
        $user->save();

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }
}
