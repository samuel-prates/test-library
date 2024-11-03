@extends('loan.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Loans</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('welcome') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
                <a class="btn btn-success btn-sm" href="{{ route('loan.create') }}"><i class="fa fa-plus"></i> Create
                    new Loan</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif


            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Loan Date</th>
                    <th>Return Date</th>
                    <th width="250px">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->loan_date }}</td>
                        <td>{{ $loan->return_date }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('loan.show',['loan'=>$loan->id]) }}"><i
                                    class="fa-solid fa-list"></i> Show</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">There are no data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>


        </div>
    </div>

@endsection
