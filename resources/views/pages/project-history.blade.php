@extends('layouts.simple')

@if ($year)
    @section('year', $year)
@endif

@section('content')
    <div class="container">
        <section>
            <div class="page-header">
                <h1 class="page-title">
                    RIUF FYP Projects List {{ $year ? $year : '' }}
                </h1>
            </div>

            <div class="page-body">
                {{ $projects->links() }}

                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Supervised By</th>
                            <th>Students</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>

                                <td>
                                    {{ $project->group()->first()->supervisor()->first()->supervisor()->first()->name }}
                                </td>

                                <td>
                                    @foreach ($project->group()->first()->members()->get() as $member)
                                        <p class="m-0 p-0">{{ $member->student()->first()->name }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection