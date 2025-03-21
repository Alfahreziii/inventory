@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')
<h1 class="font-bold text-slate-600 text-3xl">RIWAYAT LOGIN</h1>
<div class="flex  text-sm font-normal items-center mt-1">
    <a href="#" class="text-slate-500">home</a>
    <i data-feather="chevron-right" class="text-gray-400 font-bold"></i>
    <a href="#" class="text-slate-400">Riwayat Login</a>
</div>

{{-- Task --}}
<div class="garis mt-10 mb-3">
    <div class="bg-slate-100 pr-3 text-lg font-medium text-slate-600">RIWAYAT LOGIN</div>
</div>

<div class="relative overflow-x-auto overflow-y-hidden scrollbar-hide pb-5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 data-table shadow-md">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-6 py-3" scope="col">Nama</th>
                <th class="py-3" scope="col">Email</th>
                <th class="py-3" scope="col">Status</th>
                <th class="py-3" scope="col">Terakhir Login</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>



<script type="text/javascript">
$(document).ready(function() {
    $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('table_riwayatlogin') }}",
        ordering: true, // Pastikan fitur sorting aktif
        columns: [
            { data: 'name', name: 'name', orderable: false },
            { data: 'email', name: 'email', orderable: false },
            { data: 'status', name: 'status', orderable: false },
            { data: 'last_login_at', name: 'last_login_at', orderable: true } // Sorting hanya di kolom ini
        ],
        dom: '<"flex justify-between items-center mb-4"<"w-full flex justify-start space-x-4"f l>>rt<"flex justify-between items-center mt-4"ip>',
        language: {
            lengthMenu: "Tampilkan _MENU_ data",
            search: "",
            searchPlaceholder: "Search"
        },
        drawCallback: function() {
            // Styling untuk search box
            $('.dataTables_filter input')
                .addClass('block pt-2 ps-3 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500');

            // Styling untuk dropdown jumlah entri
            $('.dataTables_length select')
                .addClass('w-16 border border-gray-300 rounded-md px-2 py-1 text-sm');

            // Styling untuk pagination
            $('.dataTables_paginate .paginate_button')
                .addClass('border text-sm border-gray-300 px-3 py-2 rounded-md bg-white hover:bg-gray-300 text-gray-500 cursor-pointer mx-1 transition duration-200');

            // Styling tombol pagination aktif
            $('.dataTables_paginate .paginate_button.current')
                .addClass('bg-blue-500 text-gray-300 font-semibold text-sm');

            // Styling info jumlah data
            $('.dataTables_info')
                .addClass('text-gray-600 text-sm');

            $('.dataTables_length label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();

            $('.data-table tbody tr').each(function() {
                $(this).addClass('bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600');
            });

            $('.data-table tbody td:nth-child(1)').each(function() {
                $(this).addClass('px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white');
            });

            $('.data-table tbody td:nth-child(3)').each(function() {
                $(this).addClass('flex py-4');
            });
        }
    });

    // Tambahkan ikon sorting hanya di kolom last_login_at dengan cursor pointer
    $('table.dataTable thead th').each(function(index) {
        if (index === 3) { // Indeks kolom last_login_at
            $(this).css({
                'position': 'relative',
                'cursor': 'pointer' // Tambahkan cursor pointer
            }).append('<span class="sorting-icon" style="position:absolute; right:10px; opacity:0.5;">▼</span>');
        }
    });

    // Perbarui ikon sorting saat tabel diperbarui
    $('.data-table').on('draw.dt', function() {
        $('table.dataTable thead th:eq(3) .sorting-icon').html('▼'); // Default descending
        $('table.dataTable thead th:eq(3).sorting_asc .sorting-icon').html('▲'); // Ascending
        $('table.dataTable thead th:eq(3).sorting_desc .sorting-icon').html('▼'); // Descending
    });

    // Hover effect untuk ikon sorting
    $('table.dataTable thead th:eq(3)').hover(
        function() {
            $(this).find('.sorting-icon').css('opacity', '1');
        },
        function() {
            $(this).find('.sorting-icon').css('opacity', '0.5');
        }
    );
});
</script>
@endsection
