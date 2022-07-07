@extends('layouts.app')

@section('title', ' | Answer FAQ')

@section('content')
    <div class="container">
        <div class="page-header">
            <div>
                <h3 class="page-title">Answer FAQ</h3>

                <p>Answer a new Frequently Asked Question.</p>
            </div>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-body">
                        <div class="card-title">
                            Fill out all the fields.
                        </div>

                        <form method="post" action="{{ route('faq.create') }}">
                            @csrf

                            <div class="form-group">
                                <label for="question" class="form-label">Question <span class="text-red">*</span></label>

                                <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" placeholder="Where are the presentations conducted?" name="question" value="{{ old('question') }}" required />
                                
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="answer" class="form-label">Answer <span class="text-red">*</span></label>

                                <textarea rows="7" class="form-control @error('answer') is-invalid @enderror" id="answer" placeholder="In campus..." name="answer" required>{{ old('answer') }}</textarea>

                                <small class="form-hint">This field accepts markdown</small>

                                @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Recently answered FAQs
                            </h3>
                        </div>

                        <div class="card-body">
                            <ul>
                                @forelse ($faqs as $faq)
                                    <li>
                                        <a href="{{ route('faq.view', $faq) }}">
                                            {{ $faq->question }}
                                        </a>
                                    </li>
                                @empty
                                    <li>There were no recently answered FAQs.</li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="card-footer">
                            <span>
                                View all <a href="{{ route('faqs') }}">Frequently Asked Questions</a>.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection