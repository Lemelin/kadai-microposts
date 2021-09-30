<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $allUsers = User::orderBy('id', 'desc')->paginate(5);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'view_allUsers' => $allUsers,
        ]);
    }
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $targetUser = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $targetUser->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得 0927
        $targetUserno_microposts = $targetUser->get_userno_microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'view_targetUser' => $targetUser,
            'view_targetUserno_microposts' => $targetUserno_microposts,
        ]);
    }
    
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->get_following_users()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'view_targetUser' => $user,
            'view_allUsers' => $followings,
        ]);
    }

    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->get_followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'view_targetUser' => $user,
            'view_allUsers' => $followers,
        ]);
    }
    
    // public function favorites($id)
    // {
    //     $user = User::findOrFail($id);

    //     $user->loadRelationshipCounts();

    //     $userFavorites = $user->favorites()->orderBy('created_at', 'desc')->paginate(10);

    //     return view('favorites.favorites', [
    //         'user' => $user,
    //         'favorites' => $userFavorites,
    //     ]);
    // }
}