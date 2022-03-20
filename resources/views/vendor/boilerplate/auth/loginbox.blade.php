<div class="login-box">
    <div class="login-logo">
        <a href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            {{ $slot }}
        </div>
    </div>
</div>
