@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Edit EOQ
        </h2>
        <form method="post" action="{{ route('update-eoq',['id' => $data->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <x-text-input id="id_bahan" name="id_bahan" type="text" class="mt-1 block w-full hidden" required autocomplete="tgl_masuk" value="{{ $data->id_bahan }}"/>
            <div class="w-1/2">
                <x-input-label for="nama_bahan" :value="__('Nama Bahan')" />
                <x-text-input readonly id="nama_bahan" name="nama_bahan" type="text" class="mt-1 block w-full" required autofocus autocomplete="nama_bahan" placeholder="Masukkan Angka" value=" {{ $data->nama_bahan }}"/>
            </div>

            <div class="w-1/2">
                <x-input-label for="demand" :value="__('Demand')" />
                <x-text-input id="demand" name="demand" type="text" class="mt-1 block w-full" required autofocus autocomplete="demand" placeholder="Masukkan Angka" value=" {{ $data->demand }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('demand')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="biaya_simpan" :value="__('Biaya Simpan')" />
                <x-text-input id="biaya_simpan" name="biaya_simpan" type="text" class="mt-1 block w-full" required autofocus autocomplete="biaya_simpan" placeholder="Masukkan Angka" value=" {{ $data->biaya_simpan }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('biaya_simpan')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="biaya_pesan" :value="__('Biaya Pesan')" />
                <x-text-input id="biaya_pesan" name="biaya_pesan" type="text" class="mt-1 block w-full" required autofocus autocomplete="biaya_pesan" placeholder="Masukkan Angka" value=" {{ $data->biaya_pesan }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('biaya_pesan')" />
            </div>


            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
            </div>
        </form>
@endsection
