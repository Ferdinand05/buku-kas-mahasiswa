@include('layouts.header', ['title' => 'Password Recovery'])

<body>

    <div class="login-box mx-auto my-5">
        <div class="login-logo">
            <b>Buku Kas </b> Mahasiswa
        </div>

        <div class="card mt-3">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.
                </p>
                <form action="{{ route('password-recovery', $token) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="input-group ">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>
                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="password_confirmation">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>

                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="login.html">Login</a>
                </p>
            </div>

        </div>
    </div>

    @include('layouts.footer')
