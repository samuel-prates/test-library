@extends('book.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Add New Book</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('book.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('book.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputTitle" class="form-label"><strong>Title:</strong></label>
                    <input
                        type="text"
                        name="title"
                        value=""
                        class="form-control @error('title') is-invalid @enderror"
                        id="inputTitle"
                        placeholder="Title">
                    @error('title')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="inputYear" class="form-label"><strong>Year:</strong></label>
                    <input id="inputYear" name="year" type="text" placeholder="1980"
                           class="form-control @error('year') is-invalid @enderror"
                           value="">
                    @error('year')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputAuthors" class="form-label"><strong>Authors:</strong></label>
                    <select id="inputAuthors" name="authors[]" multiple aria-label="multiple select example"
                            class="form-select @error('authors') is-invalid @enderror">
                        @forelse($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                        @empty

                        @endforelse
                    </select>
                    @error('authors')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
@endsection
