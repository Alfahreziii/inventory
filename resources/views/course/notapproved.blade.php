@if (Auth::user()->validate !== 'approved')
@extends('course/layout_classroom/course')
@section('content_course')
                    {{-- Jumbotron --}}
                    <div class="w-full mb-6 wrap7">
                        <div class="p-6 bg-gradient-to-r from-cyan-300 to-violet-900 shadow z-30 rounded-lg full7 hilang-margin7">
                            <div class="wrapper-jumb">
                                <div class="flex px-4 py-3">
                                    <div class="py-4 w-[70%]">
                                        <div class="relative h-full">
                                            <div class="">
                                                <h1 class="text-white font-bold text-3xl tracking-wide min-[1150px]:text-5xl">Akunmu sedang diperiksa oleh SPV</h1>
                                                @if(isset($spv))
                                                <p class="text-white text-sm w-[70%] tracking-wide min-[1150px]:text-base min-[1150px]:mt-2">Harap tunggu agar akunmu terverifikasi oleh SPV. Harap hubungi SPV di bawah jika akunmu belum kunjung di verifikasi</p>
                                                <a href="https://wa.me/{{ $spv->no_hp }}" class="absolute bottom-0 text-white font-bold text-xl min-[1150px]:text-2xl"><span class="flex justify-center items-center">Hubungi SPV<i data-feather="arrow-right-circle" class="text-white ml-2"></i></span></a>
                                                @endif
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

@endsection
@else
<script type="text/javascript">
     window.location.href = "{{ route('classroom') }}";
</script>
@endif

