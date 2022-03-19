@extends('boilerplate::layout.index', [
'title' => 'Управление на статии',
'subtitle' => 'Добави статия',
'breadcrumb' => [
'Управление на статии' => 'boilerplate.articles.index',
'Добави статия'
]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.articles.store', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('boilerplate.articles.index') }}" class="btn btn-default" data-toggle="tooltip"
                title="Списък със статии">
                <span class="far fa-arrow-alt-circle-left text-muted"></span>
            </a>
            <span class="btn-group float-right">
                <button type="submit" class="btn btn-primary">
                    Запази
                </button>
            </span>
        </div>
    </div>
        

    <div class="row">
        <div class="col-sm-12 mb-3">
            @component('boilerplate::card')
                @component('boilerplate::input', ['name' => 'title', 'label' => 'Заглавие', 'autofocus' => true])
                @endcomponent

                @component('boilerplate::input', ['name' => 'subtitle', 'label' => 'Подзаглавие'])
                @endcomponent
                <div class="file-loading"> 
                    <input id="featured" name="featured" type="file">
                </div>
                <x-boilerplate::tinymce name="content" label="Съдържание"></x-boilerplate::tinymce>

                @component('boilerplate::input', ['name' => 'read_time', 'type' => 'number', 'label' => 'Време за четене',
                    'append-text' => 'минути', 'min' => 0])
                @endcomponent

            @endcomponent
        </div>
    </div>
    {{ Form::close() }}
@endsection
@include('boilerplate::load.fileinput')

@push('js') 
<script>
    $(document).ready(function() {
        $("#featured").fileinput({
            showUpload: false,
            dropZoneEnabled: false,
            maxFileCount: 1,
        });
    });
</script>
@endpush