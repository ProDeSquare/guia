@extends('layouts.faqs')

@section('title')
    | {{ $faq->question }}
@endsection

@section('b-content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                {{ $faq->id }}: {{ $faq->question }}
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-8">
                    <p>
                        {{ $faq->answer }}
                    </p>
        
                    <span class="text-muted">Answered {{ $faq->created_at->diffForHumans() }}</span>
                    <span>
                        - View all <a href="{{ route('faqs') }}">Frequently Asked Questions</a>.
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection