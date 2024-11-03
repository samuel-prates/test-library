@extends('book.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Books</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('welcome') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
                <a class="btn btn-success btn-sm" href="{{ route('book.create') }}"><i class="fa fa-plus"></i> Create
                    new Book</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif


            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Authors</th>
                    <th width="250px">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->year }}</td>
                        <td>
                            @isset($book->authors)
                                @forelse($book->authors as $author)
                                    <p>{{$author->name}}</p>
                                @empty
                                @endforelse
                            @endisset
                        </td>
                        <td>
                            <form action="{{ route('book.destroy',$book->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('book.show',['book'=>$book->id]) }}"><i
                                        class="fa-solid fa-list"></i> Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('book.edit',['book'=>$book->id]) }}"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">There are no data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>


        </div>
    </div>

@endsection
