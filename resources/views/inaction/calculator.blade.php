@extends('boilerplate::layout.index', [
'title' => 'Калкулатор (индекс на телесната маса)',
'subtitle' => 'Калкулатор (индекс на телесната маса)',
'breadcrumb' => [
'Калкулатор (индекс на телесната маса)'
]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.postCalculator', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
    <div class="row">
        <div class="col-12 mb-3">
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
                @component('boilerplate::input', ['name' => 'weight', 'type' => 'number', 'label' => 'Tегло',  'append-text' => 'килограма', 'autofocus' => true, 'min' => 0])
                @endcomponent

                @component('boilerplate::input', ['name' => 'height', 'type' => 'number', 'label' => 'Височина',
                    'append-text' => 'сантиметра', 'min' => 0])
                @endcomponent

            @endcomponent
        </div>
    </div>
    {{ Form::close() }}
@endsection
