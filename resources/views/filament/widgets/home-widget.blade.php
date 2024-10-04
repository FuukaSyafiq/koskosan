@php
    $user = filament()->auth()->user();
    $roleId = auth()->user()->role_id;
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3 w-full">
            <x-filament-panels::avatar.user size="lg" :user="$user" />

            <div class="flex-1">
                <h2 class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ filament()->getUserName($user) }}
                </p>
            </div>

            {{-- <form action="{{ filament()->getLogoutUrl() }}" method="post" class="my-auto">
                @csrf

                <x-filament::button color="gray" icon="heroicon-m-arrow-left-on-rectangle"
                    icon-alias="panels::widgets.account.logout-button" labeled-from="sm" tag="button" type="submit">
                    {{ __('filament-panels::widgets/account-widget.actions.logout.label') }}
                </x-filament::button>
            </form> --}}

            <a href="/">
                <x-filament::button color="gray" labeled-from="sm" tag="button" type="button">
                    kembali ke beranda
                </x-filament::button>
            </a>
            @if ($roleId == \App\Models\Role::getIdByRole("ADMIN"))
                    <a href="{{ url("/dashboard/permissionManager/pmrole")}}">
                        <x-filament::button color="gray" labeled-from="sm" tag="button" type="button">
                            Permission manager
                        </x-filament::button>
                    </a>
                </div>
            @endif

    </x-filament::section>
</x-filament-widgets::widget>