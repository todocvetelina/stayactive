@extends('boilerplate::layout.index', [
'title' => 'Рецепти',
'subtitle' => 'Списък с рецепти',
'breadcrumb' => ['Управление на рецепти']
])

@section('content')
    @ability('admin', 'recipes_crud')
    <div class="row">
        <div class="col-sm-12 mb-3">
            <span class="float-right">
                <a href="{{ route('boilerplate.recipes.create') }}" class="btn btn-primary">Добави рецепта</a>
            </span>
        </div>
    </div>
    @endability
    <x-boilerplate::datatable name="recipes" />
@endsection
