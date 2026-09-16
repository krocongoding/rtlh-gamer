<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Data Penghuni Rumah
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $house->house_code }}
                </p>
            </div>

            <a href="{{ route('houses.show', $house) }}"
               class="px-4 py-2 text-sm text-gray-700 hover:text-gray-900">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-300 bg-red-50 px-5 py-4">

                    <h3 class="font-semibold text-red-800 mb-2">
                        Terjadi kesalahan:
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <form method="POST"
                  action="{{ route('houses.occupants.update', $house) }}"
                  x-data="occupantForm()">

                @csrf
                @method('PUT')

                <div class="bg-white shadow-sm sm:rounded-lg p-6">

                    {{-- HEADER --}}
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">

                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Daftar Penghuni
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Tambahkan seluruh anggota penghuni rumah.
                            </p>
                        </div>

                        <button type="button"
                                @click="add()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            + Tambah Penghuni
                        </button>

                    </div>

                    {{-- EMPTY STATE --}}
                    <template x-if="occupants.length === 0">
                        <div class="border border-dashed border-gray-300 rounded-lg p-8 text-center">

                            <p class="text-gray-500">
                                Belum ada data penghuni.
                            </p>

                            <button type="button"
                                    @click="add()"
                                    class="mt-3 text-blue-600 hover:text-blue-800 font-medium">
                                + Tambahkan penghuni pertama
                            </button>

                        </div>
                    </template>

                    {{-- OCCUPANTS --}}
                    <div class="space-y-6">

                        <template x-for="(occupant, index) in occupants"
                                  :key="occupant.key"> 
                                  <input
                                    type="hidden"
                                    :name="`occupants[${index}][id]`"
                                    x-model="occupant.id">

                            <div class="border rounded-lg p-5">

                                {{-- CARD HEADER --}}
                                <div class="flex items-center justify-between mb-5">

                                    <h4 class="font-semibold text-gray-800">
                                        Penghuni #<span x-text="index + 1"></span>
                                    </h4>

                                    <button type="button"
                                            @click="remove(index)"
                                            class="text-sm text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>

                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    {{-- HUBUNGAN --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Hubungan dengan Kepala Keluarga
                                        </label>

                                        <input type="text"
                                               :name="`occupants[${index}][relationship]`"
                                               x-model="occupant.relationship"
                                               placeholder="Contoh: Kepala Keluarga"
                                               required
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- JENIS KELAMIN --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Jenis Kelamin
                                        </label>

                                        <select :name="`occupants[${index}][gender]`"
                                                x-model="occupant.gender"
                                                required
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                                            <option value="">
                                                -- Pilih Jenis Kelamin --
                                            </option>

                                            <option value="L">
                                                Laki-laki
                                            </option>

                                            <option value="P">
                                                Perempuan
                                            </option>

                                        </select>
                                    </div>

                                    {{-- TAHUN LAHIR --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Tahun Lahir
                                        </label>

                                        <input type="number"
                                               :name="`occupants[${index}][birth_year]`"
                                               x-model="occupant.birth_year"
                                               min="1900"
                                               max="2100"
                                               placeholder="Contoh: 1985"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- PEKERJAAN --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pekerjaan
                                        </label>

                                        <input type="text"
                                               :name="`occupants[${index}][occupation]`"
                                               x-model="occupant.occupation"
                                               placeholder="Contoh: Petani"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- PENDIDIKAN --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Pendidikan
                                        </label>

                                        <input type="text"
                                               :name="`occupants[${index}][education]`"
                                               x-model="occupant.education"
                                               placeholder="Contoh: SMA"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    {{-- KONTAK UTAMA --}}
                                    <div class="flex items-center">

                                        <label class="flex items-center gap-3 cursor-pointer">

                                            <input type="checkbox"
                                                   :name="`occupants[${index}][is_primary_contact]`"
                                                   value="1"
                                                   x-model="occupant.is_primary_contact"
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">

                                            <span class="text-sm font-medium text-gray-700">
                                                Kontak Utama
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </template>

                    </div>

                    {{-- FOOTER --}}
                    <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t">

                        <a href="{{ route('houses.show', $house) }}"
                           class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Simpan Penghuni
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <script>
        function occupantForm() {
            return {
                occupants: @js(
                    $house->occupants->map(function ($occupant) {
                        return [
                            'key' => $occupant->id,
                            'id' => $occupant->id,
                            'relationship' => $occupant->relationship,
                            'gender' => $occupant->gender,
                            'birth_year' => $occupant->birth_year,
                            'occupation' => $occupant->occupation,
                            'education' => $occupant->education,
                            'is_primary_contact' => $occupant->is_primary_contact,
                        ];
                    })->values()
                ),

                add() {
                    this.occupants.push({
                        key: Date.now() + Math.random(),
                        id: null,
                        relationship: '',
                        gender: '',
                        birth_year: '',
                        occupation: '',
                        education: '',
                        is_primary_contact: false,
                    });
                },

                remove(index) {
                    this.occupants.splice(index, 1);
                }
            }
        }
    </script>

</x-app-layout>