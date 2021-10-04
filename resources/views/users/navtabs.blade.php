<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ詳細タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.show', ['user' => $view_targetUser->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
            TimeLine
            <span class="badge badge-secondary">{{ $view_targetUser->get_userno_microposts_count }}</span>
        </a>
    </li>
    {{-- フォロー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followings', ['id' => $view_targetUser->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            Followings
            <span class="badge badge-secondary">{{ $view_targetUser->get_following_users_count }}</span>
        </a>
    </li>
    {{-- フォロワー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followers', ['id' => $view_targetUser->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
            Followers
            <span class="badge badge-secondary">{{ $view_targetUser->get_followers_count }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('users.favorites', ['id' => $view_targetUser->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'active' : '' }}">
            Favorites
            <span class="badge badge-secondary">{{ $view_targetUser->get_favorite_microposts_count }}</span>
        </a>
    </li>
</ul>