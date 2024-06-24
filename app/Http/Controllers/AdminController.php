<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware([AdminMiddleware::class]);
    }


    public function index()
    {


        $totalSoldToday = CartItem::whereDate('created_at', Carbon::today())->sum('quantity');

        // Menghitung total pendapatan hari ini
        $totalRevenueToday = Cart::whereDate('created_at', Carbon::today())->where('status', 'done')->sum('price');


        $monthlyRevenue = Cart::selectRaw('SUM(price) as total, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'done')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Ensure all months are present
        for ($i = 1; $i <= 12; $i++) {
            if (!array_key_exists($i, $monthlyRevenue)) {
                $monthlyRevenue[$i] = 0;
            }
        }
        ksort($monthlyRevenue);



        return view('admin.dashboard.index', compact('totalSoldToday', 'totalRevenueToday', 'monthlyRevenue'));
    }


    public function user()
    {
        $users = User::all();
        return view('admin.dashboard.users', compact('users'));
    }

    public function menu()
    {
        $menus = Menu::all();
        $categories = Category::all();

        return view('admin.dashboard.menu', compact('menus', 'categories'));
    }

    public function menuDestroy(Menu $menu)
    {
        if ($menu->image && file_exists(public_path('images/' . $menu->image))) {
            unlink(public_path('images/' . $menu->image));
        }
        $menu->delete();
        return redirect()->route('admin.menu')->with('success', 'Menu deleted successfully.');
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Menu::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu created successfully.');
    }


    public function menuUpdate(Request $request, Menu $menu)
    {
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image && file_exists(public_path('images/' . $menu->image))) {
                unlink(public_path('images/' . $menu->image));
            }

            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $menu->image = $imageName;
        }

        $menu->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $menu->image,
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu updated successfully.');
    }

    public function orders()
    {
        $pendingOrders = Cart::where('status', 'pending')->with('details.menu')->get();
        $inProgressOrders = Cart::where('status', 'proses')->with('details.menu')->get();
        $doneOrders = Cart::where('status', 'done')->with('details.menu')->get();

        return view('admin.dashboard.orders', compact('pendingOrders', 'inProgressOrders', 'doneOrders'));
    }


    public function update(Request $request, $id)
    {
        $order = Cart::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully');
    }

    public function destroy($id)
    {
        $order = Cart::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
