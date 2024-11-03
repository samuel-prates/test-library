@extends('user.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Users</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('welcome') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
                <a class="btn btn-success btn-sm" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Create
                    new User</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @error('error')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror


            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="250px">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('user.destroy',$user->id) }}" method="POST">
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
