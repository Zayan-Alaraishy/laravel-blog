<body style="font-family: Arial, Helvetica, sans-serif; display: flex; flex-direction: column; align-items: center;  justify-content: center; height: 80vh;">

    <header style="text-align: center;">
        <h2>Login</h2>
        <p>Welcome back</p>
    </header>
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
        Session::forget('success');
        @endphp
    </div>
    @endif

    <form method="POST" action="/users/authenticate">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{old('email')}}" style="width: 100%; margin-bottom: 1em;" />

            @error('email')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="password">
                Password
            </label>
            <input type="password" name="password" value="{{old('password')}}" style="width: 100%; margin-bottom: 1em;" />

            @error('password')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <button type="submit">
                Sign In
            </button>
        </div>

        <div>
            <p>
                Don't have an account?
                <a href="/register" class="text-laravel">Register</a>
            </p>
        </div>
    </form>
</body>