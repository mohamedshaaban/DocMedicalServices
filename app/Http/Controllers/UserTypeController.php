<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\UserType;
use Illuminate\Support\Facades\DB;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $user_types;

    public function __Construct(){

        $this->user_types = UserType::all();
     }


    public function index()
    {
        $user_types = $this->user_types;
        return view('usertypes.index',compact('user_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dbSuccsess = false;
        $error = 'Unknown error - Store';
        DB::beginTransaction();
        try {
            $userType_data = [];

            $userType_data['name'] = $request->name;

            UserType::create($userType_data);
            $dbSuccsess = true;
        }catch(Exception $ex)
        {
            $error = $ex->getMessage();
        }finally
        {
            if($dbSuccsess)
            {
                DB::commit();
                return redirect()->back()
                    ->with( 'db' , $dbSuccsess);
            }
            else{
                DB::rollback();
                return redirect()->back()
                    ->with( 'db' , $dbSuccsess)
                    ->with( 'error' , $error);
            }
        }
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
        $user_types = UserType::find($id);
        $query = "
                    SELECT G.name as url_group
                          ,U.id   as url_id
                          ,U.name as url_name
                          , Case When T.user_type_id is not null
                            then 'checked'
                            else ''
                            end  Checked  
                    FROM url_groups AS G
                      left JOIN urls AS U
                        on(G.id = U.url_group_id)
                      left JOIN user_type_url AS T
                        on(T.url_id = U.id) and T.user_type_id = ".$id
                    ." Order by G.name , U.id  asc";

        $links = collect(DB::Select("$query"));
        return view('usertypes.edit',compact('user_types','links'));
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


    }

    public function batchUpdate(Request $request)
    {
        $dbSuccsess = false;
        $error = 'Unknown error - batchUpdate';
        DB::beginTransaction();

        try {
            $usertype = UserType::find($request->user_type_id);
            $usertype->urls()->detach();
            foreach($request->url_id as $url)
            {
                $usertype->urls()->attach($url);
            }
            $dbSuccsess = true;
        }catch(Exception $ex)
        {
            $error = $ex->getMessage();
        }finally
        {
            if($dbSuccsess)
            {
                DB::commit();
                return redirect()->back()
                    ->with( 'db' , $dbSuccsess);
            }
            else{
                DB::rollback();
                return redirect()->back()
                    ->with( 'db' , $dbSuccsess)
                    ->with( 'error' , $error);
            }
        }
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
