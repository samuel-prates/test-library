@extends('loan.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Add New Loan</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('loan.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('loan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputUser" class="form-label"><strong>Users:</strong></label>
                    <select id="inputUser" name="user" aria-label="default select example"
                            class="form-select @error('user') is-invalid @enderror">
                        @forelse($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @empty

                        @endforelse
                    </select>
                    @error('user')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputBook" class="form-label"><strong>Books:</strong></label>
                    <select id="inputBook" name="book" aria-label="default select example"
                            class="form-select @error('book') is-invalid @enderror">
                        @forelse($books as $book)
                            <option value="{{$book->id}}">{{$book->title}}</option>
                        @empty

                        @endforelse
                    </select>
                    @error('book')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>

        </div>
    </div>
@endsection
