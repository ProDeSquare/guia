@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Teachers</h3>
        </div>

        <div class="page-body">
            <p>Total of {{ \App\Models\Teacher::count() }} teachers registered.</p>

            @if ($teachers->count())

                <div class="mb-4">
                    {{ $teachers->links() }}
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
                                    <th>Added By</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>
                                            <div class="avatar d-block" style="background-image: url({{ $teacher->avatar() }})"></div>
                                        </td>

                                        <td>
                                            <a href="{{ route('teacher.profile', $teacher->id) }}">
                                                {{ $teacher->name }}
                                            </a>
                                        </td>

                                        <td>{{ $teacher->email }}</td>

                                        <td>
                                            <a href="{{ route('mod.profile', $teacher->createdBy()->id) }}">
                                                {{ $teacher->createdBy()->name }}
                                            </a>
                                        </td>

                                        <td>{{ $teacher->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection