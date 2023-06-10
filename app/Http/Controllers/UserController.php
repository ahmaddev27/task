<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('user.index');
    }

    public function all(){
        return view('user.index');
    }


    public function list(User $iteam ){
        return DataTables::of($iteam->orderBy('created_at','DESC'))
            ->addIndexColumn()

            ->editColumn('status',function ($item){
                if ($item->status==1){
                    return  '<a href="#" class="badge badge-circle badge-success">active</a>';
                }else{
                    return '<a href="javascript:void(0)" class="badge badge-circle badge-secondary">inactive</a>';
                }
            })
            ->editColumn('action', function ($iteam) {

                if ($iteam->status==1){
                    $s=' <a  id="status"class="btn  btn-rounded btn-secondary btn-sm" href="#" route="' . route('user.status') . '" model_id="' . $iteam->id . '"
                        status="0"
                    data-toggle="modal"
                              title="Change status">

                            <i class="mdi mdi-check-circle-outline color-dark"></i>

                                    </a>';
                }else{
                 $s=' <a  id="status"class="btn  btn-rounded btn-success btn-sm" href="#" route="' . route('user.status') . '" model_id="' . $iteam->id . '"
                          status="1"
                    data-toggle="modal"
                              title="Change status">

                            <i class="mdi mdi-check-circle-outline color-success"></i>

                                    </a>';
                }

                return  $s.'

                <a  id="edit"class="btn  btn-rounded btn-primary btn-sm" href="' . route('user.view',$iteam->id) . '"

                                title="View">

                              <i class="fa fa-eye color-primary"></i>

                                    </a>





                <a  id="edit"class="btn  btn-rounded btn-warning btn-sm" href="' . route('user.edit',$iteam->id) . '"

                              title="Edit">

                              <i class="fa fa-edit color-warning"></i>


                                    </a>


                                   <a href="#" id="delete" route="' . route('user.delete') . '" model_id="' . $iteam->id . '" class="btn  btn-rounded btn-danger btn-sm"
                                      data-toggle="modal" title="delete">
<i class="fa fa-trash color-danger"></i>

                                    </a>



                        ';
            })

            ->editColumn('qr',function ($item){
                      $profileUrl = route('user.view',$item->id);
                       $qrCode = QrCode::size(80)->generate($profileUrl);

                return $qrCode;
            })

            ->rawColumns(['action','status','qr'])
            ->make(true);
    }



    public function create(){
        return view('user.create');
}
    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
            'job'=>['required',],
            'email'=>['required','unique:users']
        ]);

        User::create(['password'=>Hash::make($request->password)]+$request->all());
        return redirect()->route('user.index')
            ->with(['message' => 'User Added Successfully ', 'alert-type' => 'success']);
    }
    public function destroy(Request $request){
        User::findOrFail($request->id)->delete();
        return response()->json(['status'=>true],200);

    }
    public function edit($id){
        $user=User::findOrFail($id);
        return view('user.edit',['user'=>$user]);

    }

    public function update(Request $request){


        $request->validate([
            'name' => ['required','string',],
            'job'=>['required',],
            'email'=>['required','unique:users,email,'.$request->id]
        ]);



        $user=User::findOrFail($request->id);

        if ($request->password==null){
            $user->update([
                'name'=>$request->name,
                'job'=>$request->job,
                'email'=>$request->email,
            ]);
        }else{
            $user->update([
                'name'=>$request->name,
                'job'=>$request->job,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);
        }



        return redirect()->route('user.index')
            ->with(['message' => 'User Updated Successfully ', 'alert-type' => 'success']);

    }

public function status(Request $request){

    $user=User::findOrFail($request->id);
    $user->update(['status'=>$request->status]);
    return response()->json(['status'=>true],200);


}

    public function view($id){
        $user=User::findOrFail($id);
        return view('user.view',['user'=>$user]);

    }


}


