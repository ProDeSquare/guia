@extends('layouts.app')

@section('title', '| Students')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Students</h3>
        </div>

        <div class="page-body">
            <p>Total of {{ \App\Models\Student::count() }} students registered.</p>

            @if ($students->count())

                <div class="mb-4">
                    {{ $students->links() }}
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Added By</th>
                                    <th>Grouped</th>
                                    <th>Enabled</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            <div
                                                class="avatar d-block"
                                                style="background-image: url({{ $student->avatar() }}), url(https://www.gravatar.com/avatar/{{ md5($student->email) }}?d=mm)"
                                            ></div>
                                        </td>

                                        <td>
                                            <a href="{{ route('student.profile', $student->id) }}">
                                                {{ $student->name }}
                                            </a>
                                        </td>

                                        <td>{{ $student->username }}</td>

                                        <td>{{ $student->email }}</td>

                                        <td>
                                            <a href="{{ route('mod.profile', $student->createdBy()->id) }}">
                                                {{ $student->createdBy()->name }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="{{ $student->isGrouped() ? 'text-green' : 'text-red' }}">
                                                {!! $student->isGrouped() ? '<i class="fe fe-check"></i>' : '<i>No</i>' !!}
                                            </span>
                                        </td>

                                        <td>{!! $student->enabled ? '<i class="fe fe-check"></i>' : '<i>No</i>' !!}</td>

                                        <td>{{ $student->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection