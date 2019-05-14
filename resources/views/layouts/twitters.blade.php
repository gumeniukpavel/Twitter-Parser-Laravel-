<div class="columns">
    @if(session()->has('twitter'))
        <div class="message">
            Done
        </div>
    <div class="column new">
            <p class="name">{{ session()->get('twitter')->name }}</p>
            <p class="name">@ {{ session()->get('twitter')->twitterId }}</p>
            <img src="{{ session()->get('twitter')->photo }}" alt="альтернативный текст">
            <p class="description">{{ session()->get('twitter')->description }}</p>
            <div class="items">
                <p class="item">Tweets:</p>
                <p class="item">Likes:</p>
                <p class="item">{{ number_format(session()->get('twitter')->tweets, 0, '', ' ') }}</p>
                <p class="item">{{ number_format(session()->get('twitter')->likes, 0, '', ' ') }}</p>

                <p class="item">Following:</p>
                <p class="item">Followers:</p>
                <p class="item">{{ number_format(session()->get('twitter')->following, 0, '', ' ') }}</p>
                <p class="item">{{ number_format(session()->get('twitter')->followers, 0, '', ' ') }}</p>
            </div>
        </div>
        <div class="line" style="width: 100%;"></div>
    @endif
    @if(session()->has('message'))
        <div class="message">
            {{ session()->get('message') }}
        </div>
    @endif
    @foreach ($all as $twitter)
        <div class="column">
            <div class="info">
                <p class="name">{{ $twitter->name }}</p>
                <p class="name">@ {{ $twitter->twitterId }}</p>
                <img src="{{ $twitter->photo }}" alt="альтернативный текст">
                <p class="description">{{ $twitter->description }}</p>
                <div class="items">
                    <p class="item">Tweets:</p>
                    <p class="item">Likes:</p>
                    <p class="item">{{ number_format($twitter->tweets, 0, '', ' ') }}</p>
                    <p class="item">{{ number_format($twitter->likes, 0, '', ' ') }}</p>

                    <p class="item">Following:</p>
                    <p class="item">Followers:</p>
                    <p class="item">{{ number_format($twitter->following, 0, '', ' ') }}</p>
                    <p class="item">{{ number_format($twitter->followers, 0, '', ' ') }}</p>
                </div>
            </div>
            <div class="buttons">
                {!! Form::open(array('action' => array('Api\TwitterController@refresh', 'twitterId='.$twitter->twitterId))) !!}
                    {!! Form::submit('Update info',array('class'=>"update")); !!}
                {!! Form::close() !!}
                {!! Form::open(array('action' => array('Api\TwitterController@destroy', 'twitterId='.$twitter->twitterId))) !!}
                    {!! Form::submit('Delete',array('class'=>"delete")); !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
</div>