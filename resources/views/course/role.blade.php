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
        <form method="post" action="{{ route('role-validate',['id' => $data->id]) }}" class="mt-6 space-y-6">
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
                <x-input-label for="background" :value="__('Validate The Role')" />
                {{-- <x-text-input id="background" name="background" type="text" class="mt-1 block w-full" required autocomplete="background" /> --}}
                <select id="background" name="status" class="mt-1 block w-full" required autocomplete="background">
                    @if ($data->status === 'student')
                    <option selected="selected" class="font-semibold" value="student">Student</option>
                    <option class="font-semibold" value="spv">SPV</option>
                    <option value="admin" class="font-semibold">Admin</option>
                    @endif

                    @if ($data->status === 'spv')
                    <option selected="selected" class="font-semibold" value="spv">SPV</option>
                    <option value="student" class="font-semibold">Student</option>
                    <option value="admin" class="font-semibold">Admin</option>
                    @endif

                    @if ($data->status === 'admin')
                    <option selected="selected" class="font-semibold" value="admin">Admin</option>
                    <option value="student" class="font-semibold">Student</option>
                    <option value="spv" class="font-semibold">SPV</option>
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
@endsection


