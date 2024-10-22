<x-filament-panels::page>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="bg-white p-4 dark:bg-gray-900">
            <label class="sr-only" for="table-search">Search</label>
            <form class="relative" wire:submit="search">
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
                @forelse ($items as $item)
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white" scope="row">{{ $item['title'] }}</th>
                        <td class="px-6 py-4">Tk. {{ number_format($item['price'], 2) }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item['date'])->format('Y-m-d h:i A') }}</td>
                        <td class="px-6 py-4">
                            <x-filament::button href="{{ route('filament.user.pages.commodities-show', ['item' => $item['title']]) }}" icon="heroicon-m-eye" size="xs" tag="a">View</x-filament::button>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <th class="text-danger-500 dark:text-danger-500 whitespace-nowrap px-6 py-4 text-center font-medium" colspan="10" scope="row">No items found</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
