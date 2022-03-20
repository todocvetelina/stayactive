@extends('layouts.index')

@section('content')
<h2 class="title is-2 has-text-centered">Задайте въпрос към инструктор</h2>
<form method="POST" action="{{ route('questions.store') }}" autocomplete="off">
    @csrf
    <div class="field">
        <label for="email" class="label">Имейл</label>
        <div class="control">
            <input class="input @error('email') is-danger @enderror" type="email" name="email" id="email">
            @error('email')
            <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="question" class="label">Въпрос</label>
        <div class="control">
            <textarea class="textarea" name="question" id="content" cols="30" rows="10"></textarea>
            @error('question')
            <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <button class="button is-info" type="submit">Изпрати</button>
    </div>
</form>
@endsection