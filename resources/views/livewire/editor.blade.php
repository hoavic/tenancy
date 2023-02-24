<div>
@vite(['resources/js/my-editor/my-editor.js'])

<script type="module">
    import MyEditor from 'http://[::1]:5173/resources/js/my-editor/my-editor.js';
let editor = new MyEditor('myeditor');
editor.setFrame();

const saveBtn = document.getElementById('save-post').addEventListener("click", (e) => {
    editor.save()
});

/* const saveBtn = document.getElementById('save-post').addEventListener("click", savePost);   */  

</script>
                {{-- <script src="{{ global_asset('asset/editor.js') }}"></script> --}}
                <div id="myeditor"></div>
                <a href="#" class="" id="save-post">Save</a>
</div>
