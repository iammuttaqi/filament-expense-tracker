<x-filament-panels::page>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="bg-white p-4 dark:bg-gray-900">
            <label class="sr-only" for="table-search">Search</label>
            <form class="relative" wire:submit="search">
                {{-- <input class="block w-80 rounded-lg border border-gray-300 bg-gray-50 ps-10 pt-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" id="table-search" placeholder="Search for items" type="search" wire:model="query"> --}}
                <x-filament::input.wrapper class="max-w-fit">
                    <x-filament::input placeholder="Search for items" type="text" type="search" wire:model="query" />
                </x-filament::input.wrapper>
            </form>
        </div>

        <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3" scope="col">Item</th>
                    <th class="px-6 py-3" scope="col">Latest Price</th>
                    <th class="px-6 py-3" scope="col">Date</th>
                    <th class="px-6 py-3" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">{{ $item['title'] }}</th>
                        <td class="px-6 py-4">Tk. {{ number_format($item['price'], 2) }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item['date'])->format('Y-m-d h:i A') }}</td>
                        <td class="px-6 py-4">
                            <x-filament::button href="{{ route('filament.user.pages.commodities-show') }}" icon="heroicon-m-eye" size="xs" tag="a" target="_blank">View</x-filament::button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
