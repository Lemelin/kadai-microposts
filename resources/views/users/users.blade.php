@if (count($view_allUsers) > 0)
    <ul class="list-unstyled">
        @foreach ($view_allUsers as $user)
            <li class="media">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                {{--<img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">--}}
                <div class="media-body">
                    <div>
                        {{ $user->name."さん" }}
                    </div>
                    <div>
                        {{-- ユーザ詳細ページへのリンク --}}
                        <p>{!! link_to_route('users.show', 'View profile', ['user' => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    
    {{-- ページネーションのリンク --}}
    {{ $view_allUsers->links() }}
@endif