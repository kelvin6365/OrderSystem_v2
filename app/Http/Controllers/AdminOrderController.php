<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Orders;
use App\Orders_items;
use App\Products;
use Redirect;

class AdminOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
        
        return view('admin.adminorder');
    }

    public function order_list()
    {
        $Orders = Orders::orderBy('created_at', 'DESC')->get();
        $Orders_item = Orders_items::get();
        return view('admin.adminorders_list',compact('Orders','Orders_item'));
    }

    public function test_event(Request $request)
    {
      
        $input = Input::all();
        $rules = array(
                         
                        'c_name' => 'required',   
                        'order_state' => 'required',  
                        'order_handle' => 'required', 
                           
                     );  
        $validator = Validator::make($input, $rules);
       
   
       
        //$order_code = str_pad($input['order_code'],9,'0',STR_PAD_LEFT);
        $order_code = time();
        //print($input['order_code'].$input['c_name'].$input['email'].$input['phone_no'].$input['adress'].$input['c_option'].$input['order_paystate'].$input['order_state'].$input['order_handle']);

        if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput();
                }else{
                        $tab = Orders::create([
                                         'order_code' => $order_code,
                                         'c_name' => Input::get('c_name'),
                                         'email' => Input::get('email')?? '',     
                                         'phone_no' =>Input::get('phone_no'),    
                                         'adress' => Input::get('adress'),   
                                         'type_total' => Input::get('total_type'),  
                                         'c_option' => Input::get('c_option')?? '',
                                         'order_paystate' => Input::get('order_paystate'),
                                         'order_state' => Input::get('order_state'),
                                         'order_handle' => Input::get('order_handle'),                                        
                                       
                                     ]);
                  
                       
                      
                    }

                 
        if(!empty($input['item_name'])){
                    $item_names = $input['item_name'];
                    $item_nos = $input['item_no'];
                    $item_counts = $input['count']; 
                    $item_price= $input['item_price'];    
                    $item_option= $input['item_option'];         
                    foreach ($item_names as $key => $item_name) {
                        //print($item_name."  ".$item_counts[$key]." ".$item_price[$key]." ".$item_option[$key]."</br>") ;
                        $tab = Orders_items::create([
                                         'order_code' => $order_code,
                                         'item_no' => $item_nos[$key],
                                         'item_name' => $item_names[$key],
                                         'count' => $item_counts[$key],     
                                         'item_price' =>$item_price[$key],    
                                         'item_option' =>  $item_option[$key]?? '',     
                                         'state' => '0',
                                                                           
                                       
                                     ]);
                        
                 } 
                 

                
                
               
                
                }
                
                return redirect('adminorder_list')->with('alert', '成功新增! 訂單號碼為 : '.$order_code);
    }

    public function action($id,$case){

        switch ($case) {
            case '1':
                $active = Orders::where('order_code','=',$id)->first();
                $active->order_paystate = 1;
                $active->save();
                return redirect('adminorder_list');
                break;

            case '2':
                $active = Orders::where('order_code','=',$id)->first();
                $active->order_state = 2;
                $active->save();
                return redirect('adminorder_list');
                break;

            case '3':
                $Orders = Orders::where('order_code','=',$id)->first();
                $Orders_items = Orders_items::where('order_code','=',$id)->get();   
                             
              
                return view('admin.adminorder_edit',compact('Orders','Orders_items'));
                break;

            case '4':
                $office = Orders::where('order_code','=',$id)->first();
                $Orders_items = Orders_items::where('order_code','=',$id)->get();   
                foreach ($Orders_items as $key => $Orders_item) {
                   $Orders_item->delete();
                }              
                $office->delete();
                return redirect('adminorder_list');
                break;

            case '5':
                $Orders = Orders::where('order_code','=',$id)->first();
                   
                $input = Input::all();
                $rules = array(
                                 
                                'c_name' => 'required',   
                                'order_state' => 'required',  
                                'order_handle' => 'required', 
                                   
                             );  
                $validator = Validator::make($input, $rules);   
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput();
                }else{
                    $Orders->c_name = $input['c_name'];
                    $Orders->email = $input['email']?? '';
                    $Orders->phone_no = $input['phone_no'];
                    $Orders->adress = $input['adress'];
                    $Orders->c_option = $input['c_option']?? '';
                    $Orders->order_paystate = $input['order_paystate'];
                    $Orders->order_state = $input['order_state'];
                    $Orders->order_handle = $input['order_handle'];
                    $Orders->save();

                    if(!empty($input['item_name'])){
                        $Orders_items = Orders_items::where('order_code','=',$id)->get();
                        foreach ($Orders_items as $key => $Orders_item) {
                        $Orders_item->delete();
                        }
                        $item_names = $input['item_name'];
                        $item_nos = $input['item_no'];
                        $item_counts = $input['count']; 
                        $item_price= $input['item_price'];    
                        $item_option= $input['item_option']; 
                        foreach ($item_names as $key => $item_name) {
                        //print($item_name."  ".$item_counts[$key]." ".$item_price[$key]." ".$item_option[$key]."</br>") ;
                        $tab = Orders_items::create([
                                         'order_code' => $id,
                                         'item_no' => $item_nos[$key],
                                         'item_name' => $item_names[$key],
                                         'count' => $item_counts[$key],     
                                         'item_price' =>$item_price[$key],    
                                         'item_option' =>  $item_option[$key]?? '',     
                                         'state' => '0',
                                                                           
                                       
                                     ]);   
                        }
                    }

                }  
            
                return Redirect::back()->with('alert', '成功更改! 訂單號碼為 : '.$id);
                break;

           

            default:
                
                return redirect('adminorder_list');
                break;
        }
        
        
       
    }
    public function delete_item($id){
        $item = Orders_items::where('id',$id)->first();
        $item_name = $item->item_name;
        $item->delete();
        return Redirect::back()->with('alert', '成功刪除一項貨品! 貨品為 : '.$item_name);
    }

    public function SearchProduct(Request $request,$id)
    {
        $search = $id;
        $keywords = Input::get('keywords');
        //print($id);

        if (is_null($search))
        {
               
        }
        else
        {
            $posts = Products::where('item_no','LIKE',"%{$search}%")
                           ->first();
            $product_name = $posts->item_name;
           
            return response()->json(
                $product_name
              );
            print($product_name);
            //return view()->with(['product_name'=>$product_name]);
        }

       
      


    }
}
