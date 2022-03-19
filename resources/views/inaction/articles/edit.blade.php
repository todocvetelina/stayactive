@extends('boilerplate::layout.index', [
'title' => 'Управление на статии',
'subtitle' => 'Редактирай статия',
'breadcrumb' => [
'Управление на статии' => 'boilerplate.workouts.index',
'Редактирай статия'
]
])

@section('content')
    {{ Form::open(['route' => ['boilerplate.articles.update', $article->id],'method' => 'put','autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
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
                @component('boilerplate::input', ['name' => 'title', 'label' => 'Заглавие', 'value' => $article->title,'autofocus' => true])
                @endcomponent

                @component('boilerplate::input', ['name' => 'subtitle', 'label' => 'Подзаглавие', 'value' => $article->subtitle])
                @endcomponent

                <div class="file-loading"> 
                    <input id="featured" name="featured" type="file">
                </div>

                <x-boilerplate::tinymce name="content" label="Съдържание">{{ $article->content }}</x-boilerplate::tinymce>

                @component('boilerplate::input', ['name' => 'read_time', 'type' => 'number', 'label' => 'Време за четене',
                    'append-text' => 'минути', 'value' => $article->read_time, 'min' => 0])
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