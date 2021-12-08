<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Admin;
use App\Models\Tax;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;


class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Tax::all();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)

                            ->addColumn('action', function(Tax $data) {
                                $delete ='<a href="javascript:;" data-href="' . route('admin-tax-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                return '<div class="action-list"><a data-href="' . route('admin-tax-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>'.$delete.'</div>';
                            }) 

                            ->editColumn('country_id', function(Tax $data) {
                                
                                if($data->country_id==0){
                                 $name= 'State : ' .$data->state->name. '';
                                 return $name;
                                }

                                else{
                                $name='Country : ' .$data->country->name. '';
                                return $name;
                                }
                                
                            })

                            ->editColumn('amount', function(Tax $data) {

                                    return $data->amount."%";
                                
                                
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
  	public function index()
    {
        return view('admin.tax.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.tax.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section

        // $validator = Validator::make(Input::all(), $rules);
        
        // if ($validator->fails()) {
        //   return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        // }
        //--- Validation Section Ends

        //--- Logic Section

        $data = new Tax();
        if($request->taxby==1){
        $data->country_id=$request->country;            
        }
        else{
        $data->state_id=$request->state;            
        }

        $data->amount=$request->tax;
        
        $data->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    
    }


    public function edit($id)
    {
        $data = Tax::findOrFail($id);  
        return view('admin.tax.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        //--- Validation Section
        $data=Tax::findOrFail($id);
        $data->amount=$request->tax;
            $data->update();
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);

 
    }

    //*** GET Request
    public function show($id)
    {
        $data = Admin::findOrFail($id);
        return view('admin.staff.show',compact('data'));
    }

    //*** GET Request Delete
    public function destroy($id)
    {

        $data = Tax::findOrFail($id);
        //If Photo Doesn't Exist

        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    
    }
}
