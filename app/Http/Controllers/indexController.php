<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Session;
use Hash;
use validate;
use App\product;
use App\Giohang;
use App\customer;
use App\bill;
use App\bill_detail;


class indexController extends Controller
{
    public function getIndex(){
        return view('page.home');
    }


    public function getTest(){
        return view('page.test');
    }

    public function getRegister(){
        return view('page.register');
    }

    public function postRegister(Request $request){

        $this->validate($request, 
            [
                'txt_email' => 'unique:users,email',
            ],[
                'txt_email.unique' => 'Email đã tồn tại',
            ]);

        $user = new User;

        $level = DB::table('levels')->where('type_level', 'Thành viên')->get();
        foreach($level as $val){
            $level_member = $val->level;
        }
        $user->id_level = $level_member;

        $user->name = $request->input('txt_name');
        $user->email = $request->input('txt_email');
        $user->phone = $request->input('txt_phone');
        $user->address = $request->input('txt_dia_chi');
        $user->password = Hash::make($request->input('txt_pass'));
        $user->save();

        $register_success = Session::get('register_success');
        Session::put('register_success');
        
        return redirect()->route('getLogin')->with('register_success','Đã đăng ký tài khoản thành công');
    }

    public function getInfoMember($id){
        $member = DB::table('users')->where('id',$id)->get();
        return view('page.infomation_member', compact('member'));
    }

    // manage cart
    public function getCart(){
        return view('page.cart');
    }

    // add to cart
    public function getAddCart(Request $request,$id){
        $product = product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Giohang($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);

        $add_cart_success = Session::get('add_cart_success');
        Session::put('add_cart_success');
        return redirect()->back()->with('add_cart_success', 'Đã thêm vào giỏ hàng');
    }

