<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo Criado</title>
</head>
<body>
<h1>Um novo empréstimo foi criado!</h1>
<p>O livro <strong>{{ $loan->book->title }}</strong> foi emprestado para o usuário <strong>{{ $loan->user->name }}</strong>.</p>
<p>Data do Empréstimo: {{ $loan->loan_date }}</p>
<p>Data de Devolução: {{ $loan->return_date }}</p>
</body>
</html>
