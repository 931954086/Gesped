@include('layouts.header-simple', ['title' => 'GesPed | Redefinir senha', 'bodyClasses' => 'hold-transition login-page'])

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Ges</b>Ped</a>
        </div>
        <div class="card-body">Você está a apenas um passo de sua nova senha, recupere sua senha agora.</p>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="input-group mb-3">
                    <label for="email" class="sr-only">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email"
                        value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"/>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required
                        autocomplete="new-password" placeholder="Nova senha" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="input-group mb-3">
                    <label for="password_confirmation" class="sr-only">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="form-control" type="password"
                        name="password_confirmation" required autocomplete="new-password" placeholder="Confirme a senha" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Redefinir Senha</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="login.html">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>