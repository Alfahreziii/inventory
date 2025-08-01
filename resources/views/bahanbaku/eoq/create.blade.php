@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Tambah EOQ
        </h2>
        <form method="post" action="{{ route('tambah-eoq') }}" class="mt-6">
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
                <x-input-label for="demand" :value="__('Demand')" />
                <x-text-input id="demand" name="demand" type="text" class="mt-1 block w-full" required autofocus autocomplete="demand" placeholder="Masukkan Angka"/>
                <x-input-error class="mt-2" :messages="$errors->get('demand')" />
            </div>

            <div class="w-1/2 my-5">
                <x-input-label for="biaya_simpan" :value="__('Biaya Simpan')" />
                <x-text-input id="biaya_simpan" name="biaya_simpan" type="text" class="mt-1 block w-full" required autofocus autocomplete="biaya_simpan" placeholder="Masukkan Angka"/>
                <x-input-error class="mt-2" :messages="$errors->get('biaya_simpan')" />
            </div>

            <div class="w-1/2 my-5">
                <x-input-label for="biaya_pesan" :value="__('Biaya Pesan')" />
                <x-text-input id="biaya_pesan" name="biaya_pesan" type="text" class="mt-1 block w-full" required autofocus autocomplete="biaya_pesan" placeholder="Masukkan Angka"/>
                <x-input-error class="mt-2" :messages="$errors->get('biaya_pesan')" />
            </div>

            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('eoq') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
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

@endsection
