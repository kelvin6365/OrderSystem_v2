@extends('admin.adminapp')

@section('content')

     <section id="main-content">
     
      <!-- Example DataTables Card-->
      <section class="wrapper site-min-height">
         <h3><i class="fa fa-angle-right "></i> 訂單 </h3>         
            <hr>  
            <a href="{{route('adminorder_list') }}"><button class="btn-info pull-ledt " >返回 訂單列表</button> </a>          
            <br>
       <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <br>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('post', ['id' => $Orders->order_code , 'case' => '5'])}}">
                        {{ csrf_field() }}

                     <!--    <div class="form-group">
                            <label for="order_code" class="col-md-4 control-label">訂單ID</label>

                            <div class="col-md-6">
                                <input id="order_code" type="text" class="form-control" name="order_code" value="" readonly>
                              
                            </div>
                        </div> -->
                        @if (session('alert'))
                            <div class="alert alert-success">
                                {{ session('alert') }}
                            </div>
                        @endif
                        <div class="form-group{{ $errors->has('c_name') ? ' has-error' : '' }}">
                            <label for="c_name" class="col-md-4 control-label">客戶名稱</label>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control" name="c_name" value="{{$Orders->c_name}}" required autofocus>

                                @if ($errors->has('c_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">客戶電郵</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$Orders->email}}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone_no" class="col-md-4 control-label">客戶聯絡電話</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="number" class="form-control" name="phone_no" value="{{$Orders->phone_no}}" required>

                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="adress" class="col-md-4 control-label">客戶地址</label>

                            <div class="col-md-6">
                                <input id="adress" type="adress" class="form-control" name="adress" value="{{$Orders->adress}}" required>

                                @if ($errors->has('adress'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label for="c_option" class="col-md-4 control-label">客戶備註</label>

                            <div class="col-md-6">
                                <input id="c_option" type="text" class="form-control" name="c_option" value="{{$Orders->c_option}}">

                            </div>
                        </div>
                        <hr>
                    

                    

                       
                         <table name="table" id="table" class="table table-striped table-bordered">
                              <thead>
                              <tr>
                                  <th>貸品編號</th>
                                  <th>貸品名稱</th>
                                  <th>貸品數量</th>
                                  <th>價錢</th>
                                  <th>備註欄</th>
                                  
                                  <th class="action">Action</th>
                          
                              </tr>
                              </thead>

                              <tbody id="tbody">
                          @foreach($Orders_items as $index => $Orders_item)
                              <tr>
                                <td>                     
                                   <input id="item_no" type="text" class="form-control" name="item_no[{{$index}}]" value="{{$Orders_item->item_no}}" placeholder="" onkeyup="up(this.name)" required autofocus>

                                      @if ($errors->has('item_no'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('item_no') }}</strong>
                                          </span>
                                      @endif
                                  </td>
                                  <td>                     
                                   <input id="item_name" type="text" class="form-control" name="item_name[{{$index}}]" value="{{$Orders_item->item_name}}" required autofocus>

                                      @if ($errors->has('item_name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('item_name') }}</strong>
                                          </span>
                                      @endif
                                  </td>
                                  <td>
                                     <input id="count" type="number" class="form-control" onkeyup="type_change();" name="count[{{$index}}]" value="{{$Orders_item->count}}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </td>
                                  <td>
                                    <input id="item_price" type="number" class="form-control" name="item_price[{{$index}}]"  value="{{$Orders_item->item_price}}" required autofocus>

                                      @if ($errors->has('item_price'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('item_price') }}</strong>
                                          </span>
                                      @endif
                                  </td>
                                  <td>
                                     <input id="item_option" type="text" class="form-control" name="item_option[{{$index}}]" value="{{$Orders_item->item_option}}"  autofocus>

                                      @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </td>
                                  
                                  <td>                      
                                      <a href="{{route('delete_item', ['id' => $Orders_item->id])}}"><input type="button"  name="" value="Delete" class="btn btn-danger btn-xs"></a>
                                      </a>
                                  </td>
                               
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <table>
                          <tbody>
                              <tr style="font-size: 18px;">
                                <form   name="add">
                                  <td  >
                                     
                                                                  
                                          <input type='button' id='button' onclick='input()' class=" btn btn-sm btn-primary" value="+ 增加"> 


                                  
                                     </td>
                                     <td  >
                                     
                                                                  
                                          &nbsp 


                                  
                                     </td>
                                     <td style="font-weight: bold;color: Green;text-align: right" align="right" >
                                       貸品總類 :<span id="total_type">0</span><span>款 總數 :</span><span id="total_count">0</span>件
                                       <input type="text" id="total_type_input" name="total_type" hidden="hidden" readonly>
                                       </div> 
                                     
                                  </td>
                              </form>
                              </tr>
                            
                              </tbody>
                          </table>

                          <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">付款狀態</label>

                            <div class="col-md-6">
                                {{ Form::radio('order_paystate', '1' ,$Orders->order_paystate==1) }} <font color="Green"> 已付款 </font>
                                {{ Form::radio('order_paystate', '0',$Orders->order_paystate==0) }}<font color="Red">待付款</font>

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">訂單狀態</label>

                            <div class="col-md-6">
                                {{ Form::radio('order_state', '2' ,$Orders->order_state==2) }} <font color="Green"> 已寄出 </font>
                                {{ Form::radio('order_state', '1' ,$Orders->order_state==1) }} <font color="Blue"> 已留貨 </font>
                                {{ Form::radio('order_state', '3' ,$Orders->order_state==3) }}<font color="black"> 要制作 </font>  
                                {{ Form::radio('order_state', '5' ,$Orders->order_state==5) }}<font color="black"> 要制作+已留貨 </font>
                                {{ Form::radio('order_state', '0',$Orders->order_state==0) }}<font color="Gray">制作中</font>
                                {{ Form::radio('order_state', '4' ,$Orders->order_state==4) }}<font color="Gray"> 制作中+已留貨 </font>

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="order_handle" class="col-md-4 control-label">處理人</label>

                            <div class="col-md-6">
                                <input id="order_handle" type="text" class="form-control" name="order_handle" value="{{ Auth::user()->name }}" readonly>

                            </div>
                          </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3" align="center">
                                <button  type="submit" class="btn btn-primary">
                                    確認
                                </button>
                            </div>
                        </div>
            
                  </form>
                </div>
            </div>
        </div>

</section>
  
</section>
<script type="text/javascript">

  onload = function check(){document.getElementById("total_type").innerHTML =  document.getElementById("tbody").rows.length;};
    // body...
 
function type_change(){
    var tds = document.getElementById("table").getElementsByTagName('td');
    var sum = 0;
    var x =0;
   $('table#table input[id=count').each(function()
     {
      x = document.getElementById("tbody").rows.length;
      if($(this).val()  == null ||$(this).val()  == '')
      {
        sum += 0;
      }
      else

      {
        sum += parseInt($(this).val());
      }
      
     });

    


    document.getElementById("total_type").innerHTML =  document.getElementById("tbody").rows.length;
    document.getElementById("total_type_input").value =  document.getElementById("tbody").rows.length;
    document.getElementById("total_count").innerHTML =sum;
}

 var sum = 0;

 
function input() {
  
    var table = document.getElementById("tbody");
    var x = document.getElementById("tbody").rows.length;
    
    var row = table.insertRow(x);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    cell1.innerHTML = "<input id='item_name' type='text' class='form-control' name='item_name"+'['+x+']'+"' onkeyup='up(this.name)'  required autofocus>";
    cell2.innerHTML = "<input id='count' type='number' class='form-control' name='count"+'['+x+']'+"' onkeyup='type_change();'  required autofocus>";
    cell3.innerHTML = "<input id='item_price' type='number' class='form-control' name='item_price"+'['+x+']'+"'  required autofocus>";
    cell4.innerHTML = "<input id='item_option' type='text' class='form-control' name='item_option"+'['+x+']'+"'   autofocus>";
    cell5.innerHTML = " <input type='button' onclick='deleteRow(this)'' name='' value='Delete' class='btn btn-danger btn-xs'>";
    type_change();
    
}
</script>
<script>
function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table").deleteRow(i);
    type_change();
}
</script>  
<script>
  function up(eleName){
        var str=  $("input[name='"+eleName+"']").val();
        var output_text = eleName.replace(/item_no/g,"item_name");
       
       if(str == "") {
               //$( "#txtHint" ).html("<b>Blogs information will be listed here...</b>"); 
       }else {
             /*  $.get( "{{ url('/adminorder/Search/') }}".str, function( data ) {
                   //$( "#txtHint" ).html( data );  
                 
                   document.getElementById("item_name").value = '{{ $product_name or '' }}';
            });*/

            $.get('/adminorder_list/Search/' + str, function(response) {
            // handle your response here
            var name = JSON.stringify(response);
            $("input[name='"+output_text+"']").val(name.replace(/"/g,""));
            console.log(response);
            })
       }
   }  
</script>
@endsection
