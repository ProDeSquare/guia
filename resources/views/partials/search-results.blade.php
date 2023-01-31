<p>
    <strong>{{ $results->count() }}</strong> result(s) for <strong>{{ app('request')->input('q') }}</strong>
</p>

@foreach ($results->groupByType() as $type => $modelSearchResults)
    @if (in_array($type, ['students', 'teachers']))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ ucwords($type) }}</h3>
            </div>

            <div class="card-body o-auto" style="max-height: 15rem">
                <ul class="list-unstyled list-separated">
                    @foreach ($modelSearchResults as $result)
                        <li class="list-separated-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="avatar avatar-md d-block"
                                        style="background-image: url({{ $result->searchable->avatar() }}), url(https://www.gravatar.com/avatar/{{ md5($result->searchable->email) }}?d=mm)"
                                    ></span>
                                </div>
                                <div class="col">
                                    <div>
                                        <a href="{{ route(rtrim($type, 's') . '.profile', $result->searchable->id) }}" class="text-inherit">{{ $result->searchable->name }}</a>
                                    </div>
                                    <small class="d-block item-except text-sm text-muted h-1x">
                                        {{ $result->searchable->email }}
                                    </small>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @elseif ($type === 'projects')
        <h3>{{ ucwords($type) }}</h3>

        <div class="row">
            @foreach ($modelSearchResults as $result)
                <div class="col-lg-6 mb-5">
                    <div class="card card-body">
                        <div>
                            <a class="badge badge-teacher-student" href="{{ route('project.view', $result->searchable->id) }}">
                                #{{ $result->searchable->id }}
                            </a>
                        </div>

                        <h3 class="card-title mt-5">
                            <a href="{{ route('project.view', $result->searchable->id) }}">
                                {{ $result->searchable->title }}
                            </a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endforeach