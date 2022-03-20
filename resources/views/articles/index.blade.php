@extends('layouts.index')

@section('content')
<h2 class="title is-2 has-text-centered">Блог</h2>
<div class="columns is-multiline">
    @foreach ($articles as $article)
        <div class="column is-3-desktop">
            <div class="card">

                <div class="card-image">
                    @if ($article->getFirstMediaUrl('featured'))
                    <figure class="image">
                        <img src="{{ $article->getFirstMediaUrl('featured', 'thumb') }}" alt="">
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
                            <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                        </h4>
                        <h5 class="subtitle">{{ $article->subtitle }}</h5>


                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $articles->links() }}
@endsection