    // buy now
    public function getBuyNow(Request $request,$id){
        $product = product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Giohang($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->route('getCart');
    }

    // update cart

    public function getUpdateCart(Request $request){
        if($request->id and $request->quantity){
            $oldCart = Session::has('cart')?Session::get('cart'):null;
            $cart = new Giohang($oldCart);
            $cart->update_cart($request->id,$request->quantity);
            session()->put('cart', $cart);
        }
        
    }

    // delete cart
    public function getDeleteCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Giohang($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        $delete_cart = Session::get('delete_cart');
        Session::put('delete_cart');
        return redirect()->back()->with('delete_cart', 'Đã xóa sản phẩm ra khỏi giỏ hàng');
    }

    // Order
    public function getCheckout(){
    }

    public function postCheckout(Request $request){
        $cart = Session::get('cart');

        $customer = new customer;
        $customer->name = $request->input('txt_name');
        $customer->email = $request->input('txt_email');
        $customer->phone = $request->input('txt_phone');
        $customer->address = $request->input('txt_address');
        $customer->save();

        $bill = new bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->input('txt_payment');
        $bill->save();

        foreach($cart->items as $key => $value){
            $bill_detail = new bill_detail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');

        $order_success = Session::get('order_success');
        Session::put('order_success');
        return redirect()->back()->with('order_success','Đặt hàng thành công');
    }

    public function getViewProduct(Request $request, $id){
        $product = DB::table('products')->where('id', $id)->get();
        $all = product::all();
        foreach($product as $products){
            $firm = $products->firm;
            $id_type = $products->id_type;
        }
        return view('page.view-product', compact('product','firm','id_type','all'));
    }

    // get view all
    public function getViewAll($loai){
        $id_type = DB::table('type_products')->where('type_name', $loai)->get();
        foreach($id_type as $id_types){
            $product = DB::table('products')->where('id_type', $id_types->id)->paginate(12);
            $sumProduct = DB::table('products')->where('id_type', $id_types->id)->count();
            $firm = DB::table('products')->select('firm')->where('id_type', $id_types->id)
            ->distinct()->get();
        }

        return view('page.view-all')->with([
            'product'=>$product,
            'sumProduct'=>$sumProduct,
            'firm'=>$firm,
            'id_type'=>$id_type
        ]);
    }

    // get view all by firm
    public function getViewAllByFirm($loai, $hang){
        $id_type = DB::table('type_products')->where('id', $loai)->get();
        $product = DB::table('products')->where([['firm',$hang],['id_type',$loai]])->get();
        $sumProduct = DB::table('products')->where([['firm',$hang],['id_type',$loai]])->count();
        $firm = DB::table('products')->select('firm')->where('id_type', $loai)->distinct()->get();
        return view('page.view-all-firm')->with([
            'product'=>$product,
            'sumProduct'=>$sumProduct,
            'firm'=>$firm,
            'id_type'=>$id_type
        ]);
    }

    // public function getViewAllByFirmCheckbox(Request $request){
    //     $loai = $request->loai;
    //     $hang = $request->hang;
    //     $id_type = DB::table('type_products')->where('id', $loai)->get();
    //     $product = DB::table('products')->where([['firm',$hang],['id_type',$loai]])->get();
    //     $sumProduct = DB::table('products')->where([['firm',$hang],['id_type',$loai]])->count();
    //     $firm = DB::table('products')->select('firm')->where('id_type', $loai)->distinct()->get();
    //     return view('page.view-all-firm')->with([
    //         'product'=>$product,
    //         'sumProduct'=>$sumProduct,
    //         'firm'=>$firm,
    //         'id_type'=>$id_type
    //     ]);
    // }

    // search
    public function getSearch(Request $request){
            $name = $request->input('txt_search');
            $product = DB::table('products')->where('name', 'LIKE' , '%'.$request->input('txt_search').'%')->paginate(8);
            $product->appends($request->only('txt_search'));
            $sumProduct = DB::table('products')->where('name', 'LIKE' , '%'.$request->input('txt_search').'%')->count();
            return view('page.view-search', compact('product','sumProduct','name'));
    }

    public function getViewAllSearch(Request $request){
        $hang = $request->input('txt_hang');
        $gia = $request->input('txt_gia');
        $id_tamp = $request->input('txt_id_type');
        $id_type = DB::table('type_products')->where('id',$id_tamp)->get();

        if($id_tamp == 1){
            if($gia == '0-3000'){
                $product = DB::table('products')->where([['firm',$hang],['price','<',3000000],
                    ['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','<',3000000],
                    ['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '3000-6000'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',3000000],
                    ['price','<',6000000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',3000000],
                    ['price','<',6000000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '9000-15000'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',9000000],
                    ['price','<',15000000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',9000000],
                    ['price','<',15000000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }else{
                $product = DB::table('products')->where([['firm',$hang],['price','>',15000000],
                    ['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',15000000],
                    ['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }
        }elseif($id_tamp == 2){
            if($gia == '5000'){
                $product = DB::table('products')->where([['firm',$hang],['price','<',5000000],
                    ['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','<',5000000],
                    ['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '5000-10000'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',5000000],
                    ['price','<',10000000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',5000000],
                    ['price','<',10000000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '15000'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',15000000],
                    ['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',15000000],
                    ['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }else{
                $product = DB::table('products')->where([['firm',$hang],['price','>',10000000],
                    ['price','<',15000000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','<',10000000],
                    ['price','<',15000000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get(); 
            }
        }elseif($id_tamp == 3){
            if($gia == '0-3000'){
                $product = DB::table('products')->where([['firm',$hang],['price','<',3000000],
                    ['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','<',3000000],
                    ['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '3000-6000'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',3000000],
                    ['price','<',6000000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',3000000],
                    ['price','<',6000000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '9000-15000'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',9000000],
                    ['price','<',15000000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',9000000],
                    ['price','<',15000000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }else{
                $product = DB::table('products')->where([['firm',$hang],['price','>',15000000],
                    ['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',15000000],
                    ['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }
        }else{
            if($gia == '100-300'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',100000],
                    ['price','<',300000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',100000],
                    ['price','<',300000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '100'){
                $product = DB::table('products')->where([['firm',$hang],['price','<',100000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','<',100000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }elseif($gia == '300-500'){
                $product = DB::table('products')->where([['firm',$hang],['price','>',300000],['price','<',500000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',300000],['price','<',500000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type',$id_tamp)->distinct()->get();
            }else{
                $product = DB::table('products')->where([['firm',$hang],['price','>',500000],['id_type',$id_tamp]])->paginate(12);
                $sumProduct = DB::table('products')->where([['firm',$hang],['price','>',500000],['id_type',$id_tamp]])->count();
                $firm = DB::table('products')->select('firm')->where('id_type', $id_tamp)
                    ->distinct()->get();
            }
        }

        
        return view('page.view-all')->with([
            'product'=>$product,
            'sumProduct'=>$sumProduct,
            'firm'=>$firm,
            'id_type'=>$id_type
        ]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
