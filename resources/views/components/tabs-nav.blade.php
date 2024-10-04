@if (request()->is('dashboard*'))
    <ul
        class="flex flex-wrap text-sm text-center container mt-3 mx-auto font-bold justify-around text-gray-500 border-b border-gray-200">
        <li class="me-2">
            <a href="{{ url('/dashboard/fitura') }}"
                aria-current="{{ request()->is('dashboard/fitura') || request()->is('dashboard') ? 'page' : '' }}"
                class="py-2 px-40 w-fullfont-bold inline-block {{ request()->is('dashboard/fitura') || request()->is('dashboard') ? 'text-gray-700 bg-gray-100 rounded-t-lg active' : 'text-white hover:text-gray-700 hover:bg-gray-50 rounded-t-lg' }}">
                Tipe A
            </a>
        </li>
        <li class="me-2">
            <a href="{{ url('/dashboard/fiturb') }}" aria-current="{{ request()->is('dashboard/fiturb') ? 'page' : '' }}"
                class="py-2 px-40 font-bold inline-block p-4 {{ request()->is('dashboard/fiturb') ? 'text-gray-700 bg-gray-100 rounded-t-lg active' : 'text-white hover:text-gray-700 hover:bg-gray-50 rounded-t-lg' }}">
                Fitur B
            </a>
        </li>
        <li class="me-2">
            <a href="{{ url('/dashboard/fiturc') }}"
                aria-current="{{ request()->is('dashboard/fiturc') ? 'page' : '' }}"
                class="py-2 px-40 ont-bold inline-block p-4 {{ request()->is('dashboard/fiturc') ? 'text-gray-700 bg-gray-100 rounded-t-lg active' : 'text-white hover:text-gray-700 hover:bg-gray-50 rounded-t-lg' }}">
                Fitur C
            </a>
        </li>
    </ul>
@endif
