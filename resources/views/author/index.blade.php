@extends('author.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Authors</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('welcome') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
                <a class="btn btn-success btn-sm" href="{{ route('author.create') }}"><i class="fa fa-plus"></i> Create
                    new Author</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif


            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th>content</th>
                    <th width="250px">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($authors as $author)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->birthday }}</td>
                        <td>
                            <form action="{{ route('author.destroy',$author->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('author.show',['author'=>$author->id]) }}"><i
                                        class="fa-solid fa-list"></i> Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('author.edit',['author'=>$author->id]) }}"><i
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
                        <td colspan="4">There are no data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>


        </div>
    </div>

@endsection
