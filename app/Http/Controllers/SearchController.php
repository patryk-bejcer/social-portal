<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class SearchController extends Controller
{
    public function users(Request $request)
    {

        $search_phrase = Input::get('q');
        $search_results = User::where('name','LIKE', '%' . $search_phrase . '%')->paginate(24);

        return view('search.users', compact('search_results'));
    }

}
