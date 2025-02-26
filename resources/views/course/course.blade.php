@extends('course/layout_classroom/course')
@section('content_course')
                    {{-- Jumbotron --}}
                    <div class="w-full mb-6 wrap7">
                        <div class="p-6 max-[750px]:p-0 bg-gradient-to-r from-cyan-300 to-violet-900 shadow z-30 rounded-lg full7 hilang-margin7">
                            <div class="wrapper-jumb">
                                <div class="flex px-4 py-3">
                                    <div class="py-4 max-[550px]:py-1 w-[70%]">
                                        <div class="relative h-full">
                                            <div class="">
                                                <h1 class="text-white font-bold text-3xl max-[550px]:text-lg max-[400px]:text-sm max-[650px]:text-2xl tracking-wide min-[1150px]:text-5xl">Ayo Selesaikan Tugasmu!</h1>
                                                <p class="text-white text-sm max-[400px]:text-[10px] max-[550px]:text-xs max-[650px]:text-sm max-[650px]:w-[85%] w-[50%] tracking-wide min-[1150px]:text-xl min-[1150px]:mt-2">Deadline tugasmu semakin dekat segera selesaika tugasmu.</p>
                                                <a href="{{ route('tugasku') }}" class="absolute bottom-0 text-white font-bold max-[400px]:text-sm max-[650px]:text-base text-xl min-[1150px]:text-2xl"><span class="flex justify-center items-center">Lihat Tugas<i data-feather="arrow-right-circle" class="text-white ml-2"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-[30%]">
                                        <img src="{{ asset('assets/img/jumb.png') }}" alt="" class="min-[1150px]:w-[80%]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end jumbotron --}}

@endsection
