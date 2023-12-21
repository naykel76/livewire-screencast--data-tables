<div>
    <div class="flex flex-col divide-y divide-gray-100 w-128">
        <button class="flex items-center px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
            <div class="text-gray-500">
                <x-icon.chevron-left />
            </div>
        </button>

        <div class="flex flex-col px-3 pt-3 pb-2 gap-4">
            <span class="font-semibold text-gray-800">Is between:</span>

            <div class="flex justify-between items-center gap-2">
                <input type="date" class="text-gray-700 rounded border border-gray-300 bg-white px-2 py-1">

                <span class="text-sm text-gray-700">and</span>

                <input type="date" class="text-gray-700 rounded border border-gray-300 bg-white px-2 py-1">
            </div>

            @if ($errors->any())
                <div>
                    <div class="text-sm text-red-600">{{ $errors->first('filters.start') }}</div>
                    <div class="text-sm text-red-600">{{ $errors->first('filters.end') }}</div>
                </div>
            @endif

            <div class="flex">
                <button type="button" class="w-full flex justify-center items-center gap-2 rounded-lg border border-blue-600 px-3 py-1.5 bg-blue-500 font-medium text-sm text-white hover:bg-blue-600">
                    Apply
                </button>
            </div>
        </div>
    </div>
</div>
