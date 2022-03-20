@extends('boilerplate::layout.index', [
'title' => 'Табло',
'subtitle' => 'Табло',
'breadcrumb' => ['Табло']]
)

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@include('boilerplate::load.fullcalendar')
@push('js')
    <script>
        var calendar = $('#calendar').fullCalendar({
            headerToolbar: {
                center: 'addRecipeButton addWorkoutButton',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            buttonIcons: false,
            navLinks: true,
            editable: true,
            dayMaxEvents: true,
            customButtons: {
                addRecipeButton: {
                    text: 'Добави рецепта',
                    click: function() {
                        window.location.href = "{{ route('boilerplate.recipes.choose') }}";
                    }
                },
                addWorkoutButton: {
                    text: 'Добави тренировка',
                    click: function() {
                        window.location.href = "{{ route('boilerplate.workouts.choose') }}";
                    }
                }
            }
        });

        @foreach($recipes as $recipe)
        calendar.addEvent({
            title: '{{ $recipe->title }}',
            start: '{{ $recipe->pivot->date }}',
            url: '{{ route('boilerplate.recipes.show', $recipe->id) }}',
        });

        @endforeach
        @foreach($workouts as $workout)
        calendar.addEvent({
            title: '{{ $workout->title }}',
            start: '{{ $workout->pivot->start_date }}',
            end: '{{ $workout->pivot->end_date }}',
            url: '{{ route('boilerplate.workouts.show', $workout->id) }}',
            color: 'green'
        });

        @endforeach

    </script>
@endpush
