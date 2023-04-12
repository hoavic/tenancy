<header
    x-data="{
        showNav: false
    }"
    @click.outside="showNav = false"
    class="site-header">

    <div class="site-wrapper">
        <div class="site-branding">
            @php
                if(request()->routeIs('home')) {
                    $title_tag = 'h1';
                } else {
                    $title_tag = 'p';
                }
            @endphp
            <{{ $title_tag }} class="site-title">
                <a href="{{ route('home') }}" class="flex gap-2 items-center py-4 px-4 font-bold text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 7H7v6h6V7z"></path>
                        <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd"></path>
                    </svg> 
                    <span>{{ config('app.name') }}</span>
                </a>
            </{{ $title_tag }}>
        </div>

        <button @click="showNav = ! showNav" class="nav-toggle">
            <svg fill="currentColor" width="24" height="24" viewBox="0 0 24 24" class="icon"><path d="M21,8H3V6H21M9,13H21V11H9M9,18H21V16H9"><!----></path></svg>
        </button>

        @include('guest.includes.nav')

    </div>

</header>