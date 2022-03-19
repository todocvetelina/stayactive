@extends('layouts.index')

@section('content')
    <div class="columns is-vcentered">
        <div class="column is-4-desktop">
            <h1 class="title has-text-black has-text-centered">
                Stay active: помощник за по-добър, по-щастлив и по-здравословен живот
            </h1>
            <div class="content">
                <p>
                    Ние вярваме в правото за достъпен здравословен начин на живот за всеки и навсякъде, независимо от
                    финансовите възможности и достъпа до фитнес зали.
                </p>
            </div>

            <p class="has-text-centered">
                <a class="button is-medium is-info is-outlined" href="{{ route('about') }}">
                    Научете повече
                </a>
            </p>
        </div>
        <div class="column">
            <iframe height="500" src="https://www.youtube.com/embed/OgePsHSBAps" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
    <div class="columns is-multiline">
        @foreach ($latestArticles as $latestArticle)
            <div class="column is-3-desktop">
                <div class="card">

                    <div class="card-image">
                        @if ($latestArticle->getFirstMediaUrl('featured'))
                        <figure class="image">
                            <img src="{{ $latestArticle->getFirstMediaUrl('featured', 'thumb') }}" alt="">
                        </figure>
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
                    </div>

                    <div class="card-content">
                        <div class="content">

                            <h4 class="title is-4">
                                <a href="{{ route('articles.show', $latestArticle->id) }}">{{ $latestArticle->title }}</a>
                            </h4>
                            <h5 class="subtitle">{{ $latestArticle->subtitle }}</h5>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
