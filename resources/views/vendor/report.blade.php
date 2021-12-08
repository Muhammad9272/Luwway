@extends('layouts.vendor') 
<style type="text/css">
    .c-info-box-area {
    padding: 2px 30px 38px;}
</style>
@section('content')
 
        <div class="content-area content-area-mob content-area-mob-2" style="width: 63%">

                         <div class="chart-custom">
                            <div class="row row-cards-one">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="card">
                                        <div class="lower-cont-graph">
                                            
                                            <h5 class="card-header" style="border-bottom: none !important">Total Sales in {{$j}} Last Days</h5>
                                            <form action="{{route('vendor-reports')}}" id="chart-form1" method="get">
                                                <div class="form-group" style="padding-top: 12px">                                
                                                    <select class="form-control" id="sortby234" name="sortby">                            
                                                    <option selected="" disabled="">Select</option>               
                                                    <option value="234-7" {{($j==7)?'selected':''}}>Last 7 days</option>
                                                    <option value="234-30" {{($j==30)?'selected':''}}>Last 30 days</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <input type="hidden" class="sortby" name="sortby" value="34">   

                                        <div class="card-body">

                                            <canvas id="lineChart"></canvas>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-12 d-bloks d-inline-flex border-top">
                                <div class="col-md-3 border-right">
                                    <div class="chart-content ">
                                        <p><strong>{{$clicks}}</strong></p>
                                        <p>Total Views<p>
                                    </div>
                                </div>
                                <div class="col-md-3 border-right">
                                     <div class="chart-content ">
                                        <p><strong>{{$tsales->count()}}</strong></p>
                                        <p>Total Sales<p>
                                    </div>
                                </div>
                                <div class="col-md-3 border-right">
                                    <div class="chart-content ">
                                    <p><strong>{{$tsales->sum('price')}}$</strong></p>
                                    <p>Total Revenue</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="chart-content">
                                    <p><strong>0%</strong></p>
                                    <p>Revenue Change</p>
                                    </div>
                                </div>
                            </div>                           
                         </div>
                        
                                      
                         <br><br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="most-view ">
                                    <div class="d-inline-flex">
                                        <p style="line-height: 36px"><strong>Most Viewed Items</strong></p>&nbsp;
                                        <div class="form-group">                                
                                                    <select class="form-control" id="sortby334">                                                
                                                    <option value="334-7">All Time</option>
                                                    {{-- <option value="334-30">Last 30 days</option> --}}
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="scroll-table" id="style-6">
                                        <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                     @foreach($poproducts as $data )
                                                      <tr>
                                                        <td><img style="width: 50px" src="{{asset('assets/images/products/'.$data->photo)}}"></td>
                                                        
                                                        <td>{{ Illuminate\Support\Str::limit($data->name, 16) }}</td>
                                                      </tr>
                                                      @endforeach
     
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>                               
                            <div class="col-md-6">
                                <div class="most-view">
                                    <div class="d-inline-flex">
                                        <p style="line-height: 36px"><strong>Most Viewed Categories</strong></p> &nbsp;
                                        <div class="form-group">                                
                                            <select class="form-control" id="sortby434">                                                
                                            <option value="434-7">All Time</option>
                                            {{-- <option value="434-30">Last 30 days</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="scroll-table">
                                        @php
                                        $arr=[];
                                           foreach($poproducts as $data){
                                            $arr[]=$data->category->name;                                            
                                           }

                                            $arr=array_unique($arr);
                                            // dd($arr);
                                        @endphp
                                        <ul>
                                            @foreach($arr as $arr)
                                            <li>{{$arr}}</li>
                                            @endforeach
                                            
                                        </ul>

                                    </div>
                                </div>
                               
                            </div>
                         </div>
                         <br><br>

                         <div class="row">
                            <div class="col-md-12">
                                <div class="border-content">
                                    <div class="sales-year">
                                        <div class="border-bottom">
                                           <p class="report4">Sales Report 2020</p>
                                        </div>
                                        <div class="sales-content">
                                            <p class="summ">Summary</p>

                                             
                                            <table class="table table-hover">
                                                <thead>
                                                  <tr>
                                                    <th style="font-weight: 500">Total sales & Revenue</th>
                                                   
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>Sales</td>

                                                    <td>{{$ttsales->count()}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Revenue</td>

                                                    <td>{{$ttsales->sum('price')}} $</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Final Value Fees</td>

                                                    <td>0$</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Tax Collected</td>

                                                    <td>0</td>
                                                  </tr>
                                                </tbody>
                                            </table>

                                            <p class="summ">Monthly Sales</p>

                                            {{-- <p>No Sales To show </p> --}}

                                            <table class="table table-hover">
                                                <thead>
                                                  <tr>
                                                    <th>Month</th>
                                                    <th>Sales</th>
                                                    <th>Earnings</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($ysales as $ysale)
                                                      <tr>
                                                        <td>{{$ysale['monthname']}}</td>
                                                        <td>{{$ysale['msales']}}</td>
                                                        <td>{{$ysale['sums']}}$</td>
                                                      </tr>
                                                      @endforeach
                                                  
                                                </tbody>
                                            </table>



                                        </div>




                                        {{-- <div class="sales-content">
                                            <p><strong>Summary:</strong></p>

                                             <p><strong>Total sales & Revenue</strong></p>
                                             <div class="sales-content-gen d-inline-flex">
                                                 <p>Sales </p><p class="price">0</p>
                                             </div><br>
                                             <div class="sales-content-gen d-inline-flex">
                                                 <p>Revenue</p><p lass="price">0$</p>
                                             </div><br>
                                             <div class="sales-content-gen d-inline-flex">
                                                 <p>Final Value Fees</p><p lass="price">0</p>
                                             </div><br>
                                             <div class="sales-content-gen d-inline-flex">
                                                 <p>Tax Collected</p><p lass="price">0</p>
                                             </div>

                                        </div> --}}
                                        
                                    </div>
                                </div>
                            </div>                            
                         </div>

                    </div>
                    <nav class="nav-sidebar nav22 border nav22-mob-1" >

                                    <div class="upper-side border-bottom" >
                                         <i class="fa fa-bell"  aria-hidden="true"></i>
                                         <br><br>
                                         @if($not>0)
                                         <p><a href="{{route('vendor-order-index')}}">You have {{$not}} new Notification(s)</a></p>
                                         @else
                                         <p>No new Notification</p>
                                         @endif
                                    </div>
                     
                                    <div class="lower-cont" >
                                        <p><strong>Recent Activity:</strong></p>&nbsp;&nbsp;                                  
                                       <div class="form-group">                                
                                        <form action="{{route('vendor-reports')}}" id="chart-form2" method="get">                           
                                            <select class="form-control" id="sortby534" name="sort">
                                            <option value="all" selected>All Time</option>               
                                            <option value="334-7" {{($i==7)?'selected':''}}>Last 7 days</option>
                                            <option value="334-30" {{($i==30)?'selected':''}}>Last 30 days</option>
                                            </select>
                                        </form>
                                        </div>
                                    </div>
                                     @if(count($notifications)>0)
                                    <div class="d-inline-flex" style="padding-left: 19px">
                                         <p><strong>Orders Received</strong><p>&nbsp;&nbsp;&nbsp;&nbsp;

                                         <p><a href="{{route('vendor-order-notf-clear',Auth::user()->id)}}">Clear ALL</a></p>
                                     </div>
                                     <div class="scroll-table" id="style-6">
                                        <ul>
                                                                              

                                            @foreach($notifications as $not)
                                            <li><a href="{{route('vendor-order-show',$not->order_number)}}"> Order no:{{$not->order_number}}</a> </li>
                                            @endforeach
                                           

                                        </ul>
                                    </div>
                                     @else
                                        <p style="padding-left: 20px">No Activity Found</p>
                                        @endif
                    </nav>


@endsection
@section('scripts')
<script language="JavaScript">
    displayLineChart();

    function displayLineChart() {
        var data = {
            labels: [
            {!!$days!!}
            ],
            datasets: [{
                label: "Prime and Fibonacci",
                fillColor: "#3dbcff",
                strokeColor: "#0099ff",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [
                {!!$sales!!}
                ]
            }]

        };
        var ctx = document.getElementById("lineChart").getContext("2d");
        var options = {
            responsive: true
        };
        var lineChart = new Chart(ctx).Line(data, options);
    }


    
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#sortby234").on('change',function () {
            $('#chart-form1').submit();
        })
        $("#sortby534").on('change',function () {
            $('#chart-form2').submit();        
        })
    })
</script>
@endsection