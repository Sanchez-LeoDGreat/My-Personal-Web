<nav class="text-white bg-slate-950" x-data="{ active: false }">
    <div class="flex justify-between mr-1">
        <a href="{{ route('guest.home') }}" class="w-12 m-1 hover:text-green-500">
            @include('components.logo')
        </a>
        <div class="hidden md:block">
            <ul class="flex h-full gap-2 list-none">
                @if ($navItems)
                    @foreach ($navItems as $item)
                        <a href="{{ $item->route }}"
                            class="flex justify-center h-full px-2 border-b-4 place-items-center {{ $item->active ? 'border-green-500 hover:border-blue-500' : 'border-transparent hover:border-white' }}">
                            <li>{{ $item->name }}</li>
                        </a>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="block md:hidden">
            <button @click="active = !active" class="h-full text-3xl material-symbols-outlined"
                :class="active ? 'text-green-500' : ''">
                menu
            </button>
        </div>
    </div>
    <div class="block md:hidden" x-show="active" x-transition>
        <hr>
        @if ($navItems)
            <ul class="text-center list-none">
                @foreach ($navItems as $item)
                    <a href="{{ $item->route }}"
                        class="{{ $item->active ? 'font-medium text-green-500' : 'hover:font-medium' }}">
                        <li class="hover:bg-slate-600">{{ $item->name }}</li>
                    </a>
                @endforeach
            </ul>
        @endif
    </div>
</nav>
