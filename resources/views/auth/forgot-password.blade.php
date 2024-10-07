@include('layouts.header-simple', ['title' => 'GesPed | Forgot Password', 'bodyClasses' => 'hold-transition
login-page'])
<div class="login-box">
    <div class="col-md-13">
        <!-- Exibição da mensagem de erro fora do formulário -->
        @if(session('status'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('dashboard') }}" class="h1"><b>Ges</b>Ped</a>
        </div>
        <!-- EXIBICAO DE FEEDBACK -->
        <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
        <!-- END EXIBICAO DE FEEDBACK -->
        <div class="card-body">
            <p class="login-box-msg">Recupere facilmente sua senha esquecida.</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit"
                            class="btn btn-primary btn-block">{{ __('Solicitar nova senha') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">Entrar</a>
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