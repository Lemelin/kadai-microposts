<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function index(){
        $usersList = User::orderBy('id','desc')->paginate(10);
        
        return view('users.index',['allUsers' => $usersList,]);
    } 
    
    public function show($id){
        $targetUser = User::findOrFail($id);
        
        return view('users.show', ['viewUser' => $targetUser,]);
    }
}
