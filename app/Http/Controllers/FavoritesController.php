<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($micpostid)
    {
        \Auth::user()->addFavorite($micpostid);

        return back();
    }
    
    public function destroy($micpostid)
    {

        \Auth::user()->delFavorite($micpostid);

        return back();
    }
}
