@extends('home')

@section('content')

        <div class="card">
            <div class="card-header">
                <h3>To-do list</h3>
                <form action="{{ route('store') }}" method="POST" autocomplete="off" class="mb-3" style="display:flex;">
                    @csrf
                    <div class="input-group">
                        <div class="input-group">
                            <input
                                type="text"
                                name="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                placeholder="Title"
                                aria-label="Title"
                                value="{{ old('title') }}"
                                autofocus
                                style="border-bottom-left-radius:0;border-bottom-right-radius:0;border-top-right-radius:0;"
                            >
                        </div>
                        <div class="input-group" style="margin-left:0;">
                            <input
                                id="end-date"
                                type="text"
                                name="end_date"
                                class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                placeholder="End date"
                                aria-label="End date"
                                value="{{ old('end_date') }}"
                                autofocus
                                style="border-radius:0;border-top:0 none;border-bottom:0 none;"
                            >
                        </div>
                        <div class="input-group" style="margin-left:0;">
                            <input
                                type="text"
                                name="comment"
                                class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                placeholder="Comment"
                                aria-label="Comment"
                                value="{{ old('comment') }}"
                                autofocus
                                style="border-top-left-radius:0;border-top-right-radius:0;border-bottom-right-radius:0;"
                            >
                        </div>
                    </div>
                    <div class="input-group" style="width:auto;">
                        <button
                            class="btn btn-outline-secondary"
                            type="submit"
                            style="border-top-left-radius:0;border-bottom-left-radius:0;"
                        ><i class="bi-plus-lg"></i></button>
                    </div>
                </form>
                @if (count($errors))
                    <div class="d-flex flex-column">
                        @if ($errors->has('title'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('end_date'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
            <div class="card-body">
                <!-- {{-- if tasks exist --}} -->
                @if (count($job_list))
                    <ul class="list-group">
                        @foreach ($job_list as $job)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-bold">{{ $job->title }}</span>
                                    <span class="">Finish: {{ \Carbon\Carbon::parse($job->end_date)->format('j F, Y') }}<span class="text-secondary" style="font-size:.7rem;"> (Created: {{ \Carbon\Carbon::parse($job->created_at)->format('j F, Y') }})</span></span>
                                    @if ( $job->comment )
                                        <span class="">Comment: {{ $job->comment }}</span>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    <form action="/done/{{ $job->id }}" method="GET" class="me-2">
                                        @csrf
                                        <button class="btn btn-info"><i class="bi-check-lg"></i></button>
                                    </form>
                                    <a class="btn btn-success me-2" href="{{ route('edit', $job->id) }}"><i class="bi-pencil"></i></a>
                                    <form action="{{ route('destroy', $job->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger"><i class="bi-trash3"></i></button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center mt-3">No tasks to show!</p>
                @endif
            </div>
            @if (count($job_list) or $done_job_list_count )
                <div class="card-footer" style="display:flex; justify-content:space-between;">
                    @if (count($job_list))
                        <span>
                            @if ( count($job_list) < 2 )
                                You have {{ count($job_list) }} pending task!
                            @else
                                You have {{ count($job_list) }} pending tasks!
                            @endif
                        </span>
                    @endif
                    @if ( $done_job_list_count )
                        <span>
                            @if ( $done_job_list_count < 2 )
                                You have {{ $done_job_list_count }} done task!
                            @else
                                You have {{ $done_job_list_count }} done tasks!
                            @endif
                        </span>
                    @endif
                </div>
            @endif
        </div>

@endsection

@section('datepicker')

    <script>
        var today = new Date();
        var tomorrow = today.setDate(today.getDate() + 1);
        var picker = new easepick.create({
            element: "#end-date",
            css: [
                "https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css"
            ],
            zIndex: 10,
            format: "DD MMM YYYY",
            LockPlugin: {
                minDate: tomorrow,
            },
            plugins: [
                "LockPlugin"
            ]
        })
    </script>

@endsection
