<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <nav class="navbar is-spaced" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" id="logo" href="/"></a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-home"></i>
                        </span>
                        <span>Начало</span>
                    </span>
                </a>
                <a class="navbar-item" href="{{ route('about') }}">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-users"></i>
                        </span>
                        <span>За нас</span>
                    </span></a>
                <a class="navbar-item" href="{{ route('faq') }}">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-question"></i>
                        </span>
                        <span>Често задавани въпроси</span>
                    </span></a></a>
                <a class="navbar-item" href="{{ route('questions.index') }}">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-address-card"></i>
                        </span>
                        <span>Задайте въпрос към инстуктор</span>
                    </span></a></a>
                </a>
                <a class="navbar-item" href="/forum">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-comment"></i>
                        </span>
                        <span>Форум</span>
                    </span></a></a>
                </a>
                <a class="navbar-item" href="{{ route('articles.index') }}">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-blog"></i>
                        </span>
                        <span>Блог</span>
                    </span></a></a>
                </a>
            </div>

            <div class="navbar-end">
                @auth
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Str::limit(auth()->user()->name, 60, '...') }}
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('boilerplate.dashboard') }}">
                                Табло
                            </a>
                        </div>
                    </div>
                @else
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-light" href="{{ route('boilerplate.login') }}">
                                Влез
                            </a>
                            @if (config('boilerplate.auth.register'))
                                <a class="button is-primary" href="{{ route('boilerplate.register') }}">
                                    <strong>Регистрирай се</strong>
                                </a>
                            @endif
                        </div>
                    </div>
                @endauth
                </div>
            </div>
        </nav>
        <main>
            <div class="columns is-centered">
                <div class="column is-10-desktop">
                    @if (Session::has('success'))
                        <div class="notification is-success"><i class="fas fa-check"></i> {{ Session::get('success') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="footer mt-2">
            <div class="content has-text-centered">
                <strong>Платформа {{ config('app.name') }}.</strong> {{ date('Y') }}
                <div>
                    <a href="https://github.com/todocvetelina/stayactive">Github repo</a>
                </div>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/js/all.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // Get all "navbar-burger" elements
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                // Check if there are any navbar burgers
                if ($navbarBurgers.length > 0) {

                    // Add a click event on each of them
                    $navbarBurgers.forEach(el => {
                        el.addEventListener('click', () => {

                            // Get the target from the "data-target" attribute
                            const target = el.dataset.target;
                            const $target = document.getElementById(target);

                            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');

                        });
                    });
                }

            });
        </script>
    </body>

    </html>
