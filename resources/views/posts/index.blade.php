@extends('layouts.app')

@section('title', 'Daftar Blog')

@section('content')

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif


    <section class="hero">

        <div class="hero-content">

            <div class="hero-text">

                <div class="eyebrow">
                    ✦ BLOG SPACE
                </div>

                <h1>
                    Cerita kecil,
                    <span>ide besar.</span>
                </h1>

                <p>
                    Tempat menyimpan cerita, pengalaman,
                    tugas, dan berbagai ide dalam satu ruang
                    yang sederhana dan nyaman.
                </p>

            </div>

            <div>

                <a
                    href="{{ route('posts.create') }}"
                    class="btn btn-primary"
                >
                    + Tambah Post
                </a>

            </div>

        </div>

    </section>


    <div class="toolbar">

        <div class="search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                id="searchPost"
                placeholder="Cari postingan..."
            >

        </div>

        <div>
            <strong>
                {{ $posts->total() }}
            </strong>
            postingan
        </div>

    </div>


    <div class="blog-grid" id="blogGrid">

        @forelse($posts as $post)

            <article
                class="blog-card"
                data-title="{{ strtolower($post->title) }}"
                data-author="{{ strtolower($post->author) }}"
            >

                <div class="post-meta">

                    <span class="post-dot"></span>

                    <span>
                        {{ $post->created_at?->format('d M Y') }}
                    </span>

                    <span>•</span>

                    <span>
                        {{ $post->author }}
                    </span>

                </div>


                <h2>
                    {{ $post->title }}
                </h2>


                <p>
                    {{ \Illuminate\Support\Str::limit($post->content, 150) }}
                </p>


                <div class="post-actions">

                    <a
                        href="{{ route('posts.show', $post) }}"
                        class="btn btn-secondary"
                    >
                        👁 Lihat
                    </a>

                    <a
                        href="{{ route('posts.edit', $post) }}"
                        class="btn btn-edit"
                    >
                        ✎ Edit
                    </a>

                    <form
                        action="{{ route('posts.destroy', $post) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus postingan ini?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger"
                        >
                            ♡ Hapus
                        </button>

                    </form>

                </div>

            </article>

        @empty

            <div class="empty-state">

                <div class="empty-icon">
                    ✿
                </div>

                <h3>
                    Belum ada postingan
                </h3>

                <p>
                    Yuk tulis cerita atau ide pertamamu.
                </p>

                <a
                    href="{{ route('posts.create') }}"
                    class="btn btn-primary"
                >
                    + Buat Post Pertama
                </a>

            </div>

        @endforelse

    </div>


    @if($posts->hasPages())

        <div class="pagination">
            {{ $posts->links() }}
        </div>

    @endif

</div>


<script>

const searchInput = document.getElementById('searchPost');

searchInput?.addEventListener('input', function () {

    const keyword = this.value.toLowerCase();

    const cards =
        document.querySelectorAll('.blog-card');

    cards.forEach(card => {

        const title =
            card.dataset.title || '';

        const author =
            card.dataset.author || '';

        const match =
            title.includes(keyword) ||
            author.includes(keyword);

        card.style.display =
            match ? '' : 'none';

    });

});

</script>

@endsection