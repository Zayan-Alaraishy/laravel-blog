<body style="font-family: Arial, Helvetica, sans-serif; padding:0.5em">
    <div style="display: inline-block; width: 100%">
        <a style=" text-decoration: none; justify-content: flex-start; color: brown;"> <b>Hello {{ auth()->user()->name }}</b> </a>
        <a href="{{ url('/logout') }}" style="float:right; margin-left: 1em;">Logout</a>
        <a href="{{ url('/posts') }}" style="float:right; ">Home</a>
        <hr>
    </div>
    <div style="display:flex; flex-direction: column;gap:1em">
        <b>Create a new post</b>

        <form action=" /posts" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction: column; width:50%; gap:1em">
            @csrf

            <input type="text" name="title" placeholder="Title...">
            <textarea name="text" placeholder="Text..."></textarea>


            <button type="submit">
                Submit Post
            </button>
        </form>
    </div>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</body>