@include('layouts.header-simple', ['title' => 'GesPed | Login', 'bodyClasses' => 'hold-transition login-page'])

<div class="login-box">

    <div class="col-md-13">
        <!-- Exibição da mensagem de erro fora do formulário -->
        @if(session('error'))
        <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>



    <!--x-auth-session-status class="mb-4" :status="session('status')" />-->
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('dashboard') }}" class="h1"><b>Ges</b>Ped</a>
        </div>
        <x-input-error :messages="$errors->get('email')" class="text-danger mt-2 mx-auto w-80" />

        <div class="card-body">
            <p class="login-box-msg">Entrar na conta</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" maxlength="60" class="form-control" placeholder="Email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>

                <div class="input-group mb-3">
                    <input type="password" maxlength="12" class="form-control" placeholder="Senha" name="password"
                        required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <!-- <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                               Remember Me
                            </label>-->
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
            </p>

        </div>
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