<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Data RTLH
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-6 rounded-md bg-red-50 p-4">
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('houses.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Wilayah --}}
                        <div class="md:col-span-2">
                            <label for="region_id"
                                class="block text-sm font-medium text-gray-700">
                                Wilayah *
                            </label>

                            <select
                                name="region_id"
                                id="region_id"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="">
                                    -- Pilih Desa/Kelurahan --
                                </option>

                                @foreach ($villages as $village)
                                    <option
                                        value="{{ $village->id }}"
                                        @selected(old('region_id') == $village->id)
                                    >
                                        {{ $village->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('region_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Kode Rumah --}}
                        <div>
                            <label for="house_code"
                                class="block text-sm font-medium text-gray-700">
                                Kode Rumah *
                            </label>

                            <input
                                type="text"
                                name="house_code"
                                id="house_code"
                                value="{{ old('house_code') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('house_code')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Tahun Survey --}}
                        <div>
                            <label for="survey_year"
                                class="block text-sm font-medium text-gray-700">
                                Tahun Survey *
                            </label>

                            <input
                                type="number"
                                name="survey_year"
                                id="survey_year"
                                value="{{ old('survey_year', 2026) }}"
                                min="2000"
                                max="2100"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('survey_year')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <label for="address"
                                class="block text-sm font-medium text-gray-700">
                                Alamat
                            </label>

                            <textarea
                                name="address"
                                id="address"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >{{ old('address') }}</textarea>

                            @error('address')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Blok --}}
                        <div>
                            <label for="block"
                                class="block text-sm font-medium text-gray-700">
                                Blok
                            </label>

                            <input
                                type="text"
                                name="block"
                                id="block"
                                value="{{ old('block') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- RT --}}
                        <div>
                            <label for="rt"
                                class="block text-sm font-medium text-gray-700">
                                RT
                            </label>

                            <input
                                type="text"
                                name="rt"
                                id="rt"
                                value="{{ old('rt') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- RW --}}
                        <div>
                            <label for="rw"
                                class="block text-sm font-medium text-gray-700">
                                RW
                            </label>

                            <input
                                type="text"
                                name="rw"
                                id="rw"
                                value="{{ old('rw') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- Luas --}}
                        <div>
                            <label for="area_m2"
                                class="block text-sm font-medium text-gray-700">
                                Luas Rumah (m²)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="area_m2"
                                id="area_m2"
                                value="{{ old('area_m2') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- Penghuni --}}
                        <div>
                            <label for="occupant_count"
                                class="block text-sm font-medium text-gray-700">
                                Jumlah Penghuni
                            </label>

                            <input
                                type="number"
                                min="0"
                                name="occupant_count"
                                id="occupant_count"
                                value="{{ old('occupant_count') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- KK --}}
                        <div>
                            <label for="household_count"
                                class="block text-sm font-medium text-gray-700">
                                Jumlah KK
                            </label>

                            <input
                                type="number"
                                min="0"
                                name="household_count"
                                id="household_count"
                                value="{{ old('household_count', 1) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="mt-6 flex items-center justify-end gap-3">

                        <a
                            href="{{ route('houses.index') }}"
                            class="px-4 py-2 text-sm text-gray-700"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            Simpan Data
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>