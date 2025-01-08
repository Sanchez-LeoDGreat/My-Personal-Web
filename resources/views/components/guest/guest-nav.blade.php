<nav class="fixed top-0 left-0 w-full text-white bg-slate-950" x-data="{ active: false }">
    <div class="flex justify-between mr-1">
        <a href="{{ route('guest.home') }}" class="w-12 m-1 hover:text-green-500">
            @include('components.logo')
        </a>
        <div class="hidden md:block">
            <ul class="flex h-full gap-2 list-none">
                @if ($navItems)
                    @foreach ($navItems as $item)
                        <a href="{{ $item->route }}"
                            class="flex justify-center h-full px-2 border-b-4 place-items-center hover:border-white {{ $item->active ? 'border-green-500' : 'border-transparent' }}">
                            <li class="flex justify-center gap-1 place-items-center">
                                <span class="material-symbols-outlined">
                                    {{ $item->icon }}
                                </span>
                                <span>{{ $item->name }}</span>
                            </li>
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
                        <li class="flex justify-center py-0.5 hover:bg-slate-600 place-items-center">
                            <span class="mr-1 material-symbols-outlined">
                                {{ $item->icon }}
                            </span>
                            <span>{{ $item->name }}</span>
                        </li>
                    </a>
                @endforeach
            </ul>
        @endif
    </div>
</nav>
