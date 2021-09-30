@if (count($view_targetUserno_microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($view_targetUserno_microposts as $micropost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                {{--<img class="mr-2 rounded" src="{{ Gravatar::get($micropost->get_micropostno_user->email, ['size' => 50]) }}" alt="">0928--}}
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク 0928--}}
                        {{--{!! link_to_route('users.show', $micropost->get_micropostno_user->name, ['user' => $micropost->get_micropostno_user->id]) !!}0928--}}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
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