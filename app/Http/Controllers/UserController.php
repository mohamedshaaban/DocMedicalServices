<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function create(){

        $userTypes = UserType::all();
        return view('user.create' , compact('userTypes'));
    }

    public function index()
    {
        $users = DB::Select("Select u.id , u.name , u.email , u.created_at  , t.name as group_name ,u.username
                             from users u left join user_types t on (u.user_type_id=t.id)");
        return view('user.index',compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'bail|required|unique:users',
            'username'=>'bail|required|min:4|unique:users',
            'password'=>'bail|required|min:6',
            'password_confirmation'=>'bail|required|min:6|same:password',
            'user_type_id'=>'bail|required'
        ]);
        $dbSuccsess = false;
        $error = 'Unknown error - Store';
        DB::beginTransaction();
        try {
            $user_data = [];

            $user_data['name'] = $request->name;
            $user_data['email'] = $request->email;
            $user_data['password'] = bcrypt($request->password);
            $user_data['user_type_id'] = $request->user_type_id;
            $user_data['username'] = $request->username;

            User::create($user_data);
            $dbSuccsess = true;
        }catch(Exception $ex)
        {
            $error = $ex->getMessage();
        }finally
        {
            if($dbSuccsess)
            {
                DB::commit();
                return redirect()
                    ->route('user.index')
                    ->with( 'db' , $dbSuccsess);
            }
            else{
                DB::rollback();
                return redirect()
                    ->route('user.index')
                    ->with( 'db' , $dbSuccsess)
                    ->with( 'error' , $error);
            }
        }
    }

    public function edit ($id)
    {
        $user = User::find($id);
        $userTypes = UserType::all();
        return view('user.edit',compact('user','userTypes'));
    }

    public function update (Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request,[
            'name'=> 'required',
            'email'=>'bail|required|unique:users,email,'.$user->id,
            'username'=>'bail|required|unique:users,username,'.$user->id,
//            'password'=>'bail|required|min:6',
//            'password_confirmation'=>'bail|required|min:6|same:password',
            'user_type_id'=>'bail|required'
        ]);

        $dbSuccsess = false;
        $error = 'Unknown error - Store';
        DB::beginTransaction();
        try {
            $user->update($request->input());
            $dbSuccsess = true;
        }catch(Exception $ex)
        {
            $error = $ex->getMessage();
        }finally
        {
            if($dbSuccsess)
            {
                DB::commit();
                return redirect()
                    ->back()
                    ->with( 'db' , $dbSuccsess);
            }
            else{
                DB::rollback();
                return redirect()
                    ->back()
                    ->with( 'db' , $dbSuccsess)
                    ->with( 'error' , $error);
            }
        }
    }

    public function destroy ($id)
    {
        $dbSuccsess=false;
        $error = 'Unknown error - Store';

        $user = User::find($id);

        DB::beginTransaction();
        try {
        $user->find($id)->delete();
        $dbSuccsess=true;
        }catch(Exception $ex)
        {
            $error = $ex->getMessage();
        }finally
        {
            if($dbSuccsess)
            {
                DB::commit();
                return redirect()
                    ->back()
                    ->with( 'db' , $dbSuccsess);
            }
            else{
                DB::rollback();
                return redirect()
                    ->back()
                    ->with( 'db' , $dbSuccsess)
                    ->with( 'error' , $error);
            }
        }
    }


    public function show($id)
    {
        return redirect()->back();
    }






}
