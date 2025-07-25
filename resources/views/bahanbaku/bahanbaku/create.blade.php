@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Tambah Bahan Baku
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Create a task for your cluster!!
        </p>
        <form method="post" action="{{ route('tambah-bahanbaku') }}" enctype="multipart/form-data" class="mt-6">
            @csrf
            <label for="id_bahan" class="block text-sm font-medium text-gray-700">Nama Bahan</label>
            <select id="id_bahan" name="id_bahan" class="w-1/2 select2" required>
                <option value="" disabled selected hidden>Cari bahan...</option>
                @foreach ($data as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_bahan }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('id_bahan')" />



            <div class="w-1/2 my-5">
                <x-input-label for="tgl_masuk" :value="__('Tanggal Masuk')" />
                <x-text-input id="tgl_masuk" name="tgl_masuk" type="date" class="mt-1 block w-full" required autocomplete="tgl_masuk" />
                <x-input-error class="mt-2" :messages="$errors->get('tgl_masuk')" />
            </div>
            <div class="w-1/2 my-5">
                <x-input-label for="tgl_kadaluarsa" :value="__('Tanggal Kadaluarsa')" />
                <x-text-input id="tgl_kadaluarsa" name="tgl_kadaluarsa" type="date" class="mt-1 block w-full" required autocomplete="tgl_kadaluarsa" />
                <x-input-error class="mt-2" :messages="$errors->get('tgl_kadaluarsa')" />
            </div>

            <div class="w-1/2 my-5">
                <x-input-label for="sisa" :value="__('Jumlah Bahan')" />
                <x-text-input id="sisa" name="sisa" type="text" class="mt-1 block w-full" required autofocus autocomplete="sisa" placeholder="Masukkan Angka"/>
                <x-input-error class="mt-2" :messages="$errors->get('sisa')" />
            </div>

            <img id="preview-nota" src="#" alt="Preview Nota" class="mt-3 hidden max-w-xs" />

            <div class="w-1/2 my-5 relative">
                <x-input-label for="nota" :value="__('Nota')" />
                <input type="file" name="nota" id="nota" accept="image/*"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
                <x-input-error class="mt-2" :messages="$errors->get('nota')" />
            </div>


            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('bahanbaku') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                $('#id_bahan').select2({
                    placeholder: "Cari bahan...",
                    allowClear: true
                });
            });
        </script>
        <script>
            document.querySelector('input[name="nota"]').addEventListener('change', function(e) {
                const [file] = e.target.files;
                if (file) {
                    const preview = document.getElementById('preview-nota');
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                }
            });
        </script>

@endsection
