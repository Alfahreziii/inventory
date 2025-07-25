@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Detail EOQ
        </h2>
        <div class="mt-6 gap-5 grid grid-cols-2">
            <div class="w-full">
                <x-input-label for="nama_bahan" :value="__('Nama Bahan')" />
                <x-text-input  readonly id="nama_bahan" name="nama_bahan" type="text" class="mt-1 block w-full" required autofocus autocomplete="nama_bahan" value="{{ $data->nama_bahan }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('nama_bahan')" />
            </div>

            <div class="w-full">
                <x-input-label for="tgl_masuk" :value="__('Tanggal Masuk')" />
                <x-text-input  readonly id="tgl_masuk" name="tgl_masuk" type="date" class="mt-1 block w-full" required autocomplete="tgl_masuk" value="{{ \Carbon\Carbon::parse($data->tgl_masuk)->format('Y-m-d') }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('tgl_masuk')" />
            </div>
            <div class="w-full">
                <x-input-label for="tgl_kadaluarsa" :value="__('Tanggal Kadaluarsa')" />
                <x-text-input  readonly id="tgl_kadaluarsa" name="tgl_kadaluarsa" type="date" class="mt-1 block w-full" required autocomplete="tgl_kadaluarsa" value="{{ \Carbon\Carbon::parse($data->tgl_kadaluarsa)->format('Y-m-d') }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('tgl_kadaluarsa')" />
            </div>

            <div class="w-full">
                <x-input-label for="harga" :value="__('Harga')" />
                <x-text-input  readonly id="harga" name="harga" type="text" class="mt-1 block w-full" required autofocus autocomplete="harga" placeholder="Masukkan Angka" value=" {{ $data->harga }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('harga')" />
            </div>

            <div class="w-full">
                <x-input-label for="sisa" :value="__('Jumlah Bahan')" />
                <x-text-input  readonly id="sisa" name="sisa" type="text" class="mt-1 block w-full" required autofocus autocomplete="sisa" placeholder="Masukkan Angka" value=" {{ $data->sisa }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('sisa')" />
            </div>
            <div class="w-full">
                <x-input-label for="harga_total" :value="__('Harga Total')" />
                <x-text-input  readonly id="harga_total" name="harga_total" type="text" class="mt-1 block w-full" required autofocus autocomplete="harga_total" placeholder="Masukkan Angka" value=" {{ $data->harga_total }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('harga_total')" />
            </div>
            @if(!empty($data->nota))
                <div class="mt-4">
                    <label class="block font-semibold">Nota:</label>
                    <img src="{{ asset('storage/' . $data->nota) }}" alt="Nota" style="max-width: 300px;">
                </div>
            @endif


        </div>
        <div class="flex items-start gap-4 w-1/2">
            <a href="{{ route('edit-bahanbaku', ['id' => $data->id]) }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">Edit</a>
        </div>

@endsection
