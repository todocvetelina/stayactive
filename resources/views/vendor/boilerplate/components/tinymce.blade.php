@if(empty($name))
<code>&lt;x-boilerplate::tinymce>The name attribute has not been set</code>
@else
<div class="form-group{{ isset($groupClass) ? ' '.$groupClass : '' }}"{!! isset($groupId) ? ' id="'.$groupId.'"' : '' !!}>
@isset($label)
    <label for="{{ $id }}">{!! __($label) !!}</label>
@endisset
    <textarea id="{{ $id }}" name="{{ $name }}"{!! !empty($attributes) ? ' '.$attributes : '' !!} style="visibility:hidden">{!! old($name, $value ?? $slot ?? '') !!}</textarea>
@if($help ?? false)
    <small class="form-text text-muted">@lang($help)</small>
@endif
@error($name)
    <div class="error-bubble"><div>{{ $message }}</div></div>
@enderror
</div>
@include('boilerplate::load.async.tinymce')
@component('boilerplate::minify')
<script>
    whenAssetIsLoaded('{!! mix('/plugins/tinymce/tinymce.min.js', '/assets/vendor/boilerplate') !!}', () => {
        tinymce.init({
            selector: '#{{ $id }}',
            toolbar_sticky: {{ ($sticky ?? false) ? 'true' : 'false' }},
            @if(setting('darkmode', false) && config('boilerplate.theme.darkmode'))
            skin : "boilerplate-dark",
            content_css: 'boilerplate-dark',
            @else
            skin : "oxide",
            content_css: null,
            @endif
                    @if(App::getLocale() !== 'en')
            language: '{{ App::getLocale() }}'
            @endif
        });
    });
</script>
@endcomponent
@endif