@extends('course/layout_classroom/course')
@section('content_course')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Validate The Student
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Validate a Student From Your cluster!!
        </p>

        <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Delete Account') }}</x-danger-button>

        <form method="post" action="{{ route('student-validate',['id' => $data->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            {{-- mulai --}}
            <img class="shadow rounded-full aspect-square object-center object-cover w-56" src="{{ asset('storage/photo-profile/'.$data->foto) }}" alt="">

            <div class="w-1/2">
                <x-input-label for="nama" :value="__('Name')" />
                <x-text-input class="mt-1 block w-full" readonly disabled type="text" value="{{ $data->name }}" required/>
            </div>

            <div class="w-1/2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input class="mt-1 block w-full" readonly disabled type="email" value="{{ $data->email }}" required/>
            </div>

            <div class="w-1/2">
                <x-input-label for="NIM" :value="__('NIM')" />
                <x-text-input class="mt-1 block w-full" readonly disabled type="text"  value="{{ $data->nim }}" required/>
            </div>

            <div class="w-1/2">
                <x-input-label for="no_hp" :value="__('Phone Number')" />
                <x-text-input class="mt-1 block w-full" readonly disabled type="text" value="{{ $data->no_hp }}" required/>
            </div>

            <div class="w-1/2">
                <x-input-label for="background" :value="__('Validate The Student')" />
                {{-- <x-text-input id="background" name="background" type="text" class="mt-1 block w-full" required autocomplete="background" /> --}}
                <select id="background" name="validate" class="mt-1 block w-full" required autocomplete="background">
                    @if ($data->validate === 'approved')
                    <option selected="selected" class="font-semibold" value="approved">Approved</option>
                    <option class="font-semibold" value="not_approved">Not Approved</option>
                    @else
                    <option selected="selected" class="font-semibold" value="not_approved">Not Approved</option>
                    <option value="approved" class="font-semibold">Approved</option>
                    @endif
                  </select>
            </div>

            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('student') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form  method="post" action="{{ route('student-delete',['id' => $data->id]) }}" class="p-6">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this account?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once this account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
                <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        {{-- <button type="submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-700 w-1/2 ml-auto">DELETE ACCOUNT!!</button> --}}
    </form>
</x-modal>
<script src="//unpkg.com/alpinejs" defer></script>
@endsection


