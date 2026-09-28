<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Blog CRUD Laravel')
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >
</head>

<body>

    <nav class="navbar">
        <div class="navbar-inner">

            <a href="{{ route('posts.index') }}" class="brand">

                <span class="brand-icon">
                    ✦
                </span>

                <span>
                    My Little Blog
                </span>

            </a>

            <a
                href="{{ route('posts.create') }}"
                class="btn btn-primary"
            >
                + Tulis Post
            </a>

        </div>
    </nav>


    <main>

        @yield('content')

    </main>


    <footer class="footer">

        Made with
        <span>♥</span>
        using Laravel — Tugas Rutin 10

    </footer>

</body>
</html>