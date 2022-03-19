<footer class="main-footer text-sm">
    <strong>
        &copy; {{ date('Y') }}
        @if(config('boilerplate.theme.footer.vendorlink'))
            <a href="{{ config('boilerplate.theme.footer.vendorlink') }}">
                {!! config('boilerplate.theme.footer.vendorname') !!}
            </a>.
        @else
            {!! config('boilerplate.theme.footer.vendorname') !!}.
        @endif
    </strong>
</footer>