<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\pro_cat;
use Image;
use Mail;
use App\Mail\contacts;
use App\products_properties;
use App\Stocks;
use App\supplier;
use App\sales;
use Yajra\Datatables\Datatables;

class AdminController extends Controller {

    public function index() {

    return view('admin.index');
    }
    
   public function PrintForm($id) {
        //$pro_id = $reqeust->id;
        //$temp = DB::table('orders_products')->where()

        $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('orders_id','=',$id)
            ->get();
        
           //create temp variable  where    orders_products.orders_id    
        return view('admin.print', compact('sales'));
    }
    public function editPrint(Request $request) {

        $sale = $request->id;

        $customer_name = $request->customer_name;
        $product_name = $request->product_name;
        $quantity = $request->quantity;
        $address = $request->address;
        $contact = $request->contact;
        $sub_total = $request->sub_total;
        $mode = $request->mode;

        DB::table('sales')->where('id', $sale)->update([
            'customer_name' => $customer_name,
            'product_name' => $product_name,
            'quantity' => $quantity,
            'address' => $address,
            'contact' => $contact,
            'sub_total' => $sub_total,
            'mode' => $mode,

            

        ]);


        return redirect('/admin/sales');

    }

    public function addpro_form(){
      $cat_data = DB::table('pro_cat')->get();

      return view('admin.home', compact('cat_data'));
    } 

