<div>
@vite(['resources/js/editor.js'])

<script type="module">
    import EditorJS from 'http://[::1]:5173/resources/js/editor.js';

    EditorJS.callEditor('{{ csrf_token()}}');

const saveBtn = document.getElementById('save-post').addEventListener("click", savePost);    
</script>

                {{-- <script src="{{ global_asset('asset/editor.js') }}"></script> --}}
                <div id="editorjs"></div>
                <a href="#" class="" id="save-post">Save</a>

</div>
