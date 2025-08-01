@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')
<h1 class="font-bold text-[#035233] text-3xl">ROLE</h1>
<div class="flex  text-sm font-normal items-center mt-1">
    <a href="#" class="text-[#035233]">home</a>
    <i data-feather="chevron-right" class="text-[#035233] font-bold"></i>
    <a href="#" class="text-[#035233]">Role</a>
</div>

{{-- Task --}}
<div class="garis mt-10 mb-3">
    <div class=" pr-3 text-lg font-medium text-[#035233]">ROLE</div>
</div>

<div class="relative overflow-x-auto overflow-y-hidden scrollbar-hide pb-5">
    <table class="w-full text-sm text-left rtl:text-right text-[#035233] dark:text-[#035233] data-table shadow-md">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-[#035233]">
        <tr>
            <th class="px-6 py-3" scope="col">Nama</th>
            <th class="px-6 py-3" scope="col">Email</th>
            <th class="py-3" scope="col">Status</th>
            <th class="py-3" scope="col">Aksi</th>
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
        ajax: "{{ route('table_role') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        dom: '<"flex justify-between items-center mb-4"<"w-full flex justify-start space-x-4"f l>>rt<"flex justify-between items-center mt-4"ip>',
        language: {
            lengthMenu: "",
            search: "", // Hapus tulisan "Search"
            searchPlaceholder: "Search", // Tambahkan placeholder
            lengthMenu: "Tampilkan _MENU_ data"  // Ganti "Show _MENU_ entries"
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
                .addClass('border text-sm border-gray-300 px-3 py-2 rounded-md bg-white hover:bg-gray-300 text-[#035233] cursor-pointer mx-1 transition duration-200');

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
                $(this).addClass('bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600'); // Styling tambahan
            });
            $('.data-table tbody td:nth-child(1)').each(function() {
                $(this).addClass('px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white');
            });
            $('.data-table tbody td:nth-child(2)').each(function() {
                $(this).addClass('px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white');
            });
            $('.data-table tbody td:nth-child(4)').each(function() {
                $(this).addClass('flex py-4');
            });
            $('.data-table tbody td:nth-child(6) .detail').each(function() {
                $(this).addClass('text-blue-500');
            });
            $('.data-table tbody td:nth-child(6) button').each(function() {
                $(this).addClass('text-red-500');
            });
        }
    });
});
</script>
@endsection
