<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex gap-2 items-center justify-between pb-4 bg-white dark:bg-gray-900 p-5">
            <div>
                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                    <span class="sr-only">Filter button</span>
                    {{ $this->category ?: 'Everyone' }}
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                        <li>
                            <a
                                href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                wire:click="$set('category', '')"
                            >Everyone</a>
                        </li>

                        @foreach (\App\Models\Invite::distinct()->pluck('category') as $category)
                            <li>
                                <a
                                    href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    wire:click="$set('category', '{{ $category }}')"
                                >{{ $category }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." wire:model.live="search">
            </div>
        </div>

        <div class="overflow-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Passes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Remaining
                    </th>
                    {{--<th scope="col" class="px-6 py-3">
                        Date Created
                    </th>--}}
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($invites as $invite)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api?background=eef6ff&color=3e97ff&name={{ $invite->name }}&format=svg" alt="photo">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $invite->name ?: '-' }}</div>
                                <div class="font-normal text-gray-500">{{ $invite->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center whitespace-nowrap">
                                @if ($invite->category == 'FAMILY')
                                    <span class="bg-amber-100 text-amber-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-amber-900 dark:text-amber-300">{{ $invite->category }}</span>
                                @elseif(in_array($invite->category, ['KRYSTAL', 'VAS2NETS']))
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">{{ $invite->category }}</span>
                                @else
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $invite->category }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $invite->passes }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $invite->remaining }}
                        </td>
                        {{--<td class="px-6 py-4">
                            {{ $invite->created_at->toDayDateTimeString() }}
                        </td>--}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ url()->signedRoute('invites.show', $invite) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Download
                                </a>
                                @if ($invite->email)
                                    <span class="text-gray-200">|</span>
                                    <form action="{{ route('invites.send', $invite) }}" x-data x-submit>
                                        <button class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                            {{ $invite->sent() ? 'Resend' : 'Send' }}
                                        </button>
                                    </form>
                                @endif

                                <span class="text-gray-200">|</span>

                                @can('create-invite')
                                    <a
                                        href="javascript:"
                                        wire:click="edit('{{ $invite->id }}')"
                                        class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline"
                                        data-drawer-target="edit-invite-drawer"
                                        data-drawer-show="edit-invite-drawer"
                                        data-drawer-placement="right"
                                        aria-controls="edit-invite-drawer"
                                    >
                                        Edit
                                    </a>

                                    <span class="text-gray-200">|</span>
                                @endcan

                                <form action="{{ route('invites.destroy', $invite) }}" x-data x-submit data-confirm @finish="location.reload()">
                                    @method('delete')
                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>

    @include('partials.edit-invite-modal')
</div>
