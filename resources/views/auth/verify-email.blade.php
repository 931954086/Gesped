@include('layouts.header-simple', ['title' => 'GesPed | Login', 'bodyClasses' => 'hold-transition login-page'])
<div>


    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-success">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
    @endif

    <div class="mt-4 d-flex justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link text-gray-600">
                {{ __('Log Out') }}
            </button>
        </form>
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