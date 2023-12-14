<div class="flex flex-col gap-8">
    <div class="grid grid-cols-2 gap-2">
        <div class="relative text-sm text-gray-800">
            <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>

            <input wire:model.live="search" type="text" placeholder="Search email, order #, or amount" class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>

        <div class="flex gap-2 justify-end">
            <div class="flex">
                <button type="button" class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white font-medium text-sm text-gray-700 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" />
                        <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                    </svg>

                    Export
                </button>
            </div>
        </div>
    </div>

    <div>
        <div class="relative animate-pulse">
            <div class="p-3">
                <div class="w-full bg-gray-100 rounded-lg">&nbsp;</div>
            </div>

            <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    @foreach (range(0, 9) as $i)
                        <tr>
                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="w-full bg-gray-200 rounded-lg">&nbsp;</div>
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm" colspan="2">
                                <div class="w-full bg-gray-200 rounded-lg">&nbsp;</div>
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm" colspan="3">
                                <div class="w-full bg-gray-200 rounded-lg">&nbsp;</div>
                            </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="w-full bg-gray-200 rounded-lg">&nbsp;</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
