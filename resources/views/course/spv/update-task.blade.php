@extends('course/layout_classroom/course')
@section('content_course')

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
    <div class="w-full">
        <div class="flex">
            <div class="w-1/2">
                <h2 class="text-lg font-medium text-gray-900">
                    Edit Task
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Edit a task for your cluster!!
                </p>
            </div>
            <form class="flex w-1/2 ml-auto" method="post" action="{{ route('delete-task', ['id' => $data->id_pelajaran]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-700 w-1/2 ml-auto">DELETE !!</button>
            </form>
        </div>
        <form method="post" action="{{ route('update-course',['id' => $data->id_pelajaran]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <div class="w-1/2">
                <x-input-label for="nama_pelajaran" :value="__('Tittle')" />
                <x-text-input id="nama_pelajaran" name="nama_pelajaran" type="text" class="mt-1 block w-full" required autofocus autocomplete="nama_pelajaran" value="{{ $data->nama_pelajaran }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('nama_pelajaran')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="deadline" :value="__('Deadline')" />
                <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full" required autocomplete="deadline" value="{{ $data->deadline }}"/>
                <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
            </div>



            <div class="w-1/2">
                <x-input-label for="background" :value="__('Background')" />
                {{-- <x-text-input id="background" name="background" type="text" class="mt-1 block w-full" required autocomplete="background" /> --}}
                <select id="background" name="background" class="mt-1 block w-full" required autocomplete="background">
                    <option selected="selected" hidden value="{{ $data->background }}"></option>
                    <option value="#fde047" class="text-white bg-yellow-300 font-semibold">Yellow</option>
                    <option value="#7dd3fc" class="text-white bg-sky-300 font-semibold">Blue</option>
                    <option value="#d8b4fe" class="text-white bg-purple-300 font-semibold">Purple</option>
                    <option value="#f87171" class="text-white bg-red-400 font-semibold">Red</option>
                  </select>
                <x-input-error class="mt-2" :messages="$errors->get('background')" />
            </div>

            <div>
                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                <textarea class="rounded w-full" id="default" name="deskripsi" type="textarea" class="mt-1 block w-full" required autocomplete="deskripsi"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
            </div>

            <div class="flex w-full">
                <div class="flex items-start gap-4 w-1/2">
                    <input type="submit" value="Submit" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-gradient-to-r from-cyan-300 to-violet-950 w-[75%]">
                    <a href="{{ route('tugasku') }}" class="flex mt-3 justify-center items-center text-lg py-1 font-semibold rounded text-white bg-red-500 w-1/2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    tinymce.init({
        selector: 'textarea#default', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        setup: function (editor) {
                editor.on('change', function () {
                    editor.save(); // Ensure that the content is saved to the textarea
                });
                editor.on('init', () => {
                    let rawContent = @json($data->deskripsi);
                    let cleanedContent = cleanHTML(rawContent);
                    editor.setContent(cleanedContent);
                    editor.save();
                });
            }
    });

    function cleanHTML(html) {
        // Remove all <p> tags
        html = html.replace(/<\/?p[^>]*>/g, '<br>');
        // Remove &nbsp; entities
        html = html.replace(/&nbsp;/g, ' ');
        return html;
    }
    </script>
@endsection


