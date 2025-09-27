<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\CodeGenerator;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    //save order
    public function save(Request $request)
    {
        // Génération du numéro de facture
        $invoice_number = CodeGenerator::generateUniqueOrderCode('POS',12);
        // Étape 1 : Création de la commande principale
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->order_date = $request->order_date;
        $order->order_status = $request->order_status;
        $order->total_products = $request->total_products;
        $order->sub_total = $request->sub_total;
        $order->vat = $request->vat;
        $order->invoice_no = $invoice_number;
        $order->total = $request->total;
        $order->payment_status = $request->payment_status;
        $order->pay = $request->pay;
        $order->due = $request->due;
        $order->save(); // 🔥 C’est ici qu’on récupère l’ID généré

        // Étape 2 : Ajout des détails de la commande
        // Contenu du panier
        $cartItems = Cart::content();
        // Parcourir chaque élément du panier et créer une entrée dans Orderdetails
        foreach ($cartItems as $item) {
            $orderdetails = new Orderdetails();
            $orderdetails->order_id = $order->id; // Utilisation de l’ID de la commande principale
            $orderdetails->product_id = $item->id;
            $orderdetails->quantity = $item->qty;
            $orderdetails->unitcost = $item->price;
            $orderdetails->total = $item->qty * $item->price;
            $orderdetails->save();
        }//end foreach
        // Vider le panier après la création de la commande
        Cart::destroy();
        $notification = array(
            'message' => 'Order Completed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    //pending orders
    public function pendingOrders(){
        $compteur = 1;
        $orders = Order::where('order_status','pending')->orderBy('order_date','ASC')->get();
        return view('admin.orders.pending',compact('orders','compteur'));
    }//end method

    //view order details
    public function viewDetails($id){
        $compteur = 1;
        $order = Order::with('customers')->where('id',$id)->first();
        $orderDetails = Orderdetails::with('products')->where('order_id',$id)->get();
        return view('admin.orders.details',compact('order','orderDetails','compteur'));
    } //end method
   
    //update order status
    public function updateStatus(Request $request, $id){
        //manage stock
        $orderDetails = Orderdetails::where('order_id',$id)->get();
        foreach($orderDetails as $item){
            $product = Product::where('id',$item->product_id)->first();
            $product->product_store = $product->product_store - $item->quantity;
            $product->update();
        } //end manage stock
        //update order status
        $order = Order::findOrFail($id);
        $order->order_status = 'completed';
        $order->update();
        $notification = array(
            'message' => 'Order status updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('order.pending')->with($notification);
    }

    //completed orders
    public function completedOrders(){
        $compteur = 1;
        $orders = Order::where('order_status','completed')->orderBy('order_date','ASC')->get();
        return view('admin.orders.completed',compact('orders','compteur'));
    }//end method

    //stock manage
    public function stockManage(){
        $compteur = 1;
        $products =  Product::latest()->get();
        return view('admin.stock.index', compact('products', 'compteur'));
    }//end method

    //invoice download
    public function invoiceDownload($id){
        $compteur = 1;
        $order = Order::with('customers')->where('id',$id)->first();
        $orderDetails = Orderdetails::with('products')->where('order_id',$id)->get();
        //generate pdf
        $pdf = Pdf::loadView('admin.orders.invoicepdf', compact('order', 'orderDetails', 'compteur'))
        ->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice_'.$order->invoice_no.'.pdf');
    } //end method

    //pending due
    public function pendingDue(){
        $compteur = 1;
        $orders = Order::where('due','>',0)->orderBy('order_date','ASC')->get();
        return view('admin.orders.due',compact('orders','compteur'));
    }//end method

    //order due
    public function orderDue($id){
        $orderDue = Order::findOrFail($id);
        return response()->json($orderDue);
    }//end method

    //order due pay
    public function orderDuePay(Request $request){

        $payAmount = (float) $request->pay;

        $order = Order::findOrFail($request->order_id);
        $order->due = $request->due;
        $order->pay = $order->pay + $payAmount;
        $order->update();
        $notification = array(
            'message' => 'Due Amount Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('pending.due')->with($notification);
    }//end method
}
