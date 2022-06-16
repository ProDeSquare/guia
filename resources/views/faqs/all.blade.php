@extends('layouts.faqs')

@section('b-content')
    <div class="container">
        @if ($faqs->count())
            <ol>
                @foreach ($faqs as $faq)
                    <li>
                        <a href="{{ route('faq.view', $faq) }}">{{ $faq->question }}</a> - {{ $faq->created_at->diffForHumans() }}
                    </li>
                @endforeach
            </ol>

            {{ $faqs->links() }}
        @else
            <p>There were no FAQs answered yet.</p>            
        @endif
    </div>
@endsection