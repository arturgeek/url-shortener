@extends('layout.master')
@section('content')

@if (isset($tinyUrl))
    <p class="lead mb-4">
        Here is the information for your URL
    </p>
    <div class="col-lg-6 mx-auto">
        <ul class="list-group">
            <li class="list-group-item">
                URL Title:
                {{ $tinyUrl["title"] }}
            </li>
            <li class="list-group-item">
                Original URL:
                <a target="_blank" href="{{ $tinyUrl["originalUrl"] }}">{{ $tinyUrl["originalUrl"] }}</a>
            </li>
            <li class="list-group-item">
                Shortened URL:
                <a target="_blank" href="{{ $tinyUrl["shortenedUrl"] }}">{{ $tinyUrl["shortenedUrl"] }}</a>
            </li>
        </ul>
    </div>
    <div class="m-3">
        Do you want to shorten another url? <a href="/">Click Here</a>
    </div>
@else

    <form method="POST" action="get-tiny-url">
        @csrf
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.
            </p>
            <div class="m-3">
                <input class="form-control text-center" type="text" name="url" value="" placeholder="Enter the URL" />
            </div>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">Get shortened URL</button>
                <a href="/top-100" class="btn btn-outline-secondary btn-lg px-4">Show Top 100</a>
            </div>
        </div>
    </form>
    @if (isset($error))
        <div class="error">
            {{ $error }}
        </div>
    @endif

@endif

@stop
