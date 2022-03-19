
@extends('boilerplate::layout.index', [
'title' => 'Категории',
'subtitle' => 'Списък с категории',
'breadcrumb' => ['Управление на категории']
])

@section('content')
    <div class="row">
        <div class="col-sm-12 mb-3">
            <span class="float-right">
                <a href="{{ route('boilerplate.categories.create') }}" class="btn btn-primary">Добави категория</a>
            </span>
        </div>
    </div>
    <x-boilerplate::datatable name="categories" />


@endsection
