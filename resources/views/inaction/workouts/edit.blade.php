@extends('boilerplate::layout.index', [
    'title' => 'Управление на тренировки',
    'subtitle' => 'Редактирай тренировка',
    'breadcrumb' => [
        'Управление на тренировки' => 'boilerplate.workouts.index',
        'Редактирай тренировка'
    ]
])

@section('content')
{{ Form::open(['route' => ['boilerplate.workouts.update', $workout->id], 'method' => 'put', 'autocomplete' => 'off']) }}
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('boilerplate.workouts.index') }}" class="btn btn-default" data-toggle="tooltip"
                title="Списък с тренировки">
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
                @component('boilerplate::input', ['name' => 'title', 'label' => 'Заглавие', 'value' => $workout->title, 'autofocus' => true])
                @endcomponent

                <x-boilerplate::tinymce name="description" label="Описание">{{ $workout->description }}</x-boilerplate::tinymce>

                @component('boilerplate::input', ['name' => 'duration', 'type' => 'number', 'label' => 'Продължителност',
                    'append-text' => 'минути', 'value' => $workout->duration, 'min' => 0])
                @endcomponent
                <x-boilerplate::select2 name="category" label="Категория">
                    @foreach ($categories as $category)
                        <option {{ $category->id === $workout->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-boilerplate::select2>
                @component('boilerplate::input', ['name' => 'video', 'label' => 'Видео (линк към YouTube)', 'type' => 'url', 'value' => $workout->video])
                @endcomponent
                @component('boilerplate::input', ['name' => 'calories_min', 'label' => 'Min калории', 'type' => 'number', 'value' => $workout->calories_min, 'min' => 0])
                @endcomponent
                @component('boilerplate::input', ['name' => 'calories_max', 'label' => 'Max калории', 'type' => 'number', 'value' => $workout->calories_max, 'min' => 0])
                @endcomponent
            @endcomponent
        </div>
    </div>
    {{ Form::close() }}

@endsection
