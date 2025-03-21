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
        <form method="post" action="{{ route('update-bahanbaku',['id' => $data->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <label for="id_bahan" class="block text-sm font-medium text-gray-700">Nama Bahan</label>
            <select id="id_bahan" name="id_bahan" class="w-1/2 select2" required>
                <option value="" disabled selected hidden>Cari bahan...</option>
                @foreach ($namabahan as $d)
                    {{-- <option value="{{ $d->id }}">{{ $d->nama_bahan }}</option> --}}
                    <option value="{{ $d->id }}" {{ $data->id == $d->id ? 'selected' : '' }}>
                        {{ $d->nama_bahan }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('id_bahan')" />


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
                <x-input-label for="harga" :value="__('Harga')" />
                <x-text-input id="harga" name="harga" type="text" class="mt-1 block w-full" required autofocus autocomplete="harga" placeholder="Masukkan Angka" value=" {{ $data->harga }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('harga')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="sisa" :value="__('Jumlah Bahan')" />
                <x-text-input id="sisa" name="sisa" type="text" class="mt-1 block w-full" required autofocus autocomplete="sisa" placeholder="Masukkan Angka" value=" {{ $data->sisa }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('sisa')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="demand" :value="__('Demand')" />
                <x-text-input id="demand" name="demand" type="text" class="mt-1 block w-full" required autofocus autocomplete="demand" placeholder="Masukkan Angka" value=" {{ $data->demand }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('demand')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="nilai_x" :value="__('Nilai X')" />
                <x-text-input id="nilai_x" name="nilai_x" type="text" class="mt-1 block w-full" required autofocus autocomplete="nilai_x" placeholder="Masukkan Angka" value=" {{ $data->nilai_x }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('nilai_x')" />
            </div>


            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('dashboard') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
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
