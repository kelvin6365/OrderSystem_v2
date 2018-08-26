@extends('admin.adminapp')

@section('content')
<section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right "></i> 訂單 </h3>         
            <hr>
            
              {{ csrf_field() }}
            <a href="{{ route('adminorder') }}"><button type="submit" class="btn-info pull-right " >+ 增加訂單</button> </a>
      
            <br>
        <div class="row mt">
          @if (session('alert'))
                            <div class="alert alert-success">
                                {{ session('alert') }}
                            </div>
                        @endif
           <table id="mytable" class="table table-striped table-bordered">
              <thead>
              <tr>
                  <th>訂單號碼</th>
                  <th>客戶名稱</th>
                  <th>客戶電郵</th>
                  <th>客戶電話</th>
                  <th>客戶地址</th>
                  <th>貨品款數</th>
                  <th>付款狀態</th>
                  <th>訂單狀態</th>                  
                  <th>訂單日期</th>
                  <th>處理人</th>
                  
                  <th class="action">功能</th>
          
              </tr>
              </thead>

              <tbody>
             @foreach($Orders as $index => $order)
              <tr>
                  <td>
                      
                      <a href= "">{{$order->order_code}}</a>
                      
                  </td>
                  <td>
                      {{$order->c_name}}
                  </td>
                  <td>
                     {{$order->email}}
                  </td>
                  <td>
                    {{$order->phone_no}}
                  </td>
                  <td>
                   {{$order->adress}}
                  </td>
                  <td>
                   {{$order->type_total}}
                  </td>
                  <td>
                    @if($order->order_paystate == 0) <font color="Red">待付款</font>
                    @elseif($order->order_paystate == 1) <font color="Green"> 已付款 </font>
                    @endif
                  </td>
                  <td>
                    @if($order->order_state == 0) <font color="Gray">制作中</font>
                    @elseif($order->order_state == 1)  <font color="Blue"> 已留貨 </font>
                    @elseif($order->order_state == 2) <font color="Green"> 已寄出 </font>  
                    @elseif($order->order_state == 3) <font color="black"> 要制作 </font>  
                    @elseif($order->order_state == 4) <font color="Gray"> 制作中+已留貨 </font>  
                    @elseif($order->order_state == 5) <font color="black"> 要制作+已留貨 </font>  
                    @endif
                  </td>
                   <td>
                    {{$order->created_at}}
                  </td>
                  <td>
                    {{$order->order_handle}}
                  </td>
                  <td>
                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal{{$index}}" >
                          <span class="glyphicon glyphicon-edit"></span> 更多資料 
                      </button>
                      <a href="{{route('order_action', ['id' => $order->order_code , 'case' => '3'])}}" class="btn btn-default btn-xs" >
                          <span class="glyphicon glyphicon-edit"></span> 更改訂單
                      </a>
                      @if($order->order_paystate == 0 ) 
                      <a href="{{route('order_action', ['id' => $order->order_code , 'case' => '1'])}}" class="btn btn-success btn-xs"  onclick="return ConfirmPayment()">
                          <span class="glyphicon glyphicon-edit"></span> 已付款
                      </a>
                      @elseif($order->order_paystate == 1)                   
                   
                      @endif
                      
                      @if($order->order_state != 2 ) 
                      <a href="{{route('order_action', ['id' => $order->order_code , 'case' => '2'])}}" class="btn btn-success btn-xs"  onclick="return ConfirmSend()">
                          <span class="glyphicon glyphicon-edit"></span> 已寄出
                      </a>
                    
                      @endif
                      
                      <a href="{{route('order_action', ['id' => $order->order_code , 'case' => '4'])}}" class="btn btn-danger btn-xs" onclick="return ConfirmDelete()">
                          <span class="glyphicon glyphicon-trash"></span> 刪除
                      </a>
                      <script>

                        function ConfirmDelete()
                        {
                        var x = confirm("你確定要刪除此項訂單嗎?");
                        if (x)
                          return true;
                        else
                          return false;
                        }
                        function ConfirmSend()
                        {
                        var x = confirm("你確定已寄出此項訂單嗎?");
                        if (x)
                          return true;
                        else
                          return false;
                        }
                        function ConfirmPayment()
                        {
                        var x = confirm("你確定客人已付此項訂單的費用嗎?");
                        if (x)
                          return true;
                        else
                          return false;
                        }

                      </script>
                      <!-- Modal -->
                        <div class="modal fade" id="myModal{{$index}}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ $order->order_code}} 資料</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                        <div class="form-group">
                                          <h4 class="col-md-4 control-label" for="email">客人備註 :</h4>  
                                          <h4 class="col-md-4">
                                            {{$order->c_option}}
                                             
                                          </h4>
                                        </div>
                                    </div>                               
                                 <hr>
                                 @foreach ($Orders_item as $items)

                                 @if($items->order_code == $order->order_code)
                               
                                    <div class="row" >
                                        <div class="form-group">
                                          <label class="col-md-4 control-label" for="email">貨品編號</label>  
                                          <div class="col-md-4">
                                             {{ $items->item_no}}
                                             
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row" >
                                        <div class="form-group">
                                          <label class="col-md-4 control-label" for="email">貨品名稱</label>  
                                          <div class="col-md-4">
                                             {{ $items->item_name}}
                                             
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                          <label class="col-md-4 control-label" for="email">貨品數量</label>  
                                          <div class="col-md-4">
                                             {{ $items->count}}
                                             
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                          <label class="col-md-4 control-label" for="email">貨品價錢</label>  
                                          <div class="col-md-4">
                                              {{ $items->item_price}}
                                             
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                          <label class="col-md-4 control-label" for="email">貨品備註</label>  
                                          <div class="col-md-4">
                                              {{ $items->item_option}}
                                             
                                          </div>
                                        </div>
                                    </div>
                                   <!-- <div class="row">
                                        <div class="form-group">
                                          <label class="col-md-4 control-label" for="email">貨品狀態</label>  
                                          <div class="col-md-4">
                                           
                                            @if($items->state == 0) <font color="Gray">處理中</font>
                                            @elseif($items->state == 1)  <font color="Red"> 缺貸 </font>
                                            @elseif($order->order_state == 2) <font color="Green"> 已準備 </font>  
                                            @endif
                                             
                                          </div>
                                        </div>
                                    </div>-->
                                    <hr>
                                    
                           
                                 @endif
                                 @endforeach 
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                  </td>
               
              </tr>
        @endforeach
              </tbody>
          </table>
        

    </section>
@endsection
