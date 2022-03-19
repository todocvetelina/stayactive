@extends('boilerplate::layout.index', [
'title' => 'Управление на тренировки',
'subtitle' => 'Добави тренировка',
'breadcrumb' => [
'Управление на тренировки' => 'boilerplate.workouts.index',
'Добави тренировка'
]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.workouts.store', 'autocomplete' => 'off']) }}
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
                @component('boilerplate::input', ['name' => 'title', 'label' => 'Заглавие', 'autofocus' => true])
                @endcomponent

                <x-boilerplate::tinymce name="description" label="Описание"></x-boilerplate::tinymce>

                @component('boilerplate::input', ['name' => 'duration', 'type' => 'number', 'label' => 'Продължителност',
                    'append-text' => 'минути', 'min' => 0])
                @endcomponent
                <x-boilerplate::select2 name="category" label="Категория">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-boilerplate::select2>
                @component('boilerplate::input', ['name' => 'video', 'label' => 'Видео (линк към YouTube)', 'type' => 'url'])
                @endcomponent
                @component('boilerplate::input', ['name' => 'calories_min', 'label' => 'Min калории', 'type' => 'number', 'min' => 0])
                @endcomponent
                @component('boilerplate::input', ['name' => 'calories_max', 'label' => 'Max калории', 'type' => 'number', 'min' => 0])
                @endcomponent
            @endcomponent
        </div>
    </div>
    {{ Form::close() }}
@endsection
