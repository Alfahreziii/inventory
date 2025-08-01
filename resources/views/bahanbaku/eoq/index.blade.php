@extends('bahanbaku/layout/bahanbaku')
@section('content_bahanbaku')
<h1 class="font-bold text-[#035233] text-3xl">EOQ</h1>
<div class="flex  text-sm font-normal items-center mt-1">
    <a href="#" class="text-[#035233]">home</a>
    <i data-feather="chevron-right" class="text-[#035233] font-bold"></i>
    <a href="#" class="text-[#035233]">Eoq</a>
</div>

{{-- Task --}}
<div class="garis mt-10 mb-3">
    <div class=" pr-3 text-lg font-medium text-[#035233]">EOQ</div>
</div>

<!-- Tombol Cetak -->
<button
  onclick="openModal()"
  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
>
  Cetak PDF
</button>

<!-- Modal -->
<!-- Modal -->
<div
  id="modalCetak"
  class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center hidden"
>
  <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Cetak PDF</h2>
      <button onclick="closeModal()" class="text-gray-600 hover:text-red-500 text-2xl">&times;</button>
    </div>
    <form action="{{ route('eoq.cetak') }}" method="GET" target="_blank">
      <!-- Tambahkan Deskripsi -->
      <div class="mb-4">
        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Cetak</button>
      </div>
    </form>
  </div>
</div>

@can('admin-access')
<a href="{{ route('buat-eoq') }}" class="ml-auto shadow flex mb-5 mt-3 justify-center items-center text-sm py-3 font-semibold rounded text-white bg-[#035233]">
    <i data-feather="plus" width="24px" height="24px" class="mr-1"></i> TAMBAH EOQ
</a>
@endcan

<div class="relative overflow-x-auto overflow-y-hidden scrollbar-hide pb-5">
    <table class="w-full text-sm text-left rtl:text-right text-[#035233] dark:text-[#035233] data-table shadow-md">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-[#035233]">
        <tr>
            <th class="px-6 py-3" scope="col">Code Bahan Baku</th>
            <th class="px-6 py-3" scope="col">Nama Bahan Baku</th>
            <th class="py-3" scope="col">EOQ</th>
            <th class="py-3" scope="col">Frekuensi Pembelian</th>
            <th class="py-3" scope="col">TIC</th>
            <th class="py-3" scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script>
  function openModal() {
    document.getElementById('modalCetak').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modalCetak').classList.add('hidden');
  }
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('table_eoq') }}",
        columns: [
            { data: 'code_barang', name: 'code_barang' },
            { data: 'nama_bahan', name: 'nama_bahan' },
            { data: 'nilai_eoq', name: 'nilai_eoq' },
            { data: 'frekuensi_pembelian', name: 'frekuensi_pembelian' },
            { data: 'nilai_tic', name: 'nilai_tic' },
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

    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('delete-eoq', '') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                        title: "Terhapus!",
                        text: "Data berhasil dihapus.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        location.reload(); // RELOAD SETELAH OK DITEKAN
                    });
                    },
                    error: function() {
                        Swal.fire("Oops!", "Terjadi kesalahan saat menghapus.", "error");
                    }
                });
            }
        });
    });
});
</script>
@endsection
