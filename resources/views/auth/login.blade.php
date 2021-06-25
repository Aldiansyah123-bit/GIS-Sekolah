<x-guest-layout>
    @section('title')
        {{ config('quest.name', 'Login') }}
    @endsection
    @section('title2')
        <a href=""><b>Login</b> Admin</a>
    @endsection
    @section('content')
    <x-jet-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif
<div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p> 
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3 input-group">
            <input id="email" type="email" name="email" :value="old('email')" class="form-control" placeholder="Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="mb-3 input-group">
            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember">
                    Remember Me
                </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
            </div>
        </div>
        

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('register'))
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('New Account') }}
                </a>
            @endif           
        </div>
    </form>
</div>
    @endsection
</x-guest-layout>
