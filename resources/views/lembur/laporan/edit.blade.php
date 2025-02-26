@extends('lembur/layout/lembur')
@section('content_lembur')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Edit Laporan
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Edit your Laporan!!!
        </p>
        <form method="post" action="{{ route('update-laporan',['id' => $data->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <select id="id_karyawan" name="id_karyawan" class="input-field w-1/2" required>
                <option value="" disabled selected hidden>Nama Karyawan</option>
                @foreach ( $karyawan as $k )
                <option value="{{ $k->id }}" {{ $data->id_karyawan == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_karyawan }}
                </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('id_karyawan')" />


            <div class="w-1/2">
                <x-input-label for="hari_lembur" :value="__('Hari Lembur')" />
                <x-text-input id="hari_lembur" name="hari_lembur" type="date" class="mt-1 block w-full" required autocomplete="hari_lembur"
                value="{{ old('hari_lembur', $data->hari_lembur ?? now()->toDateString()) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('hari_lembur')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="jam_kerja" :value="__('Jam kerja/Hari')" />
                <x-text-input id="jam_kerja" name="jam_kerja" type="text" value="{{ $data->jam_kerja }}" class="mt-1 block w-full" required autofocus autocomplete="jam_kerja" placeholder="Ex. 1"/>
                <x-input-error class="mt-2" :messages="$errors->get('jam_kerja')" />
            </div>
            <div class="w-1/2">
                <x-input-label for="jml_makan" :value="__('Jumlah Makan')" />
                <x-text-input id="jml_makan" name="jml_makan" type="text" value="{{ $data->jml_makan }}" class="mt-1 block w-full" required autofocus autocomplete="jml_makan" placeholder="Ex. 1"/>
                <x-input-error class="mt-2" :messages="$errors->get('jml_makan')" />
            </div>


            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('laporan') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
            </div>

@endsection
