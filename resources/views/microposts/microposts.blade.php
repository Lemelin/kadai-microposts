@if (count($view_targetUserno_microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($view_targetUserno_microposts as $micropost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                {{--<img class="mr-2 rounded" src="{{ Gravatar::get($view_targetUser->email, ['size' => 50]) }}" alt="">--}}
                <img class="mr-2 rounded" src="img/kao.png" alt="microposts kao" width="50" height="50">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク 0928--}}
                        {!! link_to_route('users.show', $view_targetUser->name, ['user' => $micropost->user_id]) !!}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!!nl2br(e($micropost->content)) !!}</p>
                        @include('favorites.favorite_button')
                        
                    </div>
                    <div>
                        @if (Auth::id() == $micropost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}

                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $view_targetUserno_microposts->links() }}
@endif