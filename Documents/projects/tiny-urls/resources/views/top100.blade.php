@extends('layout.master')
@section('content')

<div class="col-lg-6 mx-auto">

    <a href="/" class="btn btn-outline-secondary btn-lg px-4 m-5">Back</a>

    <h1 class="m-3">Top 100</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Original URL</th>
                <th>Tiny URL</th>
                <th>Hits</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($top as $tinyUrl)
            <tr>
                <td>{{ $tinyUrl["title"] }}</td>
                <td><a target="_blank" href="{{ $tinyUrl["originalUrl"] }}">{{ $tinyUrl["originalUrl"] }}</a></td>
                <td><a target="_blank" href="{{ $tinyUrl["shortenedUrl"] }}">{{ $tinyUrl["shortenedUrl"] }}</a></td>
                <td>{{ $tinyUrl["access"] }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@stop
