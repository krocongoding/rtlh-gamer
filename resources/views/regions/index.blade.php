<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">
                Master Wilayah
            </h2>

            <a
                href="{{ route('regions.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
            >
                + Tambah Wilayah
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    No
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Kode
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nama Wilayah
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Tipe
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Level
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse ($regions as $region)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $regions->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        {{ $region->code }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $region->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $region->type }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $region->level }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $region->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="6"
                                        class="px-4 py-8 text-center text-gray-500"
                                    >
                                        Belum ada data wilayah.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $regions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>