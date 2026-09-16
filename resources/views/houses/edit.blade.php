<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data RTLH
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

                <form
                    method="POST"
                    action="{{ route('houses.update', $house) }}"
                >
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Wilayah --}}
                        <div class="md:col-span-2">
                            <label
                                for="region_id"
                                class="block text-sm font-medium text-gray-700"
                            >
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
                                        @selected(
                                            old('region_id', $house->region_id)
                                            == $village->id
                                        )
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
                            <label class="block text-sm font-medium text-gray-700">
                                Kode Rumah *
                            </label>

                            <input
                                type="text"
                                name="house_code"
                                value="{{ old('house_code', $house->house_code) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- Tahun Survey --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Tahun Survey *
                            </label>

                            <input
                                type="number"
                                name="survey_year"
                                value="{{ old('survey_year', $house->survey_year) }}"
                                min="2000"
                                max="2100"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Alamat
                            </label>

                            <textarea
                                name="address"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >{{ old('address', $house->address) }}</textarea>
                        </div>


                        {{-- Blok --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Blok
                            </label>

                            <input
                                type="text"
                                name="block"
                                value="{{ old('block', $house->block) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- RT --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                RT
                            </label>

                            <input
                                type="text"
                                name="rt"
                                value="{{ old('rt', $house->rt) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- RW --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                RW
                            </label>

                            <input
                                type="text"
                                name="rw"
                                value="{{ old('rw', $house->rw) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- Luas Rumah --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Luas Rumah (m²)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="area_m2"
                                value="{{ old('area_m2', $house->area_m2) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- Penghuni --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Jumlah Penghuni
                            </label>

                            <input
                                type="number"
                                min="0"
                                name="occupant_count"
                                value="{{ old('occupant_count', $house->occupant_count) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        {{-- KK --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Jumlah KK
                            </label>

                            <input
                                type="number"
                                min="0"
                                name="household_count"
                                value="{{ old('household_count', $house->household_count) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>


                    <div class="mt-6 flex items-center justify-end gap-3">

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
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>