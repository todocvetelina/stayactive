<aside class="main-sidebar elevation-{{ config('boilerplate.theme.sidebar.shadow') }}">
    <a href="/" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        </a>
    <div class="sidebar">
        @if (config('boilerplate.theme.sidebar.user.visible'))
            <div class="user-panel py-3 d-flex">
                <div class="image">
                    <img src="{{ Auth::user()->avatar_url }}"
                        class="avatar-img img-circle elevation-{{ config('boilerplate.theme.sidebar.user.shadow') }}"
                        alt="{{ Auth::user()->name }}">
                </div>
                <div class="info">
                    <a href="{{ route('boilerplate.user.profile') }}"
                        class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
        @endif
        <nav class="mt-3">
            {!! $menu !!}
        </nav>
    </div>
</aside>
