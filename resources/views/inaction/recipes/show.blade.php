@extends('boilerplate::layout.index', [
'title' => ' Рецепта',
'subtitle' => 'Рецепта',
'breadcrumb' => [
'Рецепта']
])

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('boilerplate.recipes.index') }}" class="btn btn-default" data-toggle="tooltip"
                title="Списък с рецепти">
                <span class="far fa-arrow-alt-circle-left text-muted"></span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <x-boilerplate::card>
                <h2>{{ $recipe->title }}</h2>
                <div class="row">
                    <div class="col-md">
                        Време за подготовка: <strong> {{ $recipe->prep_time }} минути</strong>
                    </div>
                    <div class="col-md">
                        Време за приготвяне: <strong> {{ $recipe->cook_time }} минути</strong>
                    </div>
                </div>
                <div>
                    Порции: <strong>{{ $recipe->servings }}</strong>
                </div>
                <div class="mt-4">
                    {!! $recipe->description !!}
                </div>
            </x-boilerplate::card>
        </div>
    </div>
@endsection
