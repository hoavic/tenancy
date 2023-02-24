<x-tenapp-layout>

    <x-slot name="title">Đăng bài viết</x-slot>

    {{-- <div x-data="{ 
        open: false,
        formData: {
            _token: '{{ csrf_token()}}',
            file: '',
        },
        message: '',
        hasFile() {
            
            if( this.file){
                return true
            }
            return false;
        },

    }" 
    
    x-effect="console.log(hasFile());"
    class="relative w-full">

        <p><button class="my-2 py-2 px-4 inline-block border border-blue-600 rounded" @click="open = !open">Thêm Media</button></p>
        <div x-text="message" class="border border-green-600 text-green-600 py-2 px-4 rounded"></div>
        <div x-show="open" @click.outside="open = false" class="fixed border rounded shadow-2xl p-8 bg-white z-10">
            <p class="text-right"><button class="my-2 py-2 px-4 inline-block border border-blue-600 rounded" @click="open = false">Đóng</button></p>
            <form @submit.prevent="submitData()" method="POST" action="{{ route('ten.media.store') }}" class="my-4 flex gap-4" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <input x-model="file" type="file" id="file" name="file" x-on:change()/>
                    <input type="submit" value="Tải lên"
                        :class="hasFile() ? 'bg-blue-600 text-white': ''" 
                        class="py-2 px-4 border rounded"/>
                </div>
            </form>
            <h2>Danh sách Media</h2>
            <div class="grid grid-cols-4 gap-4">

            </div>
        </div>
        <script>
            function submitData() {
                // Ensures all fields have data before submitting
                if (!this.formData._token.length) {
                    alert("Please fill out all required field and try again!");
                    return;
                }
                this.buttonLabel = 'Submitting...'
                this.loading = true;
                fetch('https://reqres.in/api/users', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then((response) => {
                        if(response.status === 201) {
                            this.modalHeaderText = "Congratulations!!!"
                            this.modalBodyText = "You have been successfully registered!";
                            this.status = true;
                        } else{
                            throw new Error ("Your registration failed");
                        }
                    })
                    .catch((error) => {
                        this.modalHeaderText = "Ooops Error!"
                        this.modalBodyText = error.message;
                        this.isError = true;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            }
        </script>
    </div> --}}
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
    @livewire('tenant.backend.post-form')
    @livewireScripts()
</x-tenapp-layout>