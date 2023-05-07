<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index(Request $request)
  { 
    $orders = Order::all();

  $orders->transform(function($order,$key){
$order->cart= unserialize($order->cart);
return $order;
    }); 
      return view('dashboard.order', compact('orders'));
  }
  public function create(Request $request)
  {
    return  view('dashboard.addorder');
  }
}
