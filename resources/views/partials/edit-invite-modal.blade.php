<div id="edit-invite-drawer"
     class="fixed top-0 right-0 z-40 h-screen p-10 overflow-y-auto transition-transform translate-x-full bg-white w-full sm:w-[500px] dark:bg-gray-800"
     tabindex="-1"
     wire:ignore.self
>
    <button type="button" data-drawer-hide="edit-invite-drawer" aria-controls="edit-invite-drawer"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>

    <h5 id="drawer-right-label"
        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
        Update Invite
    </h5>

    <form
        wire:submit="update"
        @invite-updated.window="ensureNotifyIsAvailable(); notify.success('Invite updated.');"
        class="my-6"
    >
        <div class="mb-6">
            <input name="name"
                   class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Name" aria-label="name" required
                   wire:model="form.name"
            >
        </div>

        <div class="mb-6">
            <input name="email" type="email"
                   class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Email Address (optional)" aria-label="email"
                   wire:model="form.email"
            >
        </div>

        <div class="mb-6">
            <select name="category"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required aria-label="category"
                    wire:model="form.category"
            >
                <option>VIP</option>
                <option>VVIP</option>
                <option>After Party</option>
            </select>
        </div>

        <div class="mb-6">
            <input name="passes" type="number"
                   class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="How many passes?" aria-label="passes" required
                   wire:model="form.passes"
            >
        </div>

        <div class="flex">
            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Save
            </button>
        </div>
    </form>
</div>
