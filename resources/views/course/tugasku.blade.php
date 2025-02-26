@extends('course/layout_classroom/course')
@section('content_course')

<h1 class="font-bold text-slate-600 text-3xl">MyTask</h1>
<div class="flex  text-sm font-normal items-center mt-1">
    <a href="#" class="text-slate-500">Home</a>
    <i data-feather="chevron-right" class="text-gray-400 font-bold"></i>
    <a href="#" class="text-slate-400">MyTask</a>
</div>

{{-- Task --}}
<div class="garis mt-10 mb-3">
    <div class="bg-slate-100 pr-3 text-lg font-medium text-slate-600">TASK</div>
</div>
@if (Auth::user()->status === "spv" or Auth::user()->status === "admin")
<a href="{{ route('create-course') }}" class="ml-auto shadow flex mb-5 mt-3 justify-center items-center text-sm py-3 font-semibold rounded text-white bg-green-500 w-32">
    <i data-feather="plus" width="24px" height="24px" class="mr-1"></i> ADD TASK
</a>
@endif

<div class="w-full mb-6 wrap7">
    <div class="flex gap-7">
        <div class="w-full">
            <div class="grid grid-cols-3 max-[550px]:grid-cols-1 max-[650px]:grid-cols-2  gap-3 mt-2">
                @foreach ($data as $d)
                    <div class="">
                        <div class="px-3 py-2 rounded-t-lg" style="background: {{ $d->background }}">
                            <a href="{{ route('detail-task', ['id'=> $d->id_pelajaran]) }}" class="font-bold text-base text-white cursor-pointer">{{ $d->nama_pelajaran }}</a>
                            <p class="text-white text-sm font-light">{{ $d->name }}</p>
                        </div>
                        <div class="bg-white px-3 py-4 rounded-b-lg flex items-center">
                            <p class="text-slate-700 text-sm font-[450]">Deadline : {{ $d->deadline }}</p>
                            @if (Auth::user()->status === "spv" or Auth::user()->status === "admin")
                            <a href="{{ route('edit-course',['id'=> $d->id_pelajaran]) }}" class="flex ml-auto justify-center items-center text-xs py-1 font-medium rounded text-white bg-green-500 w-16">
                                <i data-feather="edit-2" width="18px" height="18px" class="mr-1"></i> Edit
                            </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- end task --}}
@endsection
