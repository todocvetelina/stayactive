@extends('boilerplate::layout.index', [
'title' => 'Статии',
'subtitle' => 'Списък със статии',
'breadcrumb' => ['Управление на статии']
])

@section('content')
    <div class="row">
        <div class="col-sm-12 mb-3">
            <span class="float-right">
                <a href="{{ route('boilerplate.articles.create') }}" class="btn btn-primary">Добави статия</a>
            </span>
        </div>
    </div>
    <x-boilerplate::datatable name="articles" />


@endsection