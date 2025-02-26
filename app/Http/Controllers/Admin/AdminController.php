<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\authAdminRequest;

class AdminController extends Controller
{
    //
    public function index(){
        $todayOrders = Order::whereDay('created_at',Carbon::today())->get();
        $yesterdayOrders = Order::whereDay('created_at',Carbon::yesterday())->get();
        $monthOrders = Order::whereDay('created_at',Carbon::now()->month)->get();
        $yearOrders = Order::whereDay('created_at',Carbon::now()->year)->get();

        return view('admin.index')->with([
            'todayOrders'=>$todayOrders,
            'yesterdayOrders'=>$yesterdayOrders,
            'monthOrders'=> $monthOrders,
            'yearOrders'=>$yearOrders,
        ]);


    }

        public function login()
    {   
        if (!Auth::guard('admin')->check()) {
            return view('login');
        }
        return redirect()->route('admin.index');
    }

    public function auth(AuthAdminRequest $request)
    {   
        if ($request->validated()) {
            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.login')->with([
                    'error' => 'These credentials do not match any of our records.'
                ]);
            }
        }
    }

    public function logout()
    {   
        if (Auth::guard('admin')->logout()) {
        return redirect()->route('admin.login');
    }
    }

}
