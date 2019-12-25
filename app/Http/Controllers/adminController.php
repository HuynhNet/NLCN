<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use validate;
use Session;
use App\User;
use App\bill_detail;
use Hash;
use App\Banner;
use Sentinel;
use Reminder;
use Mail;
use App\product;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
/*use File;*/


class adminController extends Controller
{
    // view page admin
    public function getAdmin(){

        if(Auth::check() && Auth::user()->id_level < 3){
            return view('admin.admin');
        }else{
            return view('page.home');
        }
    }

    // manage admin
    public function getManageAdmin(){

        if(Auth::check() && Auth::user()->id_level < 3){
            $admin = DB::table('users')->where('id_level','<>', 3)->get();
            return view('admin.manage_user.manage_admin', compact('admin'));
        }else{
            return view('page.home');
        }
    }

    public function getAddAdmin(){

        if(Auth::check() && Auth::user()->id_level < 3){
            return view('admin.manage_user.add_admin');
        }else{
            return view('page.home');
        }
        
    }

    public function getSearchAdmin(Request $request){
        $admin = DB::table('users')->where([
            ['name', 'LIKE' , '%'.$request->input('txt_search').'%'],
            ['id_level',1]
        ])->orWhere([
            ['email', 'LIKE' , '%'.$request->input('txt_search').'%'],
            ['id_level',1]
        ])->orWhere([
            ['phone', 'LIKE' , '%'.$request->input('txt_search').'%'],
            ['id_level',1]
        ])->paginate(8);
        $admin->appends($request->only('txt_search'));
        return view('admin.manage_user.manage_admin', compact('admin'));
    }

    public function postAddAdmin(Request $request){

        $admin = new User;
        
        $level = DB::table('levels')->where('type_level', 'Admin')->get();
        foreach($level as $val){
            $level_add = $val->level;
        }

        $admin->id_level = $level_add;
        $admin->name = $request->input('txt_name');
        $admin->email = $request->input('txt_email');
        $admin->phone = $request->input('txt_sdt');
        $admin->address = $request->input('txt_dia_chi');
        $admin->password = Hash::make($request->input('txt_mat_khau'));

        if ($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file->move(public_path('upload/image_admin'), $filename);
            $admin->image = $filename;
        }else{
            return $request;
            $value->image = '';
        }

        $admin->save();
        $add_admin = Session::get('add_admin');
        Session::put('add_admin');
        
        return redirect()->route('getManageAdmin')->with('add_admin','Đã thêm một tài khoản admin');
    }

    public function getInforUser($id, Request $request){
        $info = DB::table('users')->where('id',$id)->get();
        return view('admin.manage_user.infomation_admin')->with([
            'info'=>$info
        ]);
    }

    // login
    public function getLogin(){
        return view('page.login');
    }

