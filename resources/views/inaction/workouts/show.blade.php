@extends('boilerplate::layout.index', [
'title' => 'Тренировкa',
'subtitle' => 'Тренировка',
'breadcrumb' => [
'Тренировка']
])

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('boilerplate.workouts.index') }}" class="btn btn-default" data-toggle="tooltip"
                title="Списък с тренировки">
                <span class="far fa-arrow-alt-circle-left text-muted"></span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <x-boilerplate::card>
                <div class="columns">
                    <div class="column is-7">
                        <iframe src="https://www.youtube.com/embed/{{ explode('?v=', $workout->video)[1] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                </iframe>
                <h2>{{ $workout->title }} <span class="badge bg-secondary">{{ $workout->duration }} минути</span></h2>
                <p>Категория: <strong>{{ $workout->category->name }}</strong></p>
                <p>{!! $workout->description !!}</p>
            </x-boilerplate::card>
        </div>
    </div>
@endsection
