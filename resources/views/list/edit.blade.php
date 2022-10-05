@extends('home')

@section('content')

    <div class="card">
        <div class="card-header" style="display:flex;align-items:center;">
            <a href="/" class="btn btn-secondary"><i class="bi-chevron-left"></i></a>
            <h3 class="ms-3" style="margin-bottom:0;">Edit task</h3>
        </div>
        <div class="card-body">
            <form action="/job/{{ $job->id }}" method="post" autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="input-group">
                    <label class="form-label">Title</label>
                    <div class="input-group">
                        <input 
                            type="text"
                            name="title"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            placeholder="Title"
                            aria-label="Title"
                            value="{{ old('title') ?? $job->title }}"
                            autofocus
                        >
                    </div>
                    <label class="form-label mt-3">End date</label>
                    <div class="input-group">
                        <input
                            id="end-date"
                            type="text"
                            name="end_date"
                            class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                            placeholder="End date"
                            aria-label="End date"
                            value="{{ old('end_date') }}"
                            autofocus
                        >
                    </div>
                    <label class="form-label mt-3">Comment</label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="comment"
                            class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                            placeholder="Comment"
                            aria-label="Comment"
                            value="{{ old('comment') ?? $job->comment }}"
                            autofocus
                        >
                    </div>
                </div>
                <div class="input-group mt-3" style="width:auto; justify-content:end;">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
        @if (count($errors))
            <div class="card-footer">
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
            </div>
        @endif
    </div>
            

@endsection

@section('datepicker')

    <script>
        var today = new Date();
        var tomorrow = today.setDate(today.getDate() + 1);
        var endDate = new Date('{{ $job->end_date }}');
        var picker = new easepick.create({
            element: "#end-date",
            css: [
                "https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css"
            ],
            zIndex: 10,
            date: endDate,
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