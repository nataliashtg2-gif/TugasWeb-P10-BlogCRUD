```php
@extends('layouts.app')

@section('title', $post->title)

@section('content')

<div class="article-page">

    <div class="article-top">
        <a href="{{ route('posts.index') }}" class="back-link">
            ← Kembali ke Blog
        </a>
    </div>

    <article class="article-card">

        {{-- KATEGORI --}}
        @if(!empty($post->category))
            <div class="article-category">
                {{ $post->category }}
            </div>
        @endif


        {{-- JUDUL --}}
        <h1 class="article-title">
            {{ $post->title }}
        </h1>


        {{-- META --}}
        <div class="article-meta">

            <span>
                👤 {{ $post->author }}
            </span>

            <span class="meta-divider">•</span>

            <span>
                📅 {{ $post->created_at->format('d F Y') }}
            </span>

            <span class="meta-divider">•</span>

            <span>
                👁 {{ $post->views ?? 0 }} views
            </span>

        </div>


        {{-- FOTO GALLERY --}}
        @php
            $images = collect([
                $post->image_1,
                $post->image_2,
                $post->image_3,
                $post->image_4,
            ])->filter();
        @endphp


        @if($images->count() > 0)

            <div class="article-gallery">

                @foreach($images as $image)

                    <div class="gallery-item">

                        <img
                            src="{{ asset('storage/' . $image) }}"
                            alt="{{ $post->title }}"
                            class="article-image"
                        >

                    </div>

                @endforeach

            </div>

        @else

            <div class="article-image-placeholder">

                <div class="placeholder-icon">
                    📝
                </div>

                <span>
                    Belum ada foto cover
                </span>

            </div>

        @endif


        {{-- ISI ARTIKEL --}}
        <div class="article-content">
            {!! nl2br(e($post->content)) !!}
        </div>


        {{-- FOOTER ARTIKEL --}}
        <div class="article-footer">

            <div class="article-actions">

                <a
                    href="{{ route('posts.edit', $post) }}"
                    class="btn btn-primary"
                >
                    ✏ Edit
                </a>


                <form
                    action="{{ route('posts.destroy', $post) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus post ini?')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        🗑 Hapus
                    </button>

                </form>

            </div>

        </div>

    </article>

</div>

@endsection
```
