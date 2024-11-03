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
        <h2 class="card-header">Loggin</h2>
        <div class="card-body">
            <form action="{{ route('api.login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputEmail" class="form-label"><strong>Email:</strong></label>
                    <input
                        type="text"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="inputEmail"
                        placeholder="Email">
                    @error('email')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label"><strong>Password:</strong></label>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="inputPassword"
                        placeholder="Password">
                    @error('password')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
