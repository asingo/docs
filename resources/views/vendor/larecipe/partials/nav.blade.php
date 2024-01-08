
<div class="fixed pin-t pin-x z-40">
    <div class="bg-gradient-primary text-white h-1"></div>

    <nav class="flex items-center justify-between text-black bg-navbar shadow-xs h-16">
        <div class="flex items-center flex-no-shrink">
            <a href="{{ url('/') }}" class="flex items-center flex-no-shrink text-black mx-4">
                <img src="/img/grapiku-docs.png" width="120px">
            </a>

            <div class="switch">
                <input type="checkbox" name="1" id="1" v-model="sidebar" class="switch-checkbox" />
                <label class="switch-label" for="1"></label>
            </div>
        </div>

        <div class="block mx-4 flex items-center">
            <a href="{{route('downloadPdf')}}" class="py-2 px-4 text-white bg-primary rounded-lg inline-flex"><i class="fa fa-download mr-2"> </i> Download PDF</a>
            @if(config('larecipe.search.enabled'))
            <larecipe-button id="search-button" :type="searchBox ? 'primary' : 'link'" @click="searchBox = ! searchBox" class="px-4">
                <i class="fas fa-search" id="search-button-icon"></i>
            </larecipe-button>
            @endif

            @auth
            {{-- account --}}
            <larecipe-dropdown>
                <larecipe-button type="white" class="ml-2">
                    {{ auth()->user()->name ?? 'Account' }} <i class="fa fa-angle-down"></i>
                </larecipe-button>

                <template slot="list">

                    <a href="{{route('actionlogout')}}"><button type="submit" class="py-2 px-4 text-white bg-danger inline-flex"><i class="fa fa-power-off mr-2"></i> Logout</button></a>

                </template>
            </larecipe-dropdown>
            {{-- /account --}}
            @endauth
        </div>
    </nav>
</div>
