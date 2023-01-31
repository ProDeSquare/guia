<p>
    <strong>{{ $results->count() }}</strong> result(s) for <strong>{{ app('request')->input('q') }}</strong>
</p>

@foreach ($results->groupByType() as $type => $modelSearchResults)
    <h4>{{ ucwords($type) }}</h4>

    @foreach ($modelSearchResults as $result)
        <ul>
            <li>
                <a href="{{ $result->url }}">{{ $result->title }}</a>
            </li>
        </ul>
    @endforeach
@endforeach