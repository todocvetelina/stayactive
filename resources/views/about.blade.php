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
        </div>
        <div class="column">
            <iframe height="500" src="https://www.youtube.com/embed/OgePsHSBAps" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
    <section class="hero is-medium is-info">
        <div class="hero-body">
            <div class="columns is-vcentered">
                <div class="column is-7">
                    <p class="title">
                        Нямате представа откъде да започнете?
                    </p>
                    <p class="subtitle">
                        Възползвайте се от нашите разнообразни видео тренировки, здравословни рецепти, полезни статии и още
                        много.
                    </p>
                </div>
                <div class="column">
                    <img src="{{ asset('assets/images/feature1.png') }}" alt="" width="400">
                </div>
            </div>
        </div>
    </section>
    <div class="tile is-ancestor mt-2">
        <div class="tile is-vertical">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification is-primary">
                        <p class="title">Видео тренировки</p>
                        <p class="subtitle">Спортувай с нас без значение дали си вкъщи, на хотел или пътуваш.</p>
                        <img src="{{ asset('assets/images/feature2.png') }}" alt="">
                    </article>
                    <article class="tile is-child notification is-info">
                        <p class="title">Задайте въпрос към инструктор</p>
                        <p class="subtitle">Отговаряме на Вашите въпроси по всяко време, за да ви бъдем максимално
                            полезни.</p>
                        <img src="{{ asset('assets/images/feature5.png') }}" alt="">
                    </article>
                </div>
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification is-info">
                        <p class="title">Здравословни рецепти</p>
                        <p class="subtitle">Експериментирайте всеки ден с различна здравословна рецепта, с която да
                            нахраните тялото си.</p>
                        <img src="{{ asset('assets/images/feature3.png') }}" alt="">
                    </article>
                    <article class="tile is-child notification is-info">
                        <p class="title">Форум</p>
                        <p class="subtitle">Обменете идеи и опит с други членове на нашата общност!</p>
                        <img src="{{ asset('assets/images/feature7.png') }}" alt="">
                    </article>
                </div>
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification is-link">
                        <div class="content">
                            <p class="title">Интерактивен календар</p>
                            <p class="subtitle">Следете напредъка си в тренировките чрез интерактивния календар.</p>
                            <img src="{{ asset('assets/images/feature4.png') }}" alt="">
                            <div class="content">
                            </div>
                        </div>
                    </article>
                    <article class="tile is-child notification is-success">
                        <p class="title">Полезни статии</p>
                        <p class="subtitle">Прочетете нашите интересни и разнообразни статии за здравето на мозъка и
                            тялото.</p>
                        <img src="{{ asset('assets/images/feature6.png') }}" alt="">
                        <div class="content">
                            <!-- Content -->
                        </div>
                    </article>
                </div>
            </div>
        </div>

    </div>
@endsection
