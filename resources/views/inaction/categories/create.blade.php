@extends('boilerplate::layout.index', [
'title' => 'Управление на категории',
'subtitle' => 'Добави категория',
'breadcrumb' => [
'Управление на категории' => 'boilerplate.categories.index',
'Добави категория'
]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.categories.store', 'autocomplete' => 'off']) }}
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('boilerplate.categories.index') }}" class="btn btn-default" data-toggle="tooltip"
                title="Списък с категории">
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
                @component('boilerplate::input', ['name' => 'name', 'label' => 'Име', 'autofocus' => true])
                @endcomponent
            @endcomponent
        </div>
    </div>
    {{ Form::close() }}
@endsection
