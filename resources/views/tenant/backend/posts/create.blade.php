<x-tenapp-layout>

    <x-slot name="title">Đăng bài viết</x-slot>

    @vite(['resources/js/my-editor/my-editor.js'])
                    
    <script type="module">
            import MyEditor from 'http://[::1]:5173/resources/js/my-editor/my-editor.js';
        let editor = new MyEditor('myeditor');
        editor.setFrame();
        
        const saveBtn = document.getElementById('save-post').addEventListener("click", (e) => {
            editor.save()
        });
    </script>
    
    @livewireStyles()
    @livewire('tenant.backend.post-form', ['categories' => $categories,])
    @livewireScripts()
</x-tenapp-layout>