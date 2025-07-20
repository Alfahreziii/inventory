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
                <x-input-label for="demand" :value="__('Demand')" />
                <x-text-input  readonly id="demand" name="demand" type="text" class="mt-1 block w-full" required autofocus autocomplete="demand" placeholder="Masukkan Angka" value=" {{ $data->demand }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('demand')" />
            </div>

            <div class="w-full">
                <x-input-label for="biaya_pesan" :value="__('Biaya Pesan')" />
                <x-text-input  readonly id="biaya_pesan" name="biaya_pesan" type="text" class="mt-1 block w-full" required autofocus autocomplete="biaya_pesan" placeholder="Masukkan Angka" value=" {{ $data->biaya_pesan }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('biaya_pesan')" />
            </div>
            <div class="w-full">
                <x-input-label for="biaya_simpan" :value="__('Biaya Simpan')" />
                <x-text-input  readonly id="biaya_simpan" name="biaya_simpan" type="text" class="mt-1 block w-full" required autofocus autocomplete="biaya_simpan" placeholder="Masukkan Angka" value=" {{ $data->biaya_simpan }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('biaya_simpan')" />
            </div>


        </div>
        <div class="flex items-start gap-4 w-1/2">
            <a href="{{ route('edit-eoq', ['id' => $data->id]) }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">Edit</a>
        </div>

@endsection
