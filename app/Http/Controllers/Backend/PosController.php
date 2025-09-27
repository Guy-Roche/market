<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PosController extends Controller
{
    //Pos
    public function pos()
    {
        $compteur = 1;
        //products
        $products = Product::where('expire_date', '>', now()->format('Y-m-d'))->latest()->get();
        //Customers
        $customers = Customer::latest()->get();
        return view('admin.pos.index', compact('products', 'compteur', 'customers'));
    } //end method

    //Add to cart
    public function addcart(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();

        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->selling_price,
            'weight' => 1,
            'options' => [
                'image' => $product->product_image,
                'code' => $product->product_code,
            ],
        ]);

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    //update cart item quantity
    public function updatecart(Request $request, $rowId)
    {
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        $notification = array(
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    //delete cart item
    public function deletecart($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'message' => 'Cart Item Removed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    //create invoice
    public function createinvoice(Request $request)
    {
        $customer_id = $request->customer_id;
        if ($customer_id == null) {
            $notification = array(
                'message' => 'Please Select A Customer',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            //carts content
            $carts = Cart::content();
            $compteur = 1;
            //Customers
            $customer = Customer::where('id', $customer_id)->first();

            $total = Cart::total();
            return view('admin.pos.invoice', compact('compteur', 'customer', 'carts', 'total'));
        }

}


}