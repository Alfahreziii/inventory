@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Edit Bahan Baku
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Create a task for your cluster!!
        </p>
<form method="post" action="{{ route('update-bahanbaku',['id' => $data->id]) }}" enctype="multipart/form-data" class="mt-6 space-y-6">

            @csrf
            @method('PUT')
            <x-text-input id="id_bahan" name="id_bahan" type="text" class="mt-1 block w-full hidden" required autocomplete="tgl_masuk" value="{{ $data->id_bahan }}"/>
            <div class="w-1/2">
                <x-input-label for="nama_bahan" :value="__('Nama Bahan')" />
                <x-text-input readonly id="nama_bahan" name="nama_bahan" type="text" class="mt-1 block w-full" required autofocus autocomplete="nama_bahan" placeholder="Masukkan Angka" value=" {{ $data->nama_bahan }}"/>
            </div>
            <div class="w-1/2">
                <x-input-label for="tgl_masuk" :value="__('Tanggal Masuk')" />
                <x-text-input id="tgl_masuk" name="tgl_masuk" type="date" class="mt-1 block w-full" required autocomplete="tgl_masuk" value="{{ \Carbon\Carbon::parse($data->tgl_masuk)->format('Y-m-d') }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('tgl_masuk')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="tgl_kadaluarsa" :value="__('Tanggal Kadaluarsa')" />
                <x-text-input id="tgl_kadaluarsa" name="tgl_kadaluarsa" type="date" class="mt-1 block w-full" required autocomplete="tgl_kadaluarsa" value="{{ \Carbon\Carbon::parse($data->tgl_kadaluarsa)->format('Y-m-d') }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('tgl_kadaluarsa')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="sisa" :value="__('Jumlah Bahan')" />
                <x-text-input id="sisa" name="sisa" type="text" class="mt-1 block w-full" required autofocus autocomplete="sisa" placeholder="Masukkan Angka" value=" {{ $data->sisa }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('sisa')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="nota" :value="__('Nota')" />
                <input id="nota" name="nota" type="file" accept="image/*" onchange="previewNota()" class="mt-1 block w-full border rounded-md" />

                @if ($data->nota)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-1">Nota saat ini:</p>
                        <img src="{{ asset('storage/' . $data->nota) }}" alt="Nota Bahan Baku" class="w-64 border rounded shadow-md">
                    </div>
                @endif

                <x-input-label for="nota" :value="__('Nota setelah di update :')" class="mt-10"/>
                <img id="previewImage" src="#" alt="Preview Nota" class="mt-4 max-w-xs rounded shadow hidden">


            </div>

            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
            </div>
        </form>
        <script>
    function previewNota() {
        const input = document.getElementById('nota');
        const preview = document.getElementById('previewImage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
