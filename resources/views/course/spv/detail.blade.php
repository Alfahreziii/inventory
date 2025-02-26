@extends('course/layout_classroom/course')
@section('content_course')


{{-- Task --}}
<div class="garis mt-10 mb-3">
    <div class="bg-slate-100 pr-3 text-lg font-medium text-slate-600">TASK</div>
</div>
{{-- Open --}}
<div class="w-full bg-white shadow z-30 rounded-xl">
    @if ($initial === 'open')
    <h1 class="w-full border-b-2 border-b-[#ff6384] text-slate-600 text-base font-semibold p-4 text-left flex gap-3">Open <span><i data-feather="bar-chart-2" class="text-[#ff6384] font-bold"></i></span></h1>
    @endif
    @if ($initial === 'assigned')
    <h1 class="w-full border-b-2 border-b-[#36a2eb] text-slate-600 text-base font-semibold p-4 text-left flex gap-3">In Progress <span><i data-feather="bar-chart-2" class="text-[#36a2eb] font-bold"></i></span></h1>
    @endif
    @if ($initial === 'closed')
    <h1 class="w-full border-b-2 border-b-[#ffcd56] text-slate-600 text-base font-semibold p-4 text-left flex gap-3">Closed <span><i data-feather="bar-chart-2" class="text-[#ffcd56] font-bold"></i></span></h1>
    @endif

    <div class="w-full flex overflow-x-auto">
        <table class="w-full whitespace-nowrap ">
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Name</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">TASK</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">DUE</th>

                @if ($initial === 'assigned')
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Give a Score</th>
                @endif

                @if ($initial === 'closed')
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Score</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Edit</th>
                @endif
            </thead>

            @foreach ($data as $d)
            <tr class="">
                @if ($initial === 'assigned' or $initial === 'closed')
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left"><a href="{{ $d->tugas }}">{{ $d->name }}</a></td>
                @else
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $d->name }}</td>
                @endif
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $d->nama_pelajaran }}</td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $d->deadline }}</td>
                @if ($initial === 'assigned')
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">
                    <a href="{{ route('score',['id'=> $d->id_kumpulan]) }}" class="flex justify-center items-center text-sm h-8 font-normal rounded text-white bg-green-500 w-[80%]">Give a Score</a>
                </td>
                @endif

                @if ($initial === 'closed')
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $d->nilai }}</td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left"><a href="{{ route('score',['id'=> $d->id_kumpulan]) }}">Edit Score</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>
{{-- end open --}}
@endsection
