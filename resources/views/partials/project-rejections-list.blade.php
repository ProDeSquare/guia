@if ($rejections->count())
    <h4 class="page-title">Rejections</h4>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                <thead>
                    <tr>
                        <th class="text-center">
                            <i class="icon-people"></i>
                        </th>

                        <th>Teacher</th>
                        <th>Comment</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rejections as $rejection)
                        <tr>
                            <td class="text-center">
                                <div class="avatar d-block" style="background-image: url({{ $rejection->teacher()->first()->avatar() }})"></div>
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('teacher.profile', $rejection->teacher()->first()->id) }}">
                                        {{ $rejection->teacher()->first()->name }}
                                    </a>
                                </div>
                                <div class="small text-muted">
                                    {{ $rejection->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td>
                                <div>
                                    {{ $rejection->comment }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif