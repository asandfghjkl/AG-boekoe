@extends('layouts.master')

@section('content')
    <!-- Slider Area -->
    <section class="welcome-area">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slider-img slider-bg-1"></div>
                    <div class="carousel-caption">
                        <h2>Book of Love</h2>
                        <p class="d-none d-md-block">Let the pain itself be loved, enhanced, adipisicing. The wise man of their labors.
                            Because of the hardships we have in our offices, the practice of cheering for forgiveness will indeed come to pass.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-img slider-bg-2"></div>
                    <div class="carousel-caption">
                        <h2>Books of Sacrifice</h2>
                        <p class="d-none d-md-block">The love of the main character, the adipisic The wise man of their labors, is the suffering itself. Duties due to our distress, the practice of appealing for pardon will be implemented.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-img slider-bg-3"></div>
                    <div class="carousel-caption">
                        <h2>Books of Wisdom</h2>
                        <p class="d-none d-md-block">The love of the main character, the adipisic The wise man of their labors, is the suffering itself. Duties due to our distress, the practice of appealing for pardon will be implemented.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-area">
                        @if($term = request('term'))
                            <div class="alert alert-info my-3">
                                Search result for <strong>{{$term}}</strong>
                            </div>
                        @endif
                        @if(! $books->count())
                            <div class="alert alert-warning my-4">No books available</div>
                        @else
                            <div class="card my-4">
                                <div class="card-header bg-dark">
                                    <h4 class="text-white">All books</h4>
                                </div>
                                @if(isset($categoryName))
                                    <div class="alert alert-info m-3">
                                        Books from <strong>{{$categoryName}}</strong>
                                    </div>
                                @endif
                                @if(isset($authorName))
                                    <div class="alert alert-info m-3">
                                        Writer <strong>{{$authorName}}</strong>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($books as $book)
                                            <div class="col-lg-3 col-6">
                                                <div class="book-wrap">
                                                    <div class="book-image mb-2">
                                                        <a href="{{route('book-details', $book->id)}}"><img src="{{$book->image_url}}" alt=""></a>
                                                    </div>
                                                    <div class="book-title mb-2">
                                                        <a href="{{route('book-details', $book->id)}}">{{str_limit($book->title, 30)}}</a>
                                                    </div>
                                                    <div class="book-author mb-2">
                                                        <small>By <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a></small>
                                                    </div>
                                                    <div class="pbook-price mb-3">
                                                        <span class=""><strong>Rp{{$book->price}}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="show-more pt-2 text-right">
                                        <nav class="text-center">
                                            {{$books->appends(request()->only(['term']))->render()}}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Sidebar -->
                @include('layouts.includes.side-bar')
                <!-- Sidebar end -->
                </div>
        </div>
    </section>
@endsection
