<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if (isset($thread))
            {{ $thread->title }} -
        @endif
        @if (isset($category))
            {{ $category->title }} -
        @endif
        {{ trans('forum::general.home_title') }}
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    @if (config('app.debug'))
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @else
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    @endif

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.10.1/Sortable.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.23.2/vuedraggable.umd.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/forum/custom.css') }}">
</head>

<body>
    <nav class="v-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('assets/images/logo.png') }}" width="50"
                    alt=""><strong>форум</strong></a>
            <button class="navbar-toggler" type="button" :class="{ collapsed: isCollapsed }"
                @click="isCollapsed = ! isCollapsed">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" :class="{ show: !isCollapsed }">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ url(config('forum.web.router.prefix')) }}">{{ trans('forum::general.index') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                    </li>
                    @auth
                        @role('admin')
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                            </li>

                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                                </li>
                        @endrole
                    @endauth
                </ul>
                <ul class="navbar-nav">
                </ul>
            </div>
        </div>
    </nav>

    <div id="main" class="container">
        @include('forum::partials.breadcrumbs')
        @include('forum::partials.alerts')

        @yield('content')
    </div>

    <div class="mask"></div>

    <script>
        new Vue({
            el: '.v-navbar',
            name: 'Navbar',
            data: {
                isCollapsed: true,
                isUserDropdownCollapsed: true
            },
            methods: {
                onWindowClick(event) {
                    const ignore = ['navbar-toggler', 'navbar-toggler-icon', 'dropdown-toggle'];
                    if (ignore.some(className => event.target.classList.contains(className))) return;
                    if (!this.isCollapsed) this.isCollapsed = true;
                    if (!this.isUserDropdownCollapsed) this.isUserDropdownCollapsed = true;
                }
            },
            created: function() {
                window.addEventListener('click', this.onWindowClick);
            }
        });

        const mask = document.querySelector('.mask');

        function findModal(key) {
            const modal = document.querySelector(`[data-modal=${key}]`);

            if (!modal) throw `Attempted to open modal '${key}' but no such modal found.`;

            return modal;
        }

        function openModal(modal) {
            modal.style.display = 'block';
            mask.style.display = 'block';
            setTimeout(function() {
                modal.classList.add('show');
                mask.classList.add('show');
            }, 200);
        }

        document.querySelectorAll('[data-open-modal]').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                openModal(findModal(event.currentTarget.dataset.openModal));
            });
        });

        document.querySelectorAll('[data-modal]').forEach(modal => {
            modal.addEventListener('click', event => {
                if (!event.target.hasAttribute('data-close-modal')) return;

                modal.classList.remove('show');
                mask.classList.remove('show');
                setTimeout(function() {
                    modal.style.display = 'none';
                    mask.style.display = 'none';
                }, 200);
            });
        });

        document.querySelectorAll('[data-dismiss]').forEach(item => {
            item.addEventListener('click', event => event.currentTarget.parentElement.style.display = 'none');
        });

        document.addEventListener('DOMContentLoaded', event => {
            const hash = window.location.hash.substr(1);
            if (hash.startsWith('modal=')) {
                openModal(findModal(hash.replace('modal=', '')));
            }

            feather.replace();

            const input = document.querySelector('input[name=color]');

            if (!input) return;

            const pickr = Pickr.create({
                el: '.pickr',
                theme: 'classic',
                default: input.value || null,

                swatches: [
                    '{{ config('forum.web.default_category_color') }}',
                    '#f44336',
                    '#e91e63',
                    '#9c27b0',
                    '#673ab7',
                    '#3f51b5',
                    '#2196f3',
                    '#03a9f4',
                    '#00bcd4',
                    '#009688',
                    '#4caf50',
                    '#8bc34a',
                    '#cddc39',
                    '#ffeb3b',
                    '#ffc107'
                ],

                components: {
                    preview: true,
                    hue: true,
                    interaction: {
                        input: true,
                        save: true
                    }
                },

                strings: {
                    save: 'Apply'
                }
            });

            pickr
                .on('save', instance => pickr.hide())
                .on('clear', instance => {
                    input.value = '';
                    input.dispatchEvent(new Event('change'));
                })
                .on('cancel', instance => {
                    const selectedColor = instance
                        .getSelectedColor()
                        .toHEXA()
                        .toString();

                    input.value = selectedColor;
                    input.dispatchEvent(new Event('change'));
                })
                .on('change', (color, instance) => {
                    const selectedColor = color
                        .toHEXA()
                        .toString();

                    input.value = selectedColor;
                    input.dispatchEvent(new Event('change'));
                });
        });
    </script>
    @yield('footer')
</body>

</html>