    public function add_product(Request $request) {
        $file = $request->file('pro_img');
        $filename = $file->getClientOriginalName();

        $path = 'upload/images';
        $file->move($path, $filename);

        $products = new products;
        $products->pro_name = $request->pro_name;
        $products->cat_id = $request->cat_id;
        $products->pro_code = $request->pro_code;
        $products->pro_price = $request->pro_price;
        $products->stock = $request->stock;
         $products->sizes = $request->sizes;
          $products->colors = $request->colors;
        $products->pro_info = $request->pro_info;
      
        $products->spl_price = $request->spl_price;
        $products->pro_img = $filename;
        $products->save();

        $cat_data = DB::table('pro_cat')->get();
 
        return view('admin.home', compact('cat_data'));

        //  return redirect()->action('AdminController@index')->with('status', 'Product Uploaded!');
    }
    public function add_supplier(Request $request) {
        

        $suppliers = new supplier;
        $suppliers->company_name= $request->company_name;
        $suppliers->first_name = $request->first_name;
        $suppliers->last_name = $request->last_name;
        $suppliers->address = $request->address;
        $suppliers->email_address = $request->email_address;
        $suppliers->contact_number = $request->contact_number;

        $suppliers->save();

        $suppliers = DB::table('suppliers')->get();

        return view('admin.addSupplier', compact('suppliers'));
 
        //  return redirect()->action('AdminController@index')->with('status', 'Product Uploaded!');
    }
    public function add_sales(Request $request) {
        

        $sales = new sales;
        $sales->customer_name= $request->customer_name;
        $sales->product_name = $request->product_name;
        $sales->quantity = $request->quantity;
         $sales->address = $request->address;
         $sales->contact = $request->contact;
         $sales->sub_total = $request->sub_total;
         $sales->mode = $request->mode;
 
         $sales->save();
 
         $sales = DB::table('sales')->get();

         return view('admin.addSales', compact('sales'));

        //  return redirect()->action('AdminController@index')->with('status', 'Product Uploaded!');
    }
    public function addSales(){
        $sales = DB::table('sales')->get();
         return view('admin.addSales', compact('sales'));
    }
     public function view_sales(Request $request){

       $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->orderby('orders_id', 'DESC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));

  }
  public function ascending(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->orderby('orders_id', 'ASC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));
  }
   public function descending(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->orderby('orders_id', 'DESC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));
  }
  public function highest(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
           ->orderby('pro_price', 'DESC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));
  }
   public function lowest(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
           ->orderby('pro_price', 'ASC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));
  }
  public function highPrice(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
           ->orderby('subtotal', 'DESC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));
  }
  public function lowPrice(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
           ->orderby('subtotal', 'ASC')  
               ->paginate(10);
        
        return view('admin.sales', compact('sales'));
  }
  public function sortFive(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
           ->orderby('orders_id', 'DESC')  
               ->paginate(5);
        
        return view('admin.shop1', compact('sales'));
  }
  public function sortTen(Request $request){
      $sales = DB::table('address')
              ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
           ->orderby('orders_id', 'DESC')  
               ->paginate(10);
        
        return view('admin.shop1', compact('sales'));
  }



  public function view_cancel(Request $request){

       $cancels = DB::table('address')
           ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id')  
           ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')  
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           
               ->paginate(10);
        
        return view('admin.cancelled', compact('cancels'));

  }
  public function view_refund(Request $request){

       $refunds = DB::table('address')
           ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id')  
           ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')  
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           
               ->paginate(10);
        
        return view('admin.refund', compact('refunds'));

  }


    public function updateSale(Request $request){
    
     $saleId = $request->saleID;
     $sale_val = $request->sale_val;

//
      $upd_role = DB::table('orders_products')
       ->join('orders','orders.id','=','orders_products.orders_id')
      ->where('orders_products.orders_id',$saleId)->update([
        'status' =>$sale_val]);
      if($upd_role){
        $products=DB::table('orders_products')
        ->where('orders_id',$saleId)->get();
        if($sale_val=="Delivered"){
          foreach ($products as $product) {
            $products=DB::table('products')
            ->where('id',$product->products_id)
            ->decrement("stock",$product->qty);
            
          }
        }
        if($sale_val=="Cancelled" || $sale_val=="Refund" || $sale_val=="Pending"){
          foreach ($products as $product) {
            $products=DB::table('products')
            ->where('id',$product->products_id)
            ->increment("stock",$product->qty);
            
          }
        }
        echo "Order ID: ".$saleId." is Updated!";


     }
   }


    //@if($upd_role){
        
    //}else {

   //  } 
    //  @if($sale_val == "Delivered"){
    //       $products=DB::table('orders_products')
       //     ->where('orders_product.id',$saleId)->get();
      //    DB::table('products')->where($product->$saleId)->decrement('stock',$product->qty);
     //      }
      //  }else{
////
   //     }
    //    echo "Order Status Updated!";
    //$upd_role = DB::table('users')->where('id',$userId)->update(['admin' =>$role_val]);
     // if($upd_role){
       // echo "Role is updated successfully";
    
    
    public function view_supplier(){
        $suppliers = DB::table('suppliers')->get();

        return view('admin.supplier', compact('suppliers'));
    }
    public function addSupplier(){
      $suppliers = DB::table('suppliers')->get();

      return view('admin.addSupplier', compact('suppliers'));
    } 
    public function view_stocks() {
      

      $Products = DB::table('pro_cat')
      ->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
      ->paginate(10);
       
         
      return view('admin.stocks', compact('Products'));
    }
     public function ascStock(){
       $Products = DB::table('pro_cat')
      ->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
     ->orderby('stock', 'DESC')
      ->paginate(10);

        return view('admin.stocks', compact('Products'));
    }
    public function descStock(){
       $Products = DB::table('pro_cat')
      ->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
     ->orderby('stock', 'ASC')
      ->paginate(10);

        return view('admin.stocks', compact('Products'));
    }
     
     public function search(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.product');
        } else {
            $Products = DB::table('products')->where('pro_name', 'like', '%' . $search . '%')->paginate(5);
            return view('admin.product', ['msg' => 'Results: ' . $search], compact('Products'));
        }
    }

   
    public function view_products() {

        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
        ->paginate(10); // now we are fetching all products


        return view('admin.product', compact('Products'));
    }
    public function ascPro() {

        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
        ->orderBy('pro_name','ASC')
        ->paginate(10); // now we are fetching all products


        return view('admin.product', compact('Products'));
    }
    public function descPro() {

        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
        ->orderBy('pro_name','DESC')
        ->paginate(10); // now we are fetching all products


        return view('admin.product', compact('Products'));
    }
    public function highPro() {

        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
        ->orderBy('pro_price','DESC')
        ->paginate(10); // now we are fetching all products


        return view('admin.product', compact('Products'));
    }
    public function lowPro() {

        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
        ->orderBy('pro_price','ASC')
        ->paginate(10); // now we are fetching all products


        return view('admin.product', compact('Products'));
    }

     public function view_messages() {

       $messages = DB::table('message')
               ->leftJoin('users', 'message.user_id', '=', 'users.id')
            ->get();
            
        return view('admin.messages', compact('messages'));
    }


    public function add_cat() {

        return view('admin.addCategory');
    }

    // add cat
    public function catForm(Request $request) {
        //echo $request->cat_name;
        //return 'update query here';
        $pro_cat = new pro_cat;

        $pro_cat->name = $request->cat_name;
        $pro_cat->status = '0'; // by defalt enable
        $pro_cat->save();

        $cats = DB::table('pro_cat')->orderby('id', 'DESC')->get();

        return view('admin.categories', compact('cats'));
    }

    // edit form for cat
    public function CatEditForm(Request $request) {
        $catid = $request->id;
        $cats = DB::table('pro_cat')->where('id', $catid)->get();
        return view('admin.editCategory', compact('cats'));
    }

    //update query to edit cat
    public function editCat(Request $request) {

        $catid = $request->id;
        $catName = $request->cat_name;
        $status = $request->status;
        DB::table('pro_cat')->where('id', $catid)->update(['name' => $catName, 'status' => $status]);

        $cats = DB::table('pro_cat')->orderby('id', 'DESC')->get();

        return view('admin.categories', compact('cats'));
    }

    public function view_cats() {

        $cats = DB::table('pro_cat')->get();

        return view('admin.categories', compact('cats'));
    }

    public function ProductEditForm($id) {
        //$pro_id = $reqeust->id;
        $Products = DB::table('products')->where('id', '=', $id)->get(); // now we are fetching all products
        return view('admin.editProducts', compact('Products'));
    }
     public function deleteMessage($id) {
         DB::table('message')->where('id', '=', $id)->delete();


        $messages = DB::table('message')->get();

        return view('admin.messages', compact('messages'));
    }
    public function deleteOrders($id) {

      DB::table('address')->where('user_id', '=', $id)->delete();

      $orders = DB::table('address')->get();

      return view('admin.orderDetails',compact('orders'));

    }
    public function deleteSuppliers($id) {

      DB::table('suppliers')->where('id', '=', $id)->delete();

      $suppliers = DB::table('suppliers')->get();

      return view('admin.supplier',compact('suppliers'));

    }
    
     public function StockEditForm($id) {
        

        $Products = DB::table('products')

        ->where('id', '=', $id)->get(); 
        return view('admin.editStocks', compact('Products'));
    }

    public function editProduct(Request $request) {

        $proid = $request->id;

        $pro_name = $request->pro_name;
        $cat_id = $request->cat_id;
        $pro_code = $request->pro_code;
        $pro_price = $request->pro_price;
        $sizes = $request->sizes;
        $colors = $request->colors;
        $pro_info = $request->pro_info;
        $spl_price = $request->spl_price;

        DB::table('products')->where('id', $proid)->update([
            'pro_name' => $pro_name,
            'cat_id' => $cat_id,
            'pro_code' => $pro_code,
            'pro_price' => $pro_price,
            'pro_info' => $pro_info,
             'sizes' => $sizes,
            'colors' => $colors,
            'spl_price' => $spl_price,
            

        ]);


        return redirect('/admin/products');
        //$Products = DB::table('pro_cat')->rightJoin('products','products.cat_id', '=', 'pro_cat.id')->get(); // now we are fetching all products
        //return view('admin.products', compact('Products'));
    }
      public function editStock(Request $request) {

        $proid = $request->id;

        $pro_name = $request->pro_name;
        $cat_id = $request->cat_id;
        $stock = $request->stock;
        $avail = $request->avail;
        $total = $stock + $avail;

      

        DB::table('products')->where('id', $proid)->update([
            'stock' => $total
            
            

        ]);


        return redirect('/admin/stocks');
    }
   
    public function ImageEditForm($id) {
        $Products = DB::table('products')->where('id', '=', $id)->get(); // now we are fetching all products
        return view('admin.ImageEditForm', compact('Products'));
    }

    

    //for delete cat
    public function deleteCategory($id) {

        //echo $id;
        DB::table('pro_cat')->where('id', '=', $id)->delete();


        $cats = DB::table('pro_cat')->get();

        return view('admin.categories', compact('cats'));
    }
    public function deleteProducts($id) {

        //echo $id;
        DB::table('products')->where('id', '=', $id)->delete();


        $Products = DB::table('products')->get();

        return view('admin.product', compact('Products'));
    }



    public function addSale(Request $request){
      $salePrice = $request->salePrice;
      $pro_id = $request->pro_id;
      DB::table('products')->where('id', $pro_id)->update(['spl_price' => $salePrice]);
      echo 'added successfully';
    }


    public function users(){

      $usersData = DB::table('users') ->paginate(5);
   // ->Join('address','address.user_id','users.id')
      return view('admin.users',compact('usersData', $usersData));
    }
    public function ascUsers(){

      $usersData = DB::table('users') 
      ->orderby('id','ASC')
      ->paginate(10);
   // ->Join('address','address.user_id','users.id')
      return view('admin.users',compact('usersData', $usersData));
    }
    public function descUsers(){

      $usersData = DB::table('users') 
      ->orderby('id','DESC')
      ->paginate(10);
   // ->Join('address','address.user_id','users.id')
      return view('admin.users',compact('usersData', $usersData));
    }
    public function ascName(){

      $usersData = DB::table('users') 
      ->orderby('name','ASC')
      ->paginate(10);
   // ->Join('address','address.user_id','users.id')
      return view('admin.users',compact('usersData', $usersData));
    }
     public function descName(){

      $usersData = DB::table('users') 
      ->orderby('name','DESC')
      ->paginate(10);
   // ->Join('address','address.user_id','users.id')
      return view('admin.users',compact('usersData', $usersData));
    }
    public function adminName(){

      $usersData = DB::table('users') 
      ->where('admin','=','1')
      ->orderby('name','ASC')
      ->paginate(10);
   // ->Join('address','address.user_id','users.id')
      return view('admin.users',compact('usersData', $usersData));
    }


    public function updateRole(Request $request){
      $userId = $request->userID;
       $role_val = $request->role_val;

      $upd_role = DB::table('users')->where('id',$userId)->update(['admin' =>$role_val]);
      if($upd_role){
        echo "Role is updated successfully";
      }
    }

    public function add_stocks(Request $request) {
     
       $stocks = new stocks;
        $stocks->stock_name = $request->stock_name;
        $stocks->cat_id = $request->cat_id;
        $stocks->stock_code = $request->stock_code;
        $stocks->buying_price = $request->buying_price;
        $stocks->selling_price = $request->selling_price;
        $stocks->suppliers = $request->suppliers;
        
        $stocks->save();

        $cat_data = DB::table('pro_cat')->get();

        return view('admin.addStocks', compact('cat_data'));
        
    }
    public function addStocks(){
      $cat_data = DB::table('pro_cat')->get();

      return view('admin.addStocks', compact('cat_data'));
    } 
    public function view_stockDetails(){
       $stocks = DB::table('stock_info')->get();

        return view('admin.stockDetails', compact('stocks'));
    }

    public function deleteStockDetails($id) {

        //echo $id;
        DB::table('stock_info')->where('id', '=', $id)->delete();


        $stocks = DB::table('stock_info')->get();

        return view('admin.stockDetails', compact('stocks'));
    }
  
  
    public function deleteProduct($id) {

        //echo $id;
        DB::table('products')->where('id', '=', $id)->delete();

        return view('admin.orderDetails', compact('orders'));
    }
    public function orders() {

         $orders = DB::table('address')
             ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
          ->orderby('orders_id', 'DESC')  
           ->paginate(10);
           dump($orders);
        return view('admin.orderDetails', compact('orders','products','orders_products', $orders));

      
        // return view('admin.users',compact('usersData', $usersData))
    }
    public function deliveredOrders() {

         $orders = DB::table('address')
             ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Delivered')
          ->orderby('orders_id', 'DESC')  
           ->paginate(10);
        return view('admin.orderDetails', compact('orders','products','orders_products', $orders));

      
        // return view('admin.users',compact('usersData', $usersData))
    }
    public function cancelledOrders() {

         $orders = DB::table('address')
             ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Cancelled')
          ->orderby('orders_id', 'DESC')  
           ->paginate(10);
        return view('admin.orderDetails', compact('orders','products','orders_products', $orders));

      
        // return view('admin.users',compact('usersData', $usersData))
    }
     public function refundedOrders() {

         $orders = DB::table('address')
             ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Refund')
          ->orderby('orders_id', 'DESC')  
           ->paginate(10);
        return view('admin.orderDetails', compact('orders','products','orders_products', $orders));

      
        // return view('admin.users',compact('usersData', $usersData))
    }
    public function pendingOrders() {

         $orders = DB::table('address')
             ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
           ->where('status','=','Pending')
          ->orderby('orders_id', 'DESC')  
           ->paginate(10);
        return view('admin.orderDetails', compact('orders','products','orders_products', $orders));

      
        // return view('admin.users',compact('usersData', $usersData))
    }


    public function OrderEditForm(Request $request) {
        $id = $request->id;

        $orders = DB::table('orders')->where('id', '=', $id)->get(); 
        return view('admin.editOrder', compact('orders'));
    }

    //update query to edit cat
    public function editOrder(Request $request) {

       $id = $request->id;

        $fullname = $request->fullname;
        $pro_name = $request->pro_name;
        $status = $request->status;
        

        DB::table('orders')->where('id', $id)->update([
            'status' => $status
            
            

        ]);


        return redirect('/admin/orders');
    }

     public function editProImage(Request $request) {

        $proid = $request->id;

        $file = $request->file('new_image');

        $filename = time() . '.' . $file->getClientOriginalName();

        $M_path = 'upload/images';
        
        $img = Image::make($file->getRealPath());
        //$img->crop(300, 150, 25, 25);
    
        $img->resize(500, 500)->save($M_path . '/' . $filename);
        



       // $file->move($path, $filename);


        DB::table('products')->where('id', $proid)->update(['pro_img' => $filename]);
        return redirect('/admin/products');
        //echo 'done';
        //  $Products = DB::table('products')->get(); // now we are fetching all products
        //  return view('admin.products', compact('Products'));
    }
     public function proCats(Request $request) {
           if ($request->ajax() && isset($request->start)) {
            $start = $request->start; // min price value
            $end = $request->end; // max price value
            $catName = $request->name;
            $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')
                     ->where('pro_cat.name', '=', $catName)
                     ->where('pro_price', '>=', $start)
                    ->where('pro_price', '<=', $end)
                    ->orderby('pro_price', 'ASC')
                    ->paginate(6);
             response()->json($Products); //return to ajax
            return view('admin.product', compact('Products'));
        } else if(isset($request->brand)){
            $brand = $request->brand; //brand
            $Products = DB::table('products')->whereIN('cat_id', explode( ',', $brand ))->paginate(6);
             response()->json($Products); //return to ajax
            return view('admin.product', compact('Products'));
        } else{
        $catName = $request->name;
        $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')->where('pro_cat.name', '=', $catName)->paginate(6);
         return view('admin.product', compact('Products'));
        }
    }

    public function export_products() {
      $products = DB::table('products')->get();

      $proData = " ";

      if(count($products) > 0) {
        $proData .= '<table>
        <tr> <th style="border:1px solid #000; "> Name </th
             <th style="border:1px solid #000; "> Price </th>
             <th style="border:1px solid #000;"> Code </th>
             <th style="border:1px solid #000;"> ImgUrl </th>            

        </tr>';

        foreach($products as $product){
          $proData .= '
          <tr><td style="border:1px solid #000;">'.$product->pro_name. '</td>
              <td style="border:1px solid #000;">'.$product->pro_price. '</td>
              <td style="border:1px solid #000;">'.$product->pro_code. '</td>
              <td style="border:1px solid #000;">'.$product->pro_img. '</td>  


           </tr>
          ';
        } 
        $proData .='</table>';

      }

      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=productsreport.xls');
      echo $proData; 

    }
    public function export_sales() {

         $sales = DB::table('address')
             ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
         ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id')
           ->where('status', '=','Delivered')   
         ->get();

         $total = DB::table('orders')
                  ->where('status','=','Delivered')
                  ->sum('subtotal');

          $trans = DB::table('orders')
                  ->where('status','=','Delivered')
                  ->count('id');         

       $saleData = " ";    

        echo "Total Sales =". $total. "Pesos";
        echo "Total Number of Transactions = ". $trans;
      if(count($sales) > 0) {
        $saleData .= '<table>
        <tr> <th style="border:1px solid #000; "> Name </th
             <th style="border:1px solid #000; "> Product Name </th>
             <th style="border:1px solid #000;"> Quantity </th>
             <th style="border:1px solid #000;"> Payment Type </th> 
              <th style="border:1px solid #000;"> Amount </th>            

        </tr>';

        foreach($sales as $sale){
          $saleData .= '
          <tr><td style="border:1px solid #000;">'.$sale->fullname. '</td>
              <td style="border:1px solid #000;">'.$sale->pro_name. '</td>
              <td style="border:1px solid #000;">'.$sale->qty. '</td>
              <td style="border:1px solid #000;">'.$sale->payment_type. '</td>
              <td style="border:1px solid #000;">'.$sale->subtotal. '</td>      
              

           </tr>
          ';
        } 

        $saleData .='</table>';

      }

      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=salesreport.xls');
      echo $saleData; 

    }
      public function export_stocks() {
      
      $stocks = DB::table('pro_cat')
      ->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')
      ->get();
       

      $stockData = " ";

      if(count($stocks) > 0) {
        $stockData .= '<table>
        <tr> <th style="border:1px solid #000; "> Name </th>
            <th style="border:1px solid #000; "> Category </th>
             <th style="border:1px solid #000; "> Price </th>
             <th style="border:1px solid #000;"> Stock </th>
                     

        </tr>';

        foreach($stocks as $stock){
          $stockData .= '
          <tr><td style="border:1px solid #000;">'.$stock->pro_name. '</td>
              <td style="border:1px solid #000;">'.$stock->name. '</td>
              <td style="border:1px solid #000;">'.$stock->pro_price. '</td>
              <td style="border:1px solid #000;">'.$stock->stock. '</td>
           </tr>
          ';
        } 
        $stockData .='</table>';

      }

      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=stockreport.xls');
      echo $stockData; 

    }
     public function submitProperty(Request $request){

    $properties = new products_properties;
    $properties->pro_id = $request->pro_id;
    $properties->size = $request->size;
    $properties->color = $request->color;
    $properties->p_price = $request->p_price;
    $properties->save();

    return redirect('/admin/ProductEditForm/'.$request->pro_id);

  }

  public function editProperty(Request $request){
         $uptProts = DB::table('products_properties')
          ->where('pro_id', $request->pro_id)
          ->where('id', $request->id)
          ->update($request->except('_token'));
          if($uptProts){
          return back()->with('msg', 'Properties Updated!');
        }else {
        return back()->with('msg', 'Check Properties Again');
      }
  }
   public function send() {
        Mail::send(new contacts());
        return back()->with('msg', 'Email Sent to Customer');
    }


    public function email(){
        return view('admin.email');
    }
    public function searchProduct(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.product');
        } else {
            $Products = DB::table('products')
            ->leftJoin('pro_cat', 'products.cat_id', '=', 'pro_cat.id')
               ->where('pro_name', 'like', '%' . $search . '%')
               ->orWhere('name', 'like', '%' . $search . '%')
            ->get();
            return view('admin.product', ['msg' => 'Results: ' . $search], compact('Products'));
        }
    }
    public function productCategories(Request $request) {
           if ($request->ajax() && isset($request->start)) {
            $start = $request->start; // min price value
            $end = $request->end; // max price value
            $catName = $request->name;
            $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')
                     ->where('pro_cat.name', '=', $catName)
                     ->where('pro_price', '>=', $start)
                    ->where('pro_price', '<=', $end)
                    ->orderby('pro_price', 'ASC')
                    ->paginate(6);
             response()->json($Products); //return to ajax
            return view('admin.product', compact('Products'));
        } else if(isset($request->brand)){
            $brand = $request->brand; //brand
            $Products = DB::table('products')->whereIN('cat_id', explode( ',', $brand ))->paginate(6);
             response()->json($Products); //return to ajax
            return view('admin.product', compact('Products'));
        } else{
        $catName = $request->name;
        $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')->where('pro_cat.name', '=', $catName)->paginate(6);
         return view('admin.product', compact('Products'));
        }
    }

    public function stockCategory(Request $request) {
           if ($request->ajax() && isset($request->start)) {
            $start = $request->start; // min price value
            $end = $request->end; // max price value
            $catName = $request->name;
            $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')
                     ->where('pro_cat.name', '=', $catName)
                     ->where('pro_price', '>=', $start)
                    ->where('pro_price', '<=', $end)
                    ->orderby('pro_price', 'ASC')
                    ->paginate(6);
             response()->json($Products); //return to ajax
            return view('admin.stocks', compact('Products'));
        } else if(isset($request->brand)){
            $brand = $request->brand; //brand
            $Products = DB::table('products')->whereIN('cat_id', explode( ',', $brand ))->paginate(6);
             response()->json($Products); //return to ajax
            return view('admin.stocks', compact('Products'));
        } else{
        $catName = $request->name;
        $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')->where('pro_cat.name', '=', $catName)->paginate(6);
         return view('admin.stocks', compact('Products'));
        }
    }
    public function searchStock(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.stocks');
        } else {
            $Products = DB::table('products')
            ->leftJoin('pro_cat', 'products.cat_id', '=', 'pro_cat.id')
               ->where('pro_name', 'like', '%' . $search . '%' )
                ->orWhere('name', 'like', '%' . $search . '%' )
            ->paginate(10);
            return view('admin.stocks', ['msg' => 'Results: ' . $search], compact('Products'));
        }
    }
    public function searchOrder(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.orderDetails');
        } else {
            $orders = DB::table('address')
               ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
            ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
               ->where('fullname', 'like', '%' . $search . '%' )
               ->orWhere('orders_id','like', '%' . $search . '%' )
                ->orWhere('pro_name','like', '%' . $search . '%' )
                ->orWhere('status','like', '%' . $search . '%')
            ->paginate(10);
            return view('admin.orderDetails', ['msg' => 'Results: ' . $search], compact('orders'));
        }
    }
    public function searchOrderID(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.orderDetails');
        } else {
            $orders = DB::table('address')
               ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
            ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id') 
               ->where('orders_id', 'like', '%' . $search . '%')
            ->paginate(10);
            return view('admin.orderDetails', ['msg' => 'Results: ' . $search], compact('orders'));
        }
    }
    public function searchSales(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.sales');
        } else {
            $sales = DB::table('address')
               ->leftJoin('orders_products', 'address.id', '=', 'orders_products.orders_id') 
            ->leftJoin('products', 'products.id', '=', 'orders_products.products_id')
           ->leftJoin('orders', 'address.id', '=', 'orders.id')
             
               ->Where('orders_id', 'like', '%' . $search . '%')
               ->orWhere('pro_name', 'like', '%' . $search . '%')
               ->orWhere('fullname', 'like', '%' . $search . '%')

            ->paginate(10);
            return view('admin.sales', ['msg' => 'Results: ' . $search], compact('sales'));
        }
    }
     public function searchUser(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('admin.users');
        } else {
            $usersData = DB::table('users')
          
               ->Where('name', 'like', '%' . $search . '%')
               ->orWhere('email', 'like', '%' . $search . '%')
               ->orWhere('id', 'like', '%' . $search . '%')

            ->paginate(10);
            return view('admin.users', ['msg' => 'Results: ' . $search], compact('usersData'));
        }
    }

}

