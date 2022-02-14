@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            @if (strlen(app('request')->input('q')))
                <h3 class="page-title">
                    Search Results.
                </h3>
            @else
                <h3 class="page-title">
                    Search For Something.
                </h3>
            @endif
        </div>

        <div class="page-body">
            @if (strlen(app('request')->input('q')) < 3)
                There were no search results.
            @else
                @include('partials.search-results')
            @endif

            @if (Auth::guard()->user()->searchHistory()->count())
                <h3 class="page-title mt-6">Search History.</h3>

                <ul>
                    @foreach (Auth::guard()->user()->searchHistory()->latest()->take(10)->get() as $searchQuery)
                        <li>
                            <a href="{{ route('search') . '?q=' . $searchQuery->query }}">{{ $searchQuery->query }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection