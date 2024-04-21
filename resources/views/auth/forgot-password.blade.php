@include('layouts.header', ['title' => 'Forgot Password'])

<body>
    <div class="login-box mx-auto my-5">
        <div class="login-logo">
            <b>Buku Kas</b> Mahasiswa
        </div>

        <div class="card mt-3">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You forgot your password? Verify if your Email exist</p>
                <form action="{{ route('forgot-password.check') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>
                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Check Email</button>
                        </div>

                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </div>

        </div>
    </div>
</body>

</html>
