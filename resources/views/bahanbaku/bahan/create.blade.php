@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Tambah Nama Bahan
        </h2>
        
        <form method="post" action="{{ route('tambah-namabahan') }}" class="mt-6 space-y-6">
            @csrf
            <div class="w-1/2">
                <x-input-label for="nama_bahan" :value="__('Nama Bahan')" />
                <x-text-input id="nama_bahan" name="nama_bahan" type="text" class="mt-1 block w-full" required autofocus autocomplete="nama_bahan"/>
                <x-input-error class="mt-2" :messages="$errors->get('nama_bahan')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="suplier" :value="__('Suplier')" />
                <x-text-input id="suplier" name="suplier" type="text" class="mt-1 block w-full" required autofocus autocomplete="suplier"/>
                <x-input-error class="mt-2" :messages="$errors->get('suplier')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="no_hp_suplier" :value="__('No HP Suplier')" />
                <x-text-input id="no_hp_suplier" name="no_hp_suplier" type="text" class="mt-1 block w-full" required autofocus autocomplete="no_hp_suplier"/>
                <x-input-error class="mt-2" :messages="$errors->get('no_hp_suplier')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="alamat_suplier" :value="__('Alamat Suplier')" />
                <x-text-input id="alamat_suplier" name="alamat_suplier" type="text" class="mt-1 block w-full" required autofocus autocomplete="alamat_suplier"/>
                <x-input-error class="mt-2" :messages="$errors->get('alamat_suplier')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="harga" :value="__('Harga')" />
                <x-text-input id="harga" name="harga" type="text" class="mt-1 block w-full" required autofocus autocomplete="harga" placeholder="Masukkan Angka"/>
                <x-input-error class="mt-2" :messages="$errors->get('harga')" />
            </div>

            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('namabahan') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
            </div>
        </form>

@endsection
