@extends('boilerplate::layout.index', [
'title' => 'Управление на рецепта',
'subtitle' => 'Редактирай рецепта',
'breadcrumb' => [
'Управление на рецепти' => 'boilerplate.recipes.index',
'Редактирай рецепта'
]
])

@section('content')
    {{ Form::open(['route' => ['boilerplate.recipes.update', $recipe->id],'method' => 'put','autocomplete' => 'off']) }}
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
        <div class="col-sm-12 mb-3">
            @component('boilerplate::card')
                @component('boilerplate::input', ['name' => 'title', 'label' => 'Заглавие', 'autofocus' => true, 'value' => $recipe->title])
                @endcomponent
                <x-boilerplate::tinymce name="description" label="Описание">{{ $recipe->description }}</x-boilerplate::tinymce>
                @component('boilerplate::input', ['name' => 'prep_time', 'type' => 'number', 'label' => 'Време за подготовка',
                    'append-text' => 'минути', 'min' => 0, 'value' => $recipe->prep_time])
                @endcomponent
                @component('boilerplate::input', ['name' => 'cook_time', 'type' => 'number', 'label' => 'Време за готвене',
                    'append-text' => 'минути', 'min' => 0, 'value' => $recipe->cook_time])
                @endcomponent
                @component('boilerplate::input', ['name' => 'servings', 'type' => 'number', 'label' => 'Порции', 'value' => $recipe->servings, 'min' => 0])
                @endcomponent
            @endcomponent
        </div>
    </div>
    {{ Form::close() }}

@endsection
