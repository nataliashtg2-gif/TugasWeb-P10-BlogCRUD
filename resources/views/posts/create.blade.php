@extends('layouts.master')

@section('title', 'Tambah Post')

@section('content')

<div class="page-header">

    <div>
        <h1>✦ Buat Postingan Baru</h1>
        <p>Bagikan cerita, pengalaman, atau tugas kamu melalui postingan baru.</p>
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>

</div>


<x-card>

<form
    action="{{ route('posts.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf


    {{-- JUDUL --}}
    <div class="form-group">

        <label for="title">
            Judul Postingan
        </label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title') }}"
            placeholder="Contoh: Pengalaman Mengerjakan Tugas Web"
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
            value="{{ old('author') }}"
            placeholder="Masukkan nama penulis"
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
            placeholder="Tuliskan isi postingan kamu di sini..."
            required
        >{{ old('content') }}</textarea>

        @error('content')
            <div class="error">{{ $message }}</div>
        @enderror

    </div>


    {{-- FOTO --}}
    <div class="form-group">

        <label>
            📷 Foto Postingan
        </label>

        <p class="photo-description">
            Tambahkan 0–4 foto. Kamu bisa memilih foto satu per satu.
            Foto tidak wajib diisi.
        </p>


        <div class="photo-slots">

            @for($i = 1; $i <= 4; $i++)

                <div class="photo-slot">

                   <div
    class="photo-preview-box"
    id="preview-box-{{ $i }}"
    style="
        width:100%;
        height:220px;
        overflow:hidden;
        box-sizing:border-box;
        border-radius:12px;
        position:relative;
    "
>
                        <div class="empty-photo">
                            <span>＋</span>
                            <small>Foto {{ $i }}</small>
                        </div>

                    </div>


                    <label
                        for="image_{{ $i }}"
                        class="photo-select-button"
                    >
                        📷 Pilih Foto {{ $i }}
                    </label>


                    <input
                        type="file"
                        id="image_{{ $i }}"
                        name="image_{{ $i }}"
                        accept="image/jpeg,image/png,image/webp"
                        hidden
                    >


                    <button
                        type="button"
                        class="remove-photo"
                        id="remove-{{ $i }}"
                        style="display:none;"
                    >
                        ✕ Hapus
                    </button>

                </div>

            @endfor

        </div>


        <div class="photo-limit">
            Maksimal 4 foto • JPG, JPEG, PNG, WebP • Maks. 2 MB/foto
        </div>

    </div>


    {{-- TANGGAL --}}
    <div class="form-group">

        <label>
            📅 Tanggal Posting
        </label>

        <input
            type="text"
            value="{{ now()->format('d F Y') }}"
            disabled
        >

    </div>


    {{-- BUTTON --}}
    <div class="form-actions">

        <a
            href="{{ route('posts.index') }}"
            class="btn btn-secondary"
        >
            Batal
        </a>

        <button
            type="submit"
            class="btn btn-primary"
        >
            ✨ Publikasikan Post
        </button>

    </div>

</form>

</x-card>


<script>

for (let i = 1; i <= 4; i++) {

    const input = document.getElementById(`image_${i}`);
    const preview = document.getElementById(`preview-box-${i}`);
    const removeButton = document.getElementById(`remove-${i}`);

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        if (file.size > 2 * 1024 * 1024) {

            alert('Ukuran foto maksimal 2 MB.');

            this.value = '';

            return;
        }


        const reader = new FileReader();

        reader.onload = function (event) {

           preview.innerHTML = `
    <img
        src="${event.target.result}"
        alt="Preview Foto ${i}"
        style="
            display:block;
            width:100%;
            height:100%;
            max-width:100%;
            max-height:100%;
            object-fit:cover;
            object-position:center;
            margin:0;
            padding:0;
        "
    >
`;

            removeButton.style.display = 'inline-flex';
        };

        reader.readAsDataURL(file);

    });


    removeButton.addEventListener('click', function () {

        input.value = '';

        preview.innerHTML = `
            <div class="empty-photo">
                <span>＋</span>
                <small>Foto ${i}</small>
            </div>
        `;

        removeButton.style.display = 'none';

    });

}

</script>

@endsection