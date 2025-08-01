@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Edit ROLE
        </h2>
        <form method="post" action="{{ route('update-role',['id' => $data->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <x-text-input id="id" name="id" type="text" class="mt-1 block w-full hidden" required autocomplete="tgl_masuk" value="{{ $data->id }}"/>

            <div class="w-1/2">
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" readonly required autofocus autocomplete="name" placeholder="Masukkan Nama" value="{{ $data->name }}"/>
            </div>

            <div class="w-1/2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" readonly required autofocus autocomplete="email" placeholder="Masukkan Email" value="{{ $data->email }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="status" :value="__('Status')" />
                <select id="status" name="status" class="mt-1 block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="spv" {{ $data->status === 'spv' ? 'selected' : '' }}>SPV</option>
                    <option value="admin" {{ $data->status === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
            </div>
        </form>
    </div>
</div>

@endsection
