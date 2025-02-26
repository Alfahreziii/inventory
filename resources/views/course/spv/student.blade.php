@extends('course/layout_classroom/course')
@section('content_course')

<h1 class="font-bold text-slate-600 text-3xl">Student</h1>
<div class="flex  text-sm font-normal items-center mt-1 mb-5">
    <a href="#" class="text-slate-500">Home</a>
    <i data-feather="chevron-right" class="text-gray-400 font-bold"></i>
    <a href="#" class="text-slate-400">Student</a>
</div>

<div class="w-full bg-white shadow z-30 rounded-xl mb-5">
    <h1 class="w-full border-b-2 border-b-sky-500 text-slate-600 text-base font-semibold p-4 text-left flex gap-3">SPV <span><i data-feather="users" class="text-sky-500 font-bold"></i></span></h1>
    <div class="w-full flex overflow-x-auto">
        <table class="w-full whitespace-nowrap ">
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Name</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Cluster</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">NIM</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-center">Contact</th>
            </thead>
            @foreach ($spv as $s)
            <tr class="">
                <td class="text-sm font-normal text-slate-600 py-1 px-6 text-left ">
                    <div class="w-full flex items-center">
                        <img class="w-[45px] shadow rounded-full aspect-square object-center object-cover mr-3" src="{{ asset('storage/photo-profile/'.$s->foto) }}" alt="">
                        <h1>{{ $s->name }}</h1>
                    </div>
                </td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $s->nama_kelas }}</td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $s->nim }}</td>
                <td class="text-sm font-normal text-slate-600 py-2 px-6 text-center">
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $s->no_hp) }}" class="flex justify-center items-center text-sm h-8 font-normal rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-full mx-auto">
                    Hubungi
                </a></td>
            </tr>
            @endforeach

        </table>
    </div>
</div>

<div class="w-full bg-white shadow z-30 rounded-xl">
    <h1 class="w-full border-b-2 border-b-violet-800 text-slate-600 text-base font-semibold p-4 text-left flex gap-3">Student <span><i data-feather="users" class="text-violet-800 font-bold"></i></span></h1>
    <div class="w-full flex overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Name</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Cluster</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">NIM</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-center">Contact</th>
                @if (Auth::user()->status === 'spv')
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-center">Validate</th>
                @endif
            </thead>
            @foreach ($data as $d)
            <tr class="">
                <td class="text-sm font-normal text-slate-600 py-1 px-6 text-left ">
                    <div class="w-full flex items-center">
                        <img class="w-[45px] shadow rounded-full aspect-square object-center object-cover mr-3" src="{{ asset('storage/photo-profile/'.$d->foto) }}" alt="">
                        <h1>{{ $d->name }}</h1>
                    </div>
                </td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left"> {{ $d->nama_kelas }}</td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $d->nim }}</td>
                <td class="text-sm font-normal text-slate-600 py-2 px-6 text-center">
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $d->no_hp) }}" class="flex justify-center items-center text-sm h-8 font-normal rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-full mx-auto">
                    Hubungi
                </a></td>
                @if (Auth::user()->status === 'spv' or Auth::user()->status === 'admin')
                    @if ($d->validate === 'approved')
                    <td class="text-sm font-normal text-slate-600 py-2 px-6 text-center">
                        <a href="{{ route('student-check',['id'=> $d->id]) }}" class="flex justify-center items-center text-sm h-8 font-normal rounded text-white bg-green-500 w-[80%] mx-auto">
                        Approved
                    </a></td>
                    @else
                    <td class="text-sm font-normal text-slate-600 py-2 px-6 text-center">
                        <a href="{{ route('student-check',['id'=> $d->id]) }}" class="flex justify-center items-center text-sm h-8 font-normal rounded text-white bg-green-500 w-[80%] mx-auto">
                        Check
                    </a></td>
                    @endif
                @endif
            </tr>
            @endforeach

        </table>
    </div>
</div>

<script>
    var detailRoute = "{{ route('student-check', ['id' => ':id']) }}";

    $(document).ready(function() {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('get-student') }}", // Replace with the correct route
            columns: [
                @if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
                { data: 'name_and_photo', name: 'name_and_photo', orderable: false, searchable: false }, // Gabungan foto dan nama
                { "className": "text-center", data: 'nama_kelas', name: 'nama_kelas' },
                { "className": "text-center", data: 'nim', name: 'nim' },
                { data: 'wa_link', name: 'wa_link', orderable: false, searchable: false },
                {
                    "className": "text-right",
                    data: 'id',
                    render: function(data, type, row) {
                        // Replace ':id' with the actual row ID
                        var detailUrl = detailRoute.replace(':id', data);
                        return '<a class="text-sm font-normal ml-auto text-right text-slate-700" href="' + detailUrl + '">Detail</a>';
                    },
                    orderable: false,
                    searchable: false
                }
                @endif
            ]
        });
    });
</script>
@endsection