    public function postLogin(Request $request){
        
        
        $email = $request->input('txt_email');
        $password = $request->input('txt_password');


        $level = DB::table('users')->where('email', $email)->get();
        foreach($level as $val){
            $levelUser = $val->id_level;
        }

        if(Auth::attempt(['email' => $email, 'password' => $password,'id_level' => 1])){
            return redirect()->route('getAdmin');
        }elseif(Auth::attempt(['email' => $email, 'password' => $password,'id_level' => 2])){
            return redirect()->route('getAdmin');
        }elseif(Auth::attempt(['email' => $email, 'password' => $password,'id_level' => 3])){
            return view('page.home');
        }else{
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }


    // manage member
    public function getManageMember(){

        if(Auth::check() && Auth::user()->id_level < 3){
            $member = DB::table('users')->where('id_level', 3)->get();
            return view('admin.manage_user.manage_member', compact('member'));
        }else{
            return view('page.home');
        }
        
    }

    public function getDeleteMember($id){
        DB::table('users')->delete($id);

        $delete_member = Session::get('delete_member');
        Session::put('delete_member');

        return redirect()->back()->with('delete_member', 'Đã xóa thành viên');
    }

    public function getDeleteAllMember(Request $request){

        $ids = $request->ids;
        DB::table("users")->whereIn('id',explode(",",$ids))->delete();

        $delete_all_member = Session::get('delete_all_member');
        Session::put('delete_all_member');

        return redirect()->back()->with('delete_all_member', 'Đã xóa tất cả thành viên');
    }

    public function getSearchMember(Request $request){
        $member = DB::table('users')->where([
            ['name', 'LIKE' , '%'.$request->input('txt_search').'%'],
            ['id_level',3]
        ])->orWhere([
            ['email', 'LIKE' , '%'.$request->input('txt_search').'%'],
            ['id_level',3]
        ])->orWhere([
            ['phone', 'LIKE' , '%'.$request->input('txt_search').'%'],
            ['id_level',3]
        ])->paginate(8);
        $member->appends($request->only('txt_search'));
        return view('admin.manage_user.manage_member', compact('member'));
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    /*// reset password
    public function getForgetPassword(){
        
        return view('page.forget-password');
    }

    public function postForgetPassword(Request $request){

        $user = User::whereEmail($request->txt_email)->first();

        if($user == null){
            return redirect()->back()->with(['status'=>'Email not exists']);
        }

        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user) ? : Reminder::create($user);
        $this->sendEmail($user, $reminder->code);

        return redirect()->back()->with(['status'=>'Please check your email to reset new password']);
    }

    public function sendEmail($user, $code){
        Mail::send(
            'page.info-email',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
            }
        );
    }

    public function getResetPassword($email){
        $user = DB::table('users')->where('email',$email)->get();
        return view('page.reset-password', compact('user'));
    }

    public function postResetPassword(Request $request, $id){

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->input('txt_password_xn'));
        $user->save();

        $success = Session::get('success');
        Session::put('success');
        
        return redirect()->route('getLogin')->with('success','Đã thay đổi mật khẩu thành công');
    }*/

    // import user from excel file
    public function getExport(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function importExportView(){
        if(Auth::check() && Auth::user()->id_level < 3){
            return view('admin.manage_user.import_user');
        }else{
            return view('page.home');
        }
    }

    public function postImport(Request $request){
        Excel::import(new UsersImport,$request->file('file_excel'));

       /* if($request->hasFile('file_excel')){
            $extension = File::extension($request->file_excel->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
     
                $path = $request->file_excel->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
     
                    foreach ($data as $key => $value) {
                        $insert[] = [
                        'id_level' => $value->Id_level,
                        'name' => $value->Name,
                        'email' => $value->Email,
                        'phone' => $value->Phone,
                        'address' => $value->Address,
                        'password' => \Hash::make('12345678'),
                        ];
                    }
     
                    if(!empty($insert)){
     
                        $insertData = DB::table('users')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
     
                return back();
     
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }*/

        $add_user_excel = Session::get('add_user_excel');
        Session::put('add_user_excel');
        return redirect()->back()->with('add_user_excel', 'Đã thêm tất cả user từ file excel.');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('getIndex');
    }

    // manage products
    public function getManageProducts(){

        if(Auth::check() && Auth::user()->id_level < 3){
            $product = DB::table('products')->paginate(10);
            return view('admin.manage_products.manage_products', compact('product'));
        }else{
            return view('page.home');
        }
        
    }

    public function getAddProduct(){

        if(Auth::check() && Auth::user()->id_level < 3){
            return view('admin.manage_products.add_product');
        }else{
            return view('page.home');
        }

    }

    public function postAddProduct(Request $request){
        $product = new product;
        $type = $request->input('txt_type_product');
        $id_product = DB::table('type_products')->where('type_name', $type)->get();
        foreach($id_product as $val){
            $product->id_type = $val->id;
        }
        $product->name = $request->input('txt_name');
        $product->describe = $request->input('txt_describe');
        $product->price = $request->input('txt_price');
        $product->promotion_price = $request->input('txt_promotion_price');
        $product->quantity = $request->input('txt_quantity');
        $product->firm = $request->input('txt_firm');

        if ($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file->move(public_path('upload/image_products'), $filename);
            $product->image = $filename;
        }else{
            return $request;
            $value->image = '';
        }

        $product->save();

        $add_product_success = Session::get('add_product_success');
        Session::put('add_product_success');
        return redirect()->back()->with('add_product_success', 'Đã thêm sản phẩm mới');

    }

    public function getViewImportProduct(){
        if(Auth::check() && Auth::user()->id_level < 3){
            return view('admin.manage_products.import_product');
        }else{
            return view('page.home');
        }
    }

    public function getImportProduct(Request $request){
        Excel::import(new ProductImport,$request->file('file_excel'));

        $add_product_excel = Session::get('add_product_excel');
        Session::put('add_product_excel');
        return redirect()->back()->with('add_product_excel', 'Đã thêm tất cả sản phẩm từ file excel.');
    }

    public function getExportProduct(){
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function getSearchProduct(Request $request){
        $product = DB::table('products')
            ->where('name', 'LIKE' , '%'.$request->input('txt_search').'%')
            ->orWhere('firm', 'LIKE' , '%'.$request->input('txt_search').'%')->paginate(10);

        return view('admin.manage_products.manage_products', compact('product'));
    }

    // manage order
    public function getManageOrder(){
        if(Auth::check() && Auth::user()->id_level < 3){
            $bill = DB::table('bills')->paginate(10);
            return view('admin.manage_order.manage_order', compact('bill'));
        }else{
            return view('page.home');
        }
    }

    public function getSearchOrder(Request $request){
        $search = DB::table('customers')->select('id')
            ->where('name', 'LIKE' , '%'.$request->input('txt_search').'%')
            ->orWhere('email', 'LIKE' , '%'.$request->input('txt_search').'%')
            ->orWhere('phone', 'LIKE' , '%'.$request->input('txt_search').'%')->groupBy('id');

        $bill = DB::table('bills')->joinSub($search,'customers', function($join){
            $join->on('bills.id_customer', '=', 'customers.id');
        })->paginate(10);

        return view('admin.manage_order.manage_order', compact('bill'));
    }

    public function getOrderDetail(Request $request, $id){
        if(Auth::check() && Auth::user()->id_level < 3){
            $bill_detail = DB::table('bill_details')->where('id_bill', $id)->paginate(10);
            return view('admin.manage_order.manage_order_detail', compact('bill_detail'));
        }else{
            return view('page.home');
        }
    }

    // manage banner
    public function getManageBanner(){
        if(Auth::check() && Auth::user()->id_level < 3){
            $banner = DB::table('banners')->paginate(8);
            return view('admin.manage_banner.manage_banner', compact('banner'));
        }else{
            return view('page.home');
        }
    }

    public function getAddBanner(Request $request){
        $banner = new Banner;
        if ($request->hasfile('file')){
            $file = $request->file('file');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file->move(public_path('upload/image_banner'), $filename);
            $banner->image = $filename;
        }else{
            return $request;
            $value->image = '';
        }
        $banner->save();
        $add_banner_success = Session::get('add_banner_success');
        Session::put('add_banner_success');
        return redirect()->back()->with('add_banner_success', 'Đã thêm banner mới');
    }

    public function getDeleteAllBanner(Request $request){

        $ids = $request->ids;
        DB::table("banners")->whereIn('id',explode(",",$ids))->delete();

        $delete_all_banner = Session::get('delete_all_banner');
        Session::put('delete_all_banner');

        return redirect()->back()->with('delete_all_banner', 'Đã xóa tất cả banner');
    }

    public function getSearchBanner(Request $request){
        $name = $request->input('txt_search');
        $banner = DB::table('banners')->where('image', 'LIKE' , '%'.$request->input('txt_search').'%')->paginate(8);
        $banner->appends($request->only('txt_search'));
        return view('admin.manage_banner.manage_banner', compact('banner'));
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
