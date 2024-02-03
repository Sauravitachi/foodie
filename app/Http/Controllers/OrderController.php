<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Auth;
use PaytmWallet;

class OrderController extends Controller
{
    public function manageCarts(){
        $data["carts"] = Order::orderBy("id","desc")->paginate(10);
        return view("admin.manageCart",$data);
    }
    public function addToCart(Request $request,$id){
        $product = Product::findOrFail($id);

        $user = Auth::user();
        if($product){
            $order = Order::where([["status",false],["user_id",$user->id]])->first();
            if($order){
                $orderItem = OrderItem::where("status",false)->where("product_id",$id)->where("order_id",$order->id)->first();
                if($orderItem){
                    //if orderItem already exit in cart
                    $orderItem->qty += 1;
                    $orderItem->save();
                }
                else{

                    $oi = new OrderItem();
                    $oi->status = false;
                    $oi->product_id = $id;
                    $oi->order_id = $order->id;
                    $oi->save();
                }
            }
            else{
                //if order not exit in cart
                $o = new Order();
                $o->user_id = $user->id;
                $o->status = false;
                $o->save();

                $oi = new OrderItem();
                $oi->status = false;
                $oi->product_id = $id;
                $oi->order_id = $o->id;
                $oi->save();
            }
            return redirect()->route('cart')->with("success","Added product in cart successfully");
        }
        else{
            return redirect()->route('home.index')->with("error","Product is not found");
        }
    }

    public function removeFromCart(Request $request,$id){
        $product = Product::findOrFail($id);

        $user = Auth::user();
        if($product){
            $order = Order::where([["status",false],["user_id",$user->id]])->first();
            if($order){
                $orderItem = OrderItem::where("status",false)->where("product_id",$id)->where("order_id",$order->id)->first();
                if($orderItem){
                    
                    if($orderItem->qty > 1){                    
                        $orderItem->qty -= 1;
                        $orderItem->save();
                    }
                    else{
                        $orderItem->delete();
                    }
                   
                }
               
            }
            return redirect()->route('cart')->with("error","Deleted product successfully");
        }
        else{
            return redirect()->route('home.index')->with("error","Product is not found");
        }
    }
    public function cart(){
        $data['order']=Order::where([["user_id",Auth::id()],["status",false]])->first();
        return view("home.cart",$data);
    }
    public function checkout(Request $req){    
        $data['addresses'] = Address::where("user_id",Auth::id())->get();

        if($req->isMethod("post")){
            $data = $req->validate([
                'street_name' =>  'required',
                'landmark' =>  'required',
                'area' =>  'required',                
                'pincode' =>  'required',
                'city' =>  'required',
                'state' =>  'required',
                'type' =>  'required',
            ]);

            $data['user_id'] = Auth::id();
            Address::create($data);
            return redirect()->back()->with("success", "Data inserted successfully");
        }
        return view("home.checkout",$data);
    }

    public function order(Request $req)
    {
        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $req->id,
          'user' => Auth::id(),
          'mobile_number' => 9117442498,
          'email' => Auth::user()->email,
          'amount' => $req->amount,
          'callback_url' => route("status")
        ]);
        return $payment->receive();
    }

   
    public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        
        if($transaction->isSuccessful()){
          //Transaction Successful
        }else if($transaction->isFailed()){
          //Transaction Failed
        }else if($transaction->isOpen()){
          //Transaction Open/Processing
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id
    }  

}
