<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Wilayah
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('regions.store') }}">
                        @csrf

                        <div class="space-y-5">

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Wilayah Induk
                                </label>

                                <select name="parent_id"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    <option value="">-- Tidak Ada --</option>

                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}"
                                            @selected(old('parent_id') == $parent->id)>
                                            {{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('parent_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Kode Wilayah
                                </label>

                                <input type="text"
                                       name="code"
                                       value="{{ old('code') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300"
                                       placeholder="Contoh: 32.09.01">

                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Nama Wilayah
                                </label>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300"
                                       placeholder="Contoh: Kecamatan Sumber">

                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Tipe
                                </label>

                                <select name="type"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    <option value="Kabupaten" @selected(old('type') === 'Kabupaten')>
                                        Kabupaten
                                    </option>
                                    <option value="Kecamatan" @selected(old('type') === 'kecamatan')>
                                        Kecamatan
                                    </option>
                                    <option value="desa" @selected(old('type') === 'desa')>
                                        Desa/Kelurahan
                                    </option>
                                </select>

                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Level
                                </label>

                                <input type="number"
                                       name="level"
                                       value="{{ old('level', 0) }}"
                                       min="0"
                                       class="mt-1 block w-full rounded-md border-gray-300">

                                @error('level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       checked
                                       class="rounded border-gray-300">

                                <label class="ml-2 text-sm text-gray-700">
                                    Wilayah aktif
                                </label>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center gap-3">
                            <button type="submit"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                                Simpan
                            </button>

                            <a href="{{ route('regions.index') }}"
                               class="px-4 py-2 text-gray-700 hover:text-gray-900">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>