<x-modal name="import-modal">
    <form
        method="post" action="{{ route('invites.import') }}"
        x-data @submit.prevent="$submit().then(() => location.reload())"
        class="p-8"
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Import Excel
        </h2>

        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            Import your guest list from an excel file. To download a sample excel to guide your excel headings,
            <a href="#" class="underline font-medium text-indigo-600">click here</a>.
        </p>

        <div class="mt-6">
            <x-input-label for="import-file" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input
                class="mt-1 block w-3/4 border"
                id="import-file"
                name="file"
                type="file"
                required
            />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Import') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
