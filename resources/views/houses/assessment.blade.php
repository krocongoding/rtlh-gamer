<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Assessment RTLH
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $house->house_code }}
                </p>
            </div>

            <a
                href="{{ route('houses.show', $house) }}"
                class="px-4 py-2 text-sm text-gray-700 hover:text-gray-900"
            >
                Kembali
            </a>

        </div>
    </x-slot>


    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

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


            {{-- SUCCESS --}}
            @if (session('success'))

                <div class="mb-6 rounded-lg border border-green-300 bg-green-100 px-5 py-4">

                    <p class="text-sm text-green-700">
                        ✓ {{ session('success') }}
                    </p>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('houses.assessment.update', $house) }}"
            >

                @csrf
                @method('PUT')


                <div class="bg-white shadow-sm sm:rounded-lg p-6">


                    {{-- ================================================= --}}
                    {{-- DATA ASSESSMENT --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <h3 class="text-xl font-bold text-gray-900">
                            Data Assessment
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Masukkan informasi penilaian kondisi rumah.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                        {{-- TAHUN --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Assessment
                            </label>

                            <input
                                type="number"
                                name="assessment_year"
                                value="{{ old(
                                    'assessment_year',
                                    $assessment?->assessment_year ?? now()->year
                                ) }}"
                                min="2000"
                                max="2100"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        {{-- TANGGAL --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Assessment
                            </label>

                            <input
                                type="date"
                                name="assessment_date"
                                value="{{ old(
                                    'assessment_date',
                                    $assessment?->assessment_date?->format('Y-m-d')
                                    ?? now()->format('Y-m-d')
                                ) }}"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        {{-- STATUS --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Assessment
                            </label>

                            <select
                                name="status"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >

                                <option value="">
                                    -- Pilih Status --
                                </option>

                                <option
                                    value="draft"
                                    @selected(old('status', $assessment?->status) === 'draft')
                                >
                                    Draft
                                </option>

                                <option
                                    value="completed"
                                    @selected(old('status', $assessment?->status) === 'completed')
                                >
                                    Selesai
                                </option>

                                <option
                                    value="verified"
                                    @selected(old('status', $assessment?->status) === 'verified')
                                >
                                    Terverifikasi
                                </option>

                            </select>

                        </div>


                        {{-- PRIORITAS --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tingkat Prioritas
                            </label>

                            <select
                                name="priority_level"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >

                                <option value="">
                                    -- Pilih Prioritas --
                                </option>

                                <option
                                    value="rendah"
                                    @selected(old('priority_level', $assessment?->priority_level) === 'rendah')
                                >
                                    Rendah
                                </option>

                                <option
                                    value="sedang"
                                    @selected(old('priority_level', $assessment?->priority_level) === 'sedang')
                                >
                                    Sedang
                                </option>

                                <option
                                    value="tinggi"
                                    @selected(old('priority_level', $assessment?->priority_level) === 'tinggi')
                                >
                                    Tinggi
                                </option>

                            </select>

                        </div>


                        {{-- SCORE --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nilai / Score
                            </label>

                            <input
                                type="number"
                                name="score"
                                value="{{ old('score', $assessment?->score) }}"
                                min="0"
                                step="0.01"
                                placeholder="Contoh: 75.50"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>

                    </div>


                    {{-- CATATAN UMUM --}}
                    <div class="mt-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan
                        </label>

                        <textarea
                            name="notes"
                            rows="5"
                            placeholder="Catatan hasil assessment..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >{{ old('notes', $assessment?->notes) }}</textarea>

                    </div>


                    {{-- ================================================= --}}
                    {{-- DETAIL PENILAIAN --}}
                    {{-- ================================================= --}}

                    @php

                        $existingItems = $assessment?->items ?? collect();

                        $itemMap = $existingItems->keyBy(function ($item) {
                            return $item->category;
                        });

                    @endphp


                    <div class="mt-8 border-t pt-6">


                        <div class="mb-5">

                            <h3 class="text-lg font-semibold text-gray-900">
                                Detail Penilaian RTLH
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Pilih satu nilai untuk setiap kategori.
                            </p>

                        </div>


                        @if ($categories->count())


                            <div class="space-y-5">


                                @foreach ($categories as $category)

                                    @php

                                        $existing = $itemMap->get($category->code);

                                        $selectedValue = old(
                                            'items.' . $loop->index . '.value',
                                            $existing?->value
                                        );

                                        $existingOtherValue = old(
                                            'items.' . $loop->index . '.other_value',
                                            $existing?->other_value
                                        );

                                        $existingNotes = old(
                                            'items.' . $loop->index . '.notes',
                                            $existing?->notes
                                        );

                                        $hasOtherOption = $category->values->contains(
                                            function ($value) {
                                                return strtoupper($value->code) === 'OTHER';
                                            }
                                        );

                                    @endphp


                                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">


                                        {{-- CATEGORY --}}
                                        <div class="mb-3">

                                            <label
                                                for="category_{{ $category->id }}"
                                                class="block text-sm font-semibold text-gray-800"
                                            >
                                                {{ $category->name }}
                                            </label>

                                            @if ($category->description)

                                                <p class="mt-1 text-xs text-gray-500">
                                                    {{ $category->description }}
                                                </p>

                                            @endif

                                        </div>


                                        {{-- CATEGORY CODE --}}
                                        <input
                                            type="hidden"
                                            name="items[{{ $loop->index }}][category]"
                                            value="{{ $category->code }}"
                                        >


                                        {{-- ITEM CODE --}}
                                        <input
                                            type="hidden"
                                            name="items[{{ $loop->index }}][item_code]"
                                            value="{{ $category->code }}"
                                        >


                                        {{-- SELECT --}}
                                        <select
                                            id="category_{{ $category->id }}"
                                            name="items[{{ $loop->index }}][value]"
                                            onchange="toggleOtherInput({{ $category->id }}, this.value)"
                                            class="w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >

                                            <option value="">
                                                -- Pilih {{ $category->name }} --
                                            </option>


                                            @foreach ($category->values as $value)

                                                <option
                                                    value="{{ $value->code }}"
                                                    @selected($selectedValue === $value->code)
                                                >
                                                    {{ $value->label }}
                                                </option>

                                            @endforeach

                                        </select>


                                        {{-- ================================================= --}}
                                        {{-- LAINNYA --}}
                                        {{-- ================================================= --}}

                                        @if ($hasOtherOption)

                                            <div
                                                id="other_wrapper_{{ $category->id }}"
                                                class="mt-3 {{ $selectedValue === 'OTHER' ? '' : 'hidden' }}"
                                            >

                                                <label
                                                    for="other_{{ $category->id }}"
                                                    class="block text-sm font-medium text-gray-700 mb-2"
                                                >
                                                    Keterangan Lainnya
                                                    <span class="font-normal text-gray-400">
                                                        (opsional)
                                                    </span>
                                                </label>

                                                <input
                                                    type="text"
                                                    id="other_{{ $category->id }}"
                                                    name="items[{{ $loop->index }}][other_value]"
                                                    value="{{ $existingOtherValue }}"
                                                    placeholder="Tuliskan keterangan lainnya..."
                                                    class="w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                >

                                            </div>

                                        @endif


                                        {{-- ================================================= --}}
                                        {{-- CATATAN --}}
                                        {{-- ================================================= --}}

                                        <div class="mt-4">

                                            <label
                                                for="notes_{{ $category->id }}"
                                                class="block text-sm font-medium text-gray-700 mb-2"
                                            >
                                                Catatan
                                                <span class="font-normal text-gray-400">
                                                    (opsional)
                                                </span>
                                            </label>

                                            <textarea
                                                id="notes_{{ $category->id }}"
                                                name="items[{{ $loop->index }}][notes]"
                                                rows="2"
                                                placeholder="Catatan untuk {{ $category->name }}..."
                                                class="w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            >{{ $existingNotes }}</textarea>

                                        </div>


                                    </div>

                                @endforeach

                            </div>


                        @else

                            <div class="rounded-lg border border-yellow-300 bg-yellow-50 px-5 py-4">

                                <p class="text-sm text-yellow-800">
                                    Belum ada master kategori assessment yang aktif.
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- FOOTER --}}
                    {{-- ================================================= --}}

                    <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t">

                        <a
                            href="{{ route('houses.show', $house) }}"
                            class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Simpan Assessment
                        </button>

                    </div>


                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SCRIPT --}}
    {{-- ========================================================= --}}

    <script>

        function toggleOtherInput(categoryId, value) {

            const wrapper = document.getElementById(
                'other_wrapper_' + categoryId
            );

            const input = document.getElementById(
                'other_' + categoryId
            );

            if (!wrapper) {
                return;
            }

            if (value === 'OTHER') {

                wrapper.classList.remove('hidden');

            } else {

                wrapper.classList.add('hidden');

                if (input) {
                    input.value = '';
                }

            }
        }

    </script>

</x-app-layout>
