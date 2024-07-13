<div id="create-user-drawer"
     class="fixed top-0 right-0 z-40 h-screen p-10 overflow-y-auto transition-transform translate-x-full bg-white w-full sm:w-[500px] dark:bg-gray-800"
     tabindex="-1"
>
    <button type="button" data-drawer-hide="create-user-drawer" aria-controls="create-user-drawer"
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
        New Invite
    </h5>

    <form
        action="{{ route('invites.store') }}"
        x-data="{ email: '' }" x-submit @finish="location.reload()"
        class="my-6"
    >
        <div class="mb-6">
            <input
                name="name"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Name" aria-label="name" required
            >
        </div>

        <div class="mb-6">
            <input
                name="email" type="email"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Email Address (optional)" aria-label="email" x-model="email"
            >
        </div>

        <div class="mb-6">
            <select
                name="category"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required aria-label="category"
            >
                @foreach (['VIP', 'VVIP'] as $category)
                    <option>{{ $category }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <input
                name="passes" type="number"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="How many passes?" aria-label="passes" required
                value="1" min="1"
            >
        </div>

        <div class="flex mb-6" x-show="email" x-transition>
            <div class="flex items-center h-5">
                <input id="send" name="send" aria-describedby="send-text" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
            </div>
            <div class="ml-2 text-sm">
                <label for="send" class="font-medium text-gray-900 dark:text-gray-300">
                    Automatically send invite
                </label>
                <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">
                    Immediately sends email with the invite containing their QR code.
                </p>
            </div>
        </div>

        <div class="flex">
            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Create Invite
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
