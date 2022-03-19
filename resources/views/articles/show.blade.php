@extends('layouts.index')

@section('content')
    <h1 class="title is-1">{{ $article->title }}</h1>
    <h3 class="subtitle">{{ $article->subtitle }}</h3>
    <div class="columns is-mobile is-multiline has-margin-top-20 has-margin-bottom-20">
        <div class="column is-narrow">
            <span class="icon">
                <i class="far fa-clock"></i>
            </span>
            <span>{{ $article->created_at->translatedFormat('j F Y г. G:i') }}</span>
        </div>
        <div class="column is-narrow">
            <span class="icon">
                <i class="fas fa-book"></i>
            </span>
            <span>{{ $article->read_time }} минути</span>
        </div>
    </div>
    @if ($article->getFirstMediaUrl('featured'))
        <div class="columns is-centered">
            <div class="column is-narrow">
                <figure>
                    <img src="{{ $article->getFirstMediaUrl('featured', 'resized') }}" alt="">
                </figure>
            </div>
        </div>
    @else
        <div class="hero is-light p-4 is-unselectable">
            <div class="hero-body has-text-grey">
                <div class="container has-text-centered">
                    <span class="icon is-large has-text-black">
                        <i class="fas fa-image fa-lg"></i>
                    </span>
                    <p>
                        Няма изображение!
                    </p>
                </div>
            </div>
        </div>
    @endif
    <div class="content has-margin-top-20">{!! $article->content !!}</div>
@endsection
