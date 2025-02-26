@extends('course/layout_classroom/course')
@section('content_course')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <h2 class="text-lg font-medium text-gray-900">
            Ayoo Kumpulkan Tugasmu !!
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Jangan sampai terlewat deadline yaa!!
        </p>
        <form method="post" action="{{ route('score-store',['id' => $data->id_kumpulan]) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            {{-- mulai --}}
            <div class="w-1/2">
                <x-input-label for="nama" :value="__('Nama Pelajaran')" />
                <x-text-input class="mt-1 block w-full" readonly disabled type="text" value="{{ $data->nama_pelajaran }}" required/>
            </div>

            <div class="w-full">
                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                <div class="rounded w-full border h-max border-slate-300 p-3 shadow-sm" readonly disabled id="deskripsi"></div>
            </div>

            <div class="w-1/2">
                <x-input-label for="deadline" :value="__('Deadline')" />
                <x-text-input class="mt-1 block w-full" readonly disabled type="text"  value="{{ $data->deadline }}" required/>
            </div>

            <div class="w-1/2">
                <x-input-label for="tugas" :value="__('Tugas Yang Dikumpulkan')" />
                <div class="rounded w-full border h-max border-slate-300 p-3 shadow-sm" readonly><a href="{{ $data->tugas }}">{{ $data->tugas }}</a></div>
            </div>

            @if ($data->nilai)
            <div class="w-1/2">
                <x-input-label for="tugas" :value="__('Penilaian')" />
                <x-text-input class="mt-1 block w-full" name="nilai" type="text" value="{{ $data->nilai }}" placeholder="Berikan Nilai (1-100)" required/>
                <x-input-error class="mt-2" :messages="$errors->get('nilai')" />
            </div>
            @else
            <div class="w-1/2">
                <x-input-label for="tugas" :value="__('Penilaian')" />
                <x-text-input class="mt-1 block w-full" name="nilai" type="text" placeholder="Berikan Nilai (1-100)" required/>
                <x-input-error class="mt-2" :messages="$errors->get('nilai')" />
            </div>
            @endif


            <input type="text" name="status" hidden value="closed">


            <div class="flex items-start gap-4 w-1/2">
                <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                <a href="{{ route('detail-assigned',['id'=> $data->id_user]) }}')" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
        let rawContent = @json($data->deskripsi);
        let cleanedContent = cleanHTML(rawContent);
        document.getElementById('deskripsi').innerHTML = cleanedContent;

        function cleanHTML(html) {
        // Remove all <p> tags
        html = html.replace(/<\/?p[^>]*>/g, '<br>');
        // Remove &nbsp; entities
        html = html.replace(/&nbsp;/g, ' ');
        return html;
    }
</script>
@endsection
