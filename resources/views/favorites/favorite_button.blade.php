{{--@if (Auth::id() != $view_targetUser->id)--}}
    @if (Auth::user()->check_is_favorite_microposts($micropost->id))
        {!! Form::open(['route' => ['favorites.del', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Delete Favorite', ['class' => "btn btn-danger btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['favorites.add', $micropost->id]]) !!}
            {!! Form::submit('Add Favorite', ['class' => "btn btn-primary btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
{{--@endif--}}