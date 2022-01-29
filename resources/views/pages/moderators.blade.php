@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">Moderators</div>
        </div>

        <div class="page-body">
            <p>Total of {{ \App\Models\Mod::count() }} moderators registered.</p>

            @if ($moderators->count())

                <div class="mb-4">
                    {{ $moderators->links() }}
                </div>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="icon-people"></i>
                                    </th>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Teachers</th>
                                    <th>Students</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($moderators as $mod)
                                    <tr>
                                        <td>
                                            <div class="avatar d-block" style="background-image: url({{ $mod->avatar() }})"></div>
                                        </td>

                                        <td>
                                            <a href="{{ route('mod.profile', $mod->id) }}">
                                                {{ $mod->name }}
                                            </a>
                                        </td>

                                        <td>{{ $mod->email }}</td>

                                        <td>{{ $mod->teachers()->count() }}</td>

                                        <td>{{ $mod->students()->count() }}</td>

                                        <td>{{ $mod->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    {{ $moderators->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection