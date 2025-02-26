@extends('lembur/layout/lembur')
@section('content_lembur')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Tambah Karyawan
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Create a task for your cluster!!
        </p>
        <form method="post" action="{{ route('tambah-karyawan') }}" class="mt-6 space-y-6">
            @csrf
            <div class="w-1/2">
                <x-input-label for="nama_karyawan" :value="__('Nama Karyawan')" />
                <x-text-input id="nama_karyawan" name="nama_karyawan" type="text" class="mt-1 block w-full" required autofocus autocomplete="nama_karyawan" />
                <x-input-error class="mt-2" :messages="$errors->get('nama_karyawan')" />
            </div>

            <select id="kategori_karyawan" name="kategori_karyawan" class="input-field w-1/2" required autocomplete="background">
                <option disabled selected hidden>Kategori Karyawan</option>
                @foreach ( $data as $d )
                <option value="{{ $d->id }}" class="select">{{ $d->nama_kategori }}</option>
                @endforeach
            </select>

            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('karyawan') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
            </div>

@endsection
