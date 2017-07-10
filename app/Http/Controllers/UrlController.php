<?php

namespace App\Http\Controllers;

use App\UrlGroup;
use App\UserType;
use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "Select 
                         u.id
                       , u.href 
                       , u.order 
                       , u.name as description 
                       , u.created_at
                       , t.name as urlgroup
                  from urls u left join url_groups t 
                  on (u.url_group_id=t.id);";

        $urls = DB::Select($query);
        return view('urls.index',compact('urls','user_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url_groups = UrlGroup::all();
        return view('urls.create',compact('url_groups'));
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
        $url_data = [];
        DB::beginTransaction();
        try{
            $url_data['href'] = $request->href;
            $url_data['name'] = $request->name;
            $url_data['order'] = $request->order;
            $url_data['url_group_id'] = $request->url_group_id;

            Url::create($url_data);
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
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url = Url::find($id);
        $url_groups = UrlGroup::all();
        return view('urls.edit',compact('url','url_groups'));
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
        $url = Url::find($id);

        $this->validate($request,[
            'name'=> 'required',
            'href'=>'bail|required',
            'url_group_id'=>'bail|required',
        ]);

        $dbSuccsess = false;
        $error = 'Unknown error - Store';
        DB::beginTransaction();
        try {
            $url->update($request->input());
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dbSuccsess=false;
        $error = 'Unknown error - destroy';

        DB::beginTransaction();
        try
        {
            Url::find($id)->delete();
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
}
