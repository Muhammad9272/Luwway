@extends('layouts.load')
@section('content')

                        <div class="content-area no-padding">
                            <div class="add-product-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area">

                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>{{ __("User ID#") }}</th>
                                                <td>{{$withdraw->user->id}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("User Name") }}</th>
                                                <td>
                                                    <a href="{{route('admin-user-show',$withdraw->user->id)}}" target="_blank">{{$withdraw->user->name}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Amount") }}</th>
                                                <td>{{$sign->sign}}{{ round($withdraw->amount * $sign->value , 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Charge") }}</th>
                                                <td>{{$sign->sign}}{{ round($withdraw->fee * $sign->value , 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Process Date") }}</th>
                                                <td>{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Status") }}</th>
                                                <td>{{ucfirst($withdraw->status)}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("User Email") }}</th>
                                                <td>{{$withdraw->user->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("User Phone") }}</th>
                                                <td>{{$withdraw->user->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Withdraw Method") }}</th>
                                                <td>{{$withdraw->method}}</td>
                                            </tr>
                                            @if($withdraw->method == "Payoneer" || $withdraw->method == "Paypal" || $withdraw->method == "Skrill")
                                            <tr>
                                                <th>{{$withdraw->method}} {{ __("Email") }}:</th>
                                                <td>{{$withdraw->acc_email}}</td>
                                            </tr>
                                            @elseif($withdraw->method == "Bank") 
                                            <tr>
                                                <th>{{$withdraw->method}} {{ __("Account") }}:</th>
                                                <td>{{$withdraw->iban}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Account Name") }}:</th>
                                                <td>{{$withdraw->acc_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Country") }}</th>
                                                <td>{{ucfirst(strtolower($withdraw->country))}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Address") }}</th>
                                                <td>{{$withdraw->address}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{$withdraw->method}} {{__("Swift Code")}}:</th>
                                                <td>{{$withdraw->swift}}</td>
                                            </tr>
                                            @elseif($withdraw->method=="MoneyGram" || $withdraw->method=="Western union")

                                             <tr>
                                                <th><h4>{{$withdraw->method}} {{ __("Details") }}</h4></th>
                                                
                                            </tr>
                                            <tr>
                                                <th>{{ __("First Name") }}:</th>
                                                <td>{{$withdraw->fname}}</td>
                                            </tr>
                                            @if($withdraw->mname)
                                            <tr>
                                                <th>{{ __("Middle Name") }}:</th>
                                                <td>{{$withdraw->mname}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>{{ __("Last Name") }}:</th>
                                                <td>{{$withdraw->lname}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{ __("Phone no") }}:</th>
                                                <td>{{$withdraw->phone_no}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Address") }}:</th>
                                                <td>{{$withdraw->aaddress}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Country") }}:</th>
                                                <td>{{$withdraw->countryy->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("State") }}:</th>
                                                <td>{{$withdraw->state->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("City") }}:</th>
                                                <td>{{$withdraw->city}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Zip code") }}:</th>
                                                <td>{{$withdraw->zip_code}}</td>
                                            </tr>
                                           @if($withdraw->aemail)
                                            <tr>
                                                <th>{{ __("Email") }} :</th>
                                                <td>{{$withdraw->aemail}}</td>
                                            </tr>
                                            @endif



                                            @endif


                                        </table>
                                    </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


@endsection