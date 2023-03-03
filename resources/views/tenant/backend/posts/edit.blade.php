<x-tenapp-layout>

    <x-slot name="title">Chỉnh sửa bài viết</x-slot>

    @vite(['resources/js/my-editor/my-editor.js'])
                    
    <script type="module">
        import MyEditor from 'http://[::1]:5173/resources/js/my-editor/my-editor.js';
        let editor = new MyEditor('myeditor');
        
        editor.setFrame();
        
        const saveBtn = document.getElementById('save-post').addEventListener("click", (e) => {
            editor.save()
        });
    </script>
    {{-- {{ dd($post->categories->first()) }} --}}
    @livewireStyles()
    @livewire('tenant.backend.post-form', ['post' => $post, 'categories' => $categories])
    @livewireScripts()
</x-tenapp-layout>