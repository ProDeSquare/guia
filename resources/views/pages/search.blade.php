@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Search Results.</h3>
        </div>

        <div class="page-body">
            <p>
                There are <strong>{{ $results->count() }}</strong> results for <strong>{{ app('request')->input('q') }}</strong>
            </p>

            @foreach ($results->groupByType() as $type => $modelSearchResults)
                <h3>{{ ucwords($type) }}</h3>

                @foreach ($modelSearchResults as $result)
                    <ul>
                        <li>
                            <a href="{{ $result->url }}">{{ $result->title }}</a>
                        </li>
                    </ul>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection