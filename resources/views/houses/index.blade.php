<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data RTLH
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">
                        <a
                            href="{{ route('houses.create') }}"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            + Tambah Rumah
                        </a>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Daftar Rumah
                            </h3>

                            <p class="text-sm text-gray-500">
                                Data Rumah Tidak Layak Huni Kabupaten Cirebon
                            </p>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('houses.index') }}" class="mb-6">
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari kode rumah atau alamat..."
                                class="w-full rounded-md border-gray-300"
                            >

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md"
                            >
                                Cari
                            </button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        No
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Kode Rumah
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Alamat
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Wilayah
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Tahun
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse ($houses as $house)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $houses->firstItem() + $loop->index }}
                                        </td>

                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                            {{ $house->house_code }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $house->address ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $house->region?->name ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $house->survey_year }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            {{ $house->status }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('houses.show', $house) }}"
                                            class="text-blue-600 hover:text-blue-800 font-medium">
                                            Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7  " class="px-4 py-8 text-center text-gray-500">
                                            Belum ada data RTLH.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $houses->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>