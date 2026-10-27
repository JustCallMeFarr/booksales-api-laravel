<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Book Sales</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5f6fa; color: #222; }
        nav { background: #4472c4; padding: 14px 32px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        main { max-width: 1000px; margin: 32px auto; background: #fff; padding: 24px 32px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #ddd; text-align: left; vertical-align: top; }
        th { background: #ed7d31; color: #fff; }
        a.btn { display: inline-block; margin-top: 16px; color: #4472c4; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('books.index') }}">Book</a>
        <a href="{{ route('genres.index') }}">Genre</a>
        <a href="{{ route('authors.index') }}">Author</a>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
