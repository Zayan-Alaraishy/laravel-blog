<body style="font-family: Arial, Helvetica, sans-serif; padding:0.5em">
    <div style="display: inline-block; width: 100%">
        <a style=" text-decoration: none; justify-content: flex-start; color: brown;"> <b>Hello {{ auth()->user()->name }}</b> </a>
        <a href="{{ url('/logout') }}" style="float:right; margin-left: 1em;">Logout</a>
        <a href="{{ url('/posts/create') }}" style="float:right; ">Create post</a>
        <hr>
    </div>
    @if (session()->has('message'))
    <div>
        <p>
            {{ session()->get('message') }}
        </p>
    </div>
    @endif
    @foreach ($posts as $post)
    <div style="background-color: whitesmoke; padding: 1em; margin: 0.5em 0">
        <div>
            <b>
                {{ $post->title }}
            </b>
            <small>
                By <span>{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
            </small>
            @if (auth()->check() && $post->user_id == auth()->user()->id)
            <div style="float: right; display:flex; gap: 1em">
                <span>
                    <a href="/posts/{{ $post->id }}/edit">
                        Edit post
                    </a>
                </span>

                <span>
                    <form action="/posts/{{ $post->id }}" method="POST">
                        @csrf
                        @method('delete')

                        <button type="submit">
                            Delete post
                        </button>

                    </form>
                </span>
            </div>
            @endif
        </div>


        <p>
            {{ $post->text }}
        </p>



        <hr>
        <b>Comments</b>
        <form action="{{ route('comments.store', [$post->id, get_class($post)]) }}" method="POST">
            @csrf
            <div style="display:flex; gap: 1em; margin-top: 1em">
                <textarea class="form-control" name="body" id="body" rows="2" placeholder="Add a comment..." style="width:95%"></textarea>
                <button type="submit">Submit</button>
            </div>
        </form>
        <div style="padding: 0em 1em">
            @foreach ($post->comments as $comment)
            <div>
                <h5 class="card-title" style="margin-bottom: 0;">{{ $comment->user->name }}</h5>
                <p class="list-group-item">{{ $comment->body }}</p>

            </div>
            <!-- @if (auth()->check() && $comment->user_id == auth()->user()->id)
            <span>
                <a href="/comments/{{ $post->id }}/edit">
                    Edit comment
                </a>
            </span>

            <span>
                <form action="/comments/{{ $post->id }}" method="POST">
                    @csrf
                    @method('delete')

                    <button type="submit">
                        Delete comment
                    </button>

                </form>
            </span>
            @endif -->
            <hr>
            @endforeach
        </div>

    </div>
    @endforeach
</body>