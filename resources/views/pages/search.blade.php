@extends('layouts.app')

@section('title')
    | Search
@endsection

@section('content')
    <div class="container mt-6">
        <div class="page-body">
            <div class="row">
                <div class="col-lg-8">
                    @if (strlen(app('request')->input('q')) < 3)
                        <p>Search for something.</p>
                    @else
                        @include('partials.search-results')
                    @endif
                </div>

                <div class="col-lg-4">
                    @if (Auth::guard()->user()->searchHistory()->count())
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Search History ({{ Auth::guard()->user()->searchHistory()->count() }})
                                </h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach (Auth::guard()->user()->searchHistory()->latest()->take(10)->get() as $searchQuery)
                                        <li>
                                            <a href="{{ route('search') . '?q=' . $searchQuery->query }}">{{ $searchQuery->query }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection