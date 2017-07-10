<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Lang;
use App;


class LanguageController extends Controller
{
    public function switchLanguage(Request $request)
    {
        if($request->ajax())
        {
            $request->session()->put('locale',$request->lang);
            $request->session()->flash('alert-success',('app.Locale_Change_Success'));
        }
    }
}
