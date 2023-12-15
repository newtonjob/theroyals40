<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Invites
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-right mb-4 mr-5 sm:mr-0">
                <button type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        data-drawer-target="create-user-drawer" data-drawer-show="create-user-drawer"
                        data-drawer-placement="right" aria-controls="create-user-drawer"
                >
                    New Invite
                </button>
            </div>

            <livewire:invite-index />
        </div>
    </div>

    @include('partials.create-invite-modal')
</x-app-layout>
