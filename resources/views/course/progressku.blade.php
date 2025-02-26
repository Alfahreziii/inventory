@extends('course/layout_classroom/course')
@section('content_course')



<h1 class="font-bold text-slate-600 text-3xl">MyProgress</h1>
<div class="flex  text-sm font-normal items-center mt-1">
    <a href="#" class="text-slate-500">Home</a>
    <i data-feather="chevron-right" class="text-gray-400 font-bold"></i>
    <a href="#" class="text-slate-400">MyProgress</a>
</div>

{{-- Overview --}}
<div class="garis mt-5 mb-3">
    <div class="bg-slate-100 pr-3 text-lg font-medium text-slate-600">OVERVIEW</div>
</div>
<div class="grid grid-cols-3 gap-5 max-[1250px]:grid-cols-2 max-[650px]:grid-cols-1">
    <div class="p-4 bg-white shadow rounded-xl">
        <h1 class="font-medium ">My Cluster 👩‍🎓</h1>
        <hr class="my-3 -mx-3">
        <div class="px-3">
            <div class="garis justify-center mt-5 mb-2">
                <div class="bg-white px-3 text-base font-medium text-slate-600 text-center">SPV</div>
            </div>
            <div class="flex gap-2 items-center mb-1">
                @if(isset($spv))
                <img class="rounded-full aspect-square object-center object-cover w-9" src="{{ asset('storage/photo-profile/'.$spv->foto) }}" alt="">
                <div class="">
                    <h1 class="font-medium text-sm ml-2">{{ $spv->name }}</h1>
                </div>
                @endif
            </div>
            <div class="garis justify-center">
                <div class="bg-white px-3 text-base font-medium text-slate-600 text-center">Anggota</div>
            </div>
            @foreach ($student as $stu)
            <div class="flex gap-2 items-center mb-3">
                <img class="rounded-full aspect-square object-center object-cover w-9" src="{{ asset('storage/photo-profile/'.$stu->foto) }}" alt="">
                <div class="">
                    <h1 class="font-medium text-sm ml-2">{{ $stu->name }}</h1>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('student') }}" class="hover:text-slate-600 flex item-center text-sm font-medium text-slate-500">More...</a>
    </div>
    <div class="p-4 bg-white shadow rounded-xl">
        <h1 class="font-medium ">
            @if (Auth::user()->status === 'spv' or Auth::user()->status === 'admin')
            Cluster Task 📘
            @else
            My Task 📘
            @endif
        </h1>
        <hr class="my-3 -mx-3">
        <div class="flex flex-wrap justify-center items-center">
            <div class="w-[16rem]">
                <canvas id="myChart">
                </canvas>
            </div>
        </div>
    </div>
    <div class="p-4 bg-white shadow rounded-xl">
        <h1 class="font-medium mb-1">Leaderboard 🏆</h1>
        <hr class="my-3 -mx-3">
        <div class="px-3">
            <?php $no = 1; ?>
            @foreach ($leaderboard as $l)
            <div class="flex gap-2 items-center mb-3">
                <img class="rounded-full aspect-square object-center object-cover w-10" src="{{ asset('storage/photo-profile/'.$l->foto) }}" alt="">
                <div class="">
                    <h1 class="font-bold text-sm">{{ $l->name }}</h1>
                    <p class="text-slate-500 text-xs">{{ $l->nama_kelas }}</p>
                </div>
                <h1 class="ml-auto font-semibold text-slate-600 text-2xl">{{ $no++ }}</h1>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- End Overview --}}

{{-- Task --}}
<div class="garis mt-10 mb-3">
    <div class="bg-slate-100 pr-3 text-lg font-medium text-slate-600">TASK</div>
</div>
{{-- Open --}}
<div class="w-full bg-white shadow z-30 rounded-xl px-3 pb-3 overflow-auto">
    <h1 class="w-full border-b-2 border-b-[#ff6384] text-slate-600 text-base font-semibold p-4 text-left flex gap-3 mb-3">
        Open <span><i data-feather="bar-chart-2" class="text-[#ff6384] font-bold"></i></span>
    </h1>
    <table class="w-full whitespace-nowrap data-table bg-white">
        <thead class="border-b-2 border-slate-300 w-full overflow-x-auto">
            @if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
            <tr>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Name</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-center">Total Task</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-right">Detail</th>
            </tr>
            @endif

            @if (Auth::User()->status === 'student')
            <tr>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">TASK</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">DUE</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">ASSIGNED TO</th>
            </tr>
            @endif

            @foreach ($open as $o)

            @if (Auth::User()->status === 'student')
            <tr class="">
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left"><a href="{{ route('detail-task', ['id'=> $o->id_pelajaran]) }}">{{ $o->nama_pelajaran }}</a></td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $o->deadline }}</td>
                @if(isset($spv))
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $spv->name }}</td>
                @endif
            </tr>
            @endif

            @endforeach
        </thead>
        <tbody class="w-full">
            <!-- DataTables will populate this area -->
        </tbody>
    </table>
</div>


{{-- end open --}}

{{-- progress --}}
<div class="w-full bg-white shadow z-30 rounded-xl mt-5 px-3 pb-3 overflow-auto">
    <h1 class="w-full mb-3 border-b-2 border-b-[#36a2eb] text-slate-600 text-base font-semibold p-4 text-left flex gap-3">In Progress <span><i data-feather="bar-chart-2" class="text-[#36a2eb] font-bold"></i></span></h1>
        <table class="w-full whitespace-nowrap data-table-assigned ">
            @if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Name</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-center">Total Task</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-right">Detail</th>
            </thead>
            @endif

            @if (Auth::User()->status === 'student')
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">TASK</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">DUE</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">CHECKED BY</th>
            </thead>
            @endif

            @foreach ($assigned as $a)
            @if (Auth::User()->status === 'student')
            <tr class="border-t border-slate-300">
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left"><a href="{{ route('detail-task', ['id'=> $a->id_pelajaran]) }}">{{ $a->nama_pelajaran }}</a></td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $a->deadline }}</td>
                @if(isset($spv))
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $spv->name }}</td>
                @endif
            </tr>
            @endif

            @endforeach
        </table>
</div>
{{-- end progress --}}

{{-- closed --}}
<div class="w-full bg-white shadow z-30 rounded-xl mt-5 mb-5 px-3 pb-3">
    <h1 class="w-full mb-3 border-b-2 border-b-[#ffcd56] text-slate-600 text-base font-semibold p-4 text-left flex gap-3">Closed <span><i data-feather="bar-chart-2" class="text-[#ffcd56] font-bold"></i></span></h1>
        <table class="w-full whitespace-nowrap data-table-closed">
            @if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">Name</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-center">Total Task</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-right">Detail</th>
            </thead>
            @endif

            @if (Auth::User()->status === 'student')
            <thead class="border-b-2 border-slate-300">
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">TASK</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">DUE</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">ASSESSED BY</th>
                <th class="text-slate-600 text-base w-[11rem] font-semibold py-2 px-6 text-left">MARK</th>
            </thead>
            @endif

            @foreach ($closed as $c)
            @if (Auth::User()->status === 'student')
            <tr class="border-t border-slate-300">
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left"><a href="{{ route('detail-task', ['id'=> $c->id_pelajaran]) }}">{{ $c->nama_pelajaran }}</a></td>
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $c->deadline }}</td>
                @if(isset($spv))
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $spv->name }}</td>
                @endif
                <td class="text-sm font-normal text-slate-600 py-3 px-6 text-left">{{ $c->nilai }}</td>
            </tr>
            @endif

            @endforeach
        </table>
</div>
{{-- end closed --}}


{{-- End Task --}}




  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if(isset($chart))
<script>
    const ctx = document.getElementById('myChart');
    var chartData = <?php echo json_encode($chart); ?>;
    console.log(chartData);
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: chartData.label,
        datasets: [{
            labels: chartData.label,
            data: chartData.data,
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4,
        }]
      },
    });
  </script>
@endif


  <script type="text/javascript">
    var detailRoute = "{{ route('detail-open', ['id' => ':id']) }}";

    $(document).ready(function() {
    $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get-open') }}", // Replace with the correct route
        columns: [
            @if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
            { data: 'name', name: 'name' },
            { "className": "text-center", data: 'total_pelajaran', name: 'total_pelajaran' },
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
@if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
    var detailAssigned = "{{ route('detail-assigned', ['id' => ':id']) }}";
    $(document).ready(function() {
    $('.data-table-assigned').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get-assigned') }}", // Replace with the correct route
        columns: [

            { data: 'name', name: 'name' },
            { "className": "text-center", data: 'total_pelajaran', name: 'total_pelajaran' },
            {
                "className": "text-right",
                data: 'id',
                render: function(data, type, row) {
                    // Replace ':id' with the actual row ID
                    var detailUrl = detailAssigned.replace(':id', data);
                    return '<a class="text-sm font-normal ml-auto text-right text-slate-700" href="' + detailUrl + '">Detail</a>';
                },
                orderable: false,
                searchable: false
            }

        ]
    });
});
@endif
var detailClosed = "{{ route('detail-closed', ['id' => ':id']) }}";
    $(document).ready(function() {
    $('.data-table-closed').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get-closed') }}", // Replace with the correct route
        columns: [
            @if (Auth::User()->status === 'spv' or Auth::user()->status === 'admin')
            { data: 'name', name: 'name' },
            { "className": "text-center", data: 'total_pelajaran', name: 'total_pelajaran' },
            {
                "className": "text-right",
                data: 'id',
                render: function(data, type, row) {
                    // Replace ':id' with the actual row ID
                    var detailUrl = detailClosed.replace(':id', data);
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
