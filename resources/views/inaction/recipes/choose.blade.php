@extends('boilerplate::layout.index', [
'title' => 'Добавяне на рецепта към календар',
'subtitle' => 'Добави рецепта',
'breadcrumb' => [
'Добавяне на рецепта към календар' => 'boilerplate.recipes.choose',
]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.recipes.postChoose', 'autocomplete' => 'off']) }}
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('boilerplate.recipes.index') }}" class="btn btn-default" data-toggle="tooltip"
                title="Списък с рецепти">
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
                <x-boilerplate::select2 name="recipe" label="Рецепта" id="recipe">
                    @foreach ($recipes as $recipe)
                        <option value="{{ $recipe->id }}">{{ Str::limit($recipe->title, 60, '...') }}</option>
                    @endforeach
                </x-boilerplate::select2>
                @component('boilerplate::components.datetimepicker', ['label' => 'Дата', 'name' => 'date', 'appendText' => 'far fa-calendar-alt', 'format' => 'L', 'show-today' => 'true', 'show-close' => 'true', 'value' => now()])@endcomponent()            @endcomponent
        </div>
    </div>
    {{ Form::close() }}
@endsection
