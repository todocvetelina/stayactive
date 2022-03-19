@extends('boilerplate::layout.index', [
'title' => 'Тренировки',
'subtitle' => 'Списък с тренировки',
'breadcrumb' => ['Управление на тренировки']
])

@section('content')
    @ability('admin', 'workouts_crud')
    <div class="row">
        <div class="col-sm-12 mb-3">
            <span class="float-right">
                <a href="{{ route('boilerplate.workouts.create') }}" class="btn btn-primary">Добави тренировка</a>
            </span>
        </div>
    </div>
    @endability
    <x-boilerplate::datatable name="workouts" />
@endsection
