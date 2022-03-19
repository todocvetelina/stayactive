@extends('boilerplate::layout.index', [
'title' => 'Добавяне на тренировка към календар',
'subtitle' => 'Добави тренировка',
'breadcrumb' => [
'Добавяне на тренировка към календар' => 'boilerplate.workouts.choose',
]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.workouts.postChoose', 'autocomplete' => 'off']) }}
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
        <div class="col-sm-12 mb-3 col-md-8 mx-auto">
            @component('boilerplate::card')
                <x-boilerplate::select2 name="workout" label="Тренировка" id="workout">
                    @foreach ($workouts as $workout)
                        <option value="{{ $workout->id }}">{{ Str::limit($workout->title, 60, '...') }}</option>
                    @endforeach
                </x-boilerplate::select2>
                @component('boilerplate::components.datetimepicker', ['label' => 'Начало', 'name' => 'start_date', 'appendText' => 'far fa-calendar-alt', 'format' => 'L', 'show-today' => 'true', 'show-close' => 'true', 'value' => now()])@endcomponent()        
                @component('boilerplate::components.datetimepicker', ['label' => 'Край', 'name' => 'end_date', 'appendText' => 'far fa-calendar-alt', 'format' => 'L', 'show-today' => 'true', 'show-close' => 'true', 'value' => now()])@endcomponent() 
            @endcomponent
        </div>
    </div>
    {{ Form::close() }}
@endsection
