<?php

namespace App\Http\Controllers;

use App\UrlGroup;
use Illuminate\Http\Request;
use Mockery\Exception;

class UrlGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url_groups = UrlGroup::all();
        return view ('urlgroups.index',compact('url_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('urlgroups.create');

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
        try {
            $url_data = [];

            $url_data['href'] = $request->href;
            $url_data['name'] = $request->name;
            $url_data['order'] = $request->order;

            UrlGroup::Create($url_data);
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
        //
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
        //
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
