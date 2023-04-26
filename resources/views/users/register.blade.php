<body style="font-family: Arial, Helvetica, sans-serif; display: flex; flex-direction: column; align-items: center;  justify-content: center; height: 80vh;">

    <header style="text-align: center;">
        <h2>Register</h2>
        <p>Create an account</p>
    </header>
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
        Session::forget('success');
        @endphp
    </div>
    @endif
    <form method="POST" action="/users">
        @csrf
        <div>
            <label for="name"> Name </label>
            <input type="text" name="name" value="{{old('name')}}" style="width: 100%; margin-bottom: 1em;" />

            @if ($errors->has('name'))
            <span>{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{old('email')}}" style="width: 100%; margin-bottom: 1em;" />

            @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div>
            <label for="password">
                Password
            </label>
            <input type="password" name="password" value="{{old('password')}}" style="width: 100%; margin-bottom: 1em;" />

            @if ($errors->has('password'))
            <span>{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div>
            <label for="password2">
                Confirm Password
            </label>
            <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" style="width: 100%; margin-bottom: 1em;" />

            @error('password_confirmation')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <button type="submit">
                Sign Up
            </button>
        </div>

        <div>
            <p>
                Already have an account?
                <a href="/login">Login</a>
            </p>
        </div>
    </form>
</body>