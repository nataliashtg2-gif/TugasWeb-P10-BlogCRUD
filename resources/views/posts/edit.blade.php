@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')

<div class="page-header">
    <div>
        <h1>✦ Edit Postingan</h1>
        <p>Perbarui isi postingan dan foto yang kamu gunakan.</p>
    </div>

```
<a href="{{ route('posts.index') }}" class="btn btn-secondary">
    ← Kembali
</a>
```

</div>

<x-card>

<form action="{{ route('posts.update', $post) }}"
      method="POST"
      enctype="multipart/form-data">

```
@csrf
@method('PUT')


{{-- JUDUL --}}
<div class="form-group">

    <label for="title">
        Judul Postingan
    </label>

    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $post->title) }}"
        required
    >

    @error('title')
        <div class="error">{{ $message }}</div>
    @enderror

</div>


{{-- PENULIS --}}
<div class="form-group">

    <label for="author">
        Penulis
    </label>

    <input
        type="text"
        id="author"
        name="author"
        value="{{ old('author', $post->author) }}"
        required
    >

    @error('author')
        <div class="error">{{ $message }}</div>
    @enderror

</div>


{{-- ISI --}}
<div class="form-group">

    <label for="content">
        Isi Postingan
    </label>

    <textarea
        id="content"
        name="content"
        rows="10"
        required
    >{{ old('content', $post->content) }}</textarea>

    @error('content')
        <div class="error">{{ $message }}</div>
    @enderror

</div>


{{-- FOTO LAMA --}}
<div class="form-group">

    <label>
        Foto Saat Ini
    </label>

    <div class="existing-photos">

        @for($i = 1; $i <= 4; $i++)

            @if($post->{"image_$i"})

                <div class="existing-photo">

                    <img
                        src="{{ asset('storage/' . $post->{"image_$i"}) }}"
                        alt="Foto {{ $i }}"
                    >

                    <span>
                        Foto {{ $i }}
                    </span>

                </div>

            @endif

        @endfor

    </div>

    @if(
        !$post->image_1 &&
        !$post->image_2 &&
        !$post->image_3 &&
        !$post->image_4
    )

        <div class="no-photo">
            📷 Belum ada foto pada postingan ini.
        </div>

    @endif

</div>


{{-- FOTO BARU --}}
<div class="form-group">

    <label for="images">
        Ganti / Tambahkan Foto
    </label>

    <div class="photo-info">
        <span>📸</span>

        <div>
            <strong>Pilih foto baru</strong>

            <p>
                Foto yang dipilih akan menggantikan foto pada posisi
                yang sesuai. Maksimal 4 foto.
            </p>
        </div>
    </div>


    <label for="images" class="upload-box">

        <div class="upload-icon">
            ＋
        </div>

        <div class="upload-title">
            Pilih Foto
        </div>

        <div class="upload-subtitle">
            Klik untuk memilih foto baru
        </div>

        <div class="upload-limit">
            JPG, JPEG, PNG, WebP • Maks. 2 MB/foto
        </div>

    </label>


    <input
        type="file"
        id="images"
        name="images[]"
        accept="image/jpeg,image/png,image/webp"
        multiple
        hidden
    >


    <div id="photoCounter" class="photo-counter">
        0 / 4 foto dipilih
    </div>

    <div id="previewContainer" class="photo-preview"></div>

</div>


{{-- TANGGAL --}}
<div class="form-group">

    <label>
        Tanggal Dibuat
    </label>

    <input
        type="text"
        value="{{ $post->created_at->format('d F Y') }}"
        disabled
    >

</div>


{{-- ACTION --}}
<div class="form-actions">

    <a
        href="{{ route('posts.show', $post) }}"
        class="btn btn-secondary"
    >
        Batal
    </a>

    <button
        type="submit"
        class="btn btn-primary"
    >
        ✨ Simpan Perubahan
    </button>

</div>
```

</form>

</x-card>

<script>

const imageInput = document.getElementById('images');
const previewContainer = document.getElementById('previewContainer');
const photoCounter = document.getElementById('photoCounter');

imageInput.addEventListener('change', function () {

    previewContainer.innerHTML = '';

    const files = Array.from(this.files);

    if (files.length > 4) {

        alert('Maksimal 4 foto.');

        this.value = '';

        photoCounter.textContent =
            '0 / 4 foto dipilih';

        return;
    }

    photoCounter.textContent =
        files.length + ' / 4 foto dipilih';

    files.forEach((file, index) => {

        if (file.size > 2 * 1024 * 1024) {

            alert(
                `Foto "${file.name}" lebih dari 2 MB.`
            );

            return;
        }

        if (!file.type.startsWith('image/')) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            const preview =
                document.createElement('div');

            preview.className =
                'photo-preview-item';

            preview.innerHTML = `
                <img
                    src="${event.target.result}"
                    alt="Preview foto"
                >

                <div class="photo-number">
                    Foto ${index + 1}
                </div>
            `;

            previewContainer.appendChild(preview);
        };

        reader.readAsDataURL(file);

    });

});

</script>

@endsection
