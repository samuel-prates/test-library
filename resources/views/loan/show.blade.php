@extends('loan.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Show Loan</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('loan.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User:</strong> <br/>
                        {{ $loan->user->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Book:</strong> <br/>
                        {{ $loan->book->title }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Loan date:</strong> <br/>
                        {{ $loan->loan_date }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Return date:</strong> <br/>
                        {{ $loan->return_date }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
