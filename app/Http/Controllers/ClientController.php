<?php

namespace App\Http\Controllers;


use Stripe\Charge;
use Stripe\Stripe;
use App\Cart;
use App\Models\Order;
use App\Mail\SendMail;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $products=Product::all()->where('status',1);
        $sliders=Slider::all()->where('status',1);
        return view('client.home',compact('products','sliders'));
    }
     public function shop(Request $request)
    {
      $categories=  Category::all();
   $products=Product::where('status',1)->get();

        return view('client.shop',compact('categories','products'));
    }
      public function cart(Request $request)
    { if(!session::has('cart'))
      {
        return redirect('/cart');
      }
      $oldcart=Session::has('cart') ? Session::get('cart') : null ;
      $cart= new Cart($oldcart);
      return view('client.cart',['products'=>$cart->items]);
    }

 public function checkoutpost(Request $request)
  {
   
    $oldcart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldcart);

    Stripe::setApiKey('sk_test_51MEBPsLTNkeCqEGt5yOoD31agoafzVVoLUn2qHu5VeJIKdsopCplHiMHffC3cy8VPhyv7xjA8cSm0hAJMkTZhlP300Lf3dr4dd');

    try {

      $charge = Charge::create(array(
        "amount" => 100 * 100,   // $cart->totalPrice 
        "currency" => "usd",
        "source" => $request->input('stripeToken'), // obtainded with Stripe.js
        "description" => "Test Charge"
      ));
    } catch (\Exception $e) {
      Session::put('error', $e->getMessage());
      return redirect('/checkout');
    }

   

  $order= new Order();
  $order->name =$request->name;
    $order->address = $request->address;
    $order->cart = serialize($cart);

    $order->save();
      
    $email=Session::get('client')->email;

Mail::to($email)->send(new SendMail($order));
Session::forget('cart');
    return redirect('/cart')->with('status', 'your order has been successfully acomplished');
   } 
 /*  public function checkoutpost(Request $request)
  {
    try{
    $oldcart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldcart);

    

  $order= new Order();
  $order->name =$request->name;
    $order->address = $request->address;
    $order->cart = serialize($cart);
      Session::put('order', $order);
   $checkoutData = $this->checkoutData();

                $provider = new ExpressCheckout();
        
                $response = $provider->setExpressCheckout($checkoutData);
        
                return redirect($response['paypal_link']); 
        }
        catch(\Exception $e){
            return redirect('/checkout')->with('error', $e->getMessage());
        }
  
   // $order = collect($order);
   // dd($order);
 /*  $order->transform(function ($order, $key) {
      $order->cart = unserialize($order->cart);
      return $order;
    }); */
    
  /*   $email=Session::get('client')->email;

Mail::to($email)->send(new SendMail($order));
Session::forget('cart');
    return redirect('/cart')->with('status', 'your order has been successfully acomplished');
   } */

  private function checkoutData()
  {

    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);

    $data['items'] = [];

    foreach ($cart->items as $item) {
      $itemDetails = [
        'name' => $item['product_name'],
        'price' => $item['product_price'],
        'qty' => $item['qty']
      ];

      $data['items'][] = $itemDetails;
    }

    $checkoutData = [
      'items' => $data['items'],
      'return_url' => url('/paiement-success'),
      'cancel_url' => url('/checkout'),
      'invoice_id' => uniqid(),
      'invoice_description' => "order description",
      'total' => Session::get('cart')->totalPrice
    ];

    return $checkoutData;
  }


  public function paiement_success(Request $request)
  {

    try {
      $token = $request->get('token');
      $payerId = $request->get('PayerID');
      $checkoutData = $this->checkoutData();

      $provider = new ExpressCheckout();
      $response = $provider->getExpressCheckoutDetails($token);
      $response = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);
$order=Session::get('order')->save();

      $email = Session::get('client')->email;

      Mail::to($email)->send(new SendMail($order));
      
      Session::forget('cart');
      return redirect('/cart')->with('status', 'your order has been successfully acomplished');
      
    } catch (\Exception $e) {
      return redirect('/checkout')->with('error', $e->getMessage());
    }
  }

public function checkout(Request $request)
{
  if(!Session::has('client')){

      return view('client.login');
  }
  if(!Session::has('cart')){
    return view('client.cart');
  }
     return view('client.checkout');
}
public function login(Request $request)
{
     return view('client.login');
}

  public function logout(Request $request)
  {
    Session::forget('client');
    return redirect('/shop');
  }
public function register(Request $request)
{
     return view('client.signup');
}
  


  public function accessaccount(Request $request)
  {
    // dd($request->all());
    $this->validate($request, [
      'email' => 'email|required',

      'password' => 'required|min:4'
    ]);

    $client = Client::where('email', $request->email)->first();
    if($client){
      if(Hash::check($request->password,$client->password)){
        Session::put('client', $client);
        return redirect('/shop');
      }else{

        return back()->with('status', ' password wrong');
      }

    }
    else{
      return back()->with('status', 'your dont have email');

    }
   

    return back()->with('status', 'you  register successfully');
  }
public function createaccount(Request $request)
  {
   // dd($request->all());
    $this->validate($request,['email'=>'email|required|unique:clients',

  'password'=>'required|min:4']);
  $client = new Client();
  $client->email = $request->email;
  $client->password=bcrypt($request->input('password'));
  $client->save();
   
    return back()->with('status', 'you  register successfully');
  }
 
  public function showProduct($id)
{  $categories = Category::all();
 
  $products= Product::where('category_id',$id)->where('status',1)->get();

  return view('client.shop')->with('products',$products)->with('categories',$categories);
}
public function addToCart($id){
       /*  $product = DB::table('products')
                    ->where('id', $id)
                    ->first(); */
            $product=Product::find($id)->first() ;       

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
       // return redirect::to('/shop');
       return redirect()->back();
    }
     public function updateQty(Request $request,$id){
        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect('/cart');
    }

      public function removeItem($id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return back();
    }
    
}