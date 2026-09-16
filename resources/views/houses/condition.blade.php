<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kondisi Fisik Rumah
            </h2>

            <a
                href="{{ route('houses.show', $house) }}"
                class="px-4 py-2 text-sm text-gray-700 hover:text-gray-900"
            >
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-6 rounded-md bg-red-50 p-4">
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $house->house_code }}
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $house->address ?? 'Alamat belum diisi' }}
                </p>
            </div>

            <form
                method="POST"
                action="{{ route('houses.condition.update', $house) }}"
            >
                @csrf
                @method('PUT')

                {{-- STRUKTUR --}}
                <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        1. Struktur Rumah
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Pondasi
                            </label>

                            <input
                                type="text"
                                name="foundation"
                                value="{{ old('foundation', $house->structure?->foundation) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                                placeholder="Contoh: Batu kali"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Sloof
                            </label>

                            <select
                                name="sloof_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'sloof_condition_id',
                                            $house->structure?->sloof_condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Kolom
                            </label>

                            <select
                                name="column_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'column_condition_id',
                                            $house->structure?->column_condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Balok
                            </label>

                            <select
                                name="beam_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'beam_condition_id',
                                            $house->structure?->beam_condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                {{-- LANTAI --}}
                <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        2. Lantai
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Bahan Lantai
                            </label>

                            <select
                                name="floor_material_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Bahan --</option>

                                @foreach ($floorMaterials as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'floor_material_id',
                                            $house->floor?->material_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Lantai
                            </label>

                            <select
                                name="floor_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'floor_condition_id',
                                            $house->floor?->condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                {{-- DINDING --}}
                <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        3. Dinding
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Bahan Dinding
                            </label>

                            <select
                                name="wall_material_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Bahan --</option>

                                @foreach ($wallMaterials as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'wall_material_id',
                                            $house->wall?->material_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Dinding
                            </label>

                            <select
                                name="wall_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'wall_condition_id',
                                            $house->wall?->condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                {{-- ATAP --}}
                <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        4. Atap
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Rangka
                            </label>

                            <select
                                name="roof_frame_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'roof_frame_condition_id',
                                            $house->roof?->frame_condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Bahan Atap
                            </label>

                            <select
                                name="roof_material_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Bahan --</option>

                                @foreach ($roofMaterials as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'roof_material_id',
                                            $house->roof?->material_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kondisi Atap
                            </label>

                            <select
                                name="roof_condition_id"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">-- Pilih Kondisi --</option>

                                @foreach ($conditions as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old(
                                            'roof_condition_id',
                                            $house->roof?->condition_id
                                        ) == $item->id)
                                    >
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="flex items-center justify-end gap-3">
                    <a
                        href="{{ route('houses.show', $house) }}"
                        class="px-4 py-2 text-sm text-gray-700"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                    >
                        Simpan Kondisi
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>