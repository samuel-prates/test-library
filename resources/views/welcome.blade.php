<!DOCTYPE html>
<html>
<head>
    <title>Author Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>

<div class="container">
    <div class="card mt-5">
        <h2 class="card-header">Laravel Test</h2>
        @error('error')
        <div class="form-text text-danger">{{ $message }}</div>
        @enderror
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md">
                <a class="btn btn-success btn-sm" href="{{ route('user.index') }}">
                    <i class="fa fa-plus"></i> Manage Users</a>
                <a class="btn btn-success btn-sm" href="{{ route('author.index') }}">
                    <i class="fa fa-plus"></i> Manage Authors</a>
                <a class="btn btn-success btn-sm" href="{{ route('book.index') }}">
                    <i class="fa fa-plus"></i> Manage Books</a>
                <a class="btn btn-success btn-sm" href="{{ route('loan.index') }}">
                    <i class="fa fa-plus"></i> Manage Loans</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
