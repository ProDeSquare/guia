@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">Students</div>
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
                                            <div class="avatar d-block" style="background-image: url({{ $student->avatar() }})"></div>
                                        </td>

                                        <td>
                                            <a href="{{ route('student.profile', $student->id) }}">
                                                {{ $student->name }}
                                            </a>
                                        </td>

                                        <td>{{ $student->email }}</td>

                                        <td>
                                            <a href="{{ route('mod.profile', $student->createdBy()->id) }}">
                                                {{ $student->createdBy()->name }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="{{ $student->isGrouped() ? 'text-green' : 'text-red' }}">
                                                {{ $student->isGrouped() ? 'Yes' : 'No' }}
                                            </span>
                                        </td>

                                        <td>{{ $student->enabled ? 'Yes' : 'No' }}</td>

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