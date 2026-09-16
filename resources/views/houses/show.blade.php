<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Data RTLH
            </h2>

            <div class="flex items-center gap-3">

                {{-- KONDISI FISIK --}}
                @can('update', $house)
                    <a href="{{ route('houses.condition.edit', $house) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Kondisi Fisik
                    </a>
                @endcan

                {{-- EDIT --}}
                @can('update', $house)
                    <a href="{{ route('houses.edit', $house) }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                        Edit
                    </a>
                @endcan

                {{-- HAPUS --}}
                @can('delete', $house)
                    <form method="POST"
                          action="{{ route('houses.destroy', $house) }}"
                          onsubmit="return confirm('Yakin ingin menghapus data rumah ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                @endcan

                {{-- SANITASI & UTILITAS --}}
                @can('update', $house)
                    <a href="{{ route('houses.sanitation-utility.edit', $house) }}"
                       class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                        Sanitasi & Utilitas
                    </a>
                @endcan

                {{-- KEMBALI --}}
                <a href="{{ route('houses.index') }}"
                   class="px-4 py-2 text-sm text-gray-700 hover:text-gray-900">
                    Kembali
                </a>

            </div>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- NOTIFIKASI --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-300 bg-green-100 px-5 py-4">
                    <p class="font-semibold text-green-800">
                        ✓ {{ session('success') }}
                    </p>
                </div>
            @endif


            {{-- INFORMASI RUMAH --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ $house->house_code }}
                    </h3>

                    <p class="text-gray-500">
                        Data RTLH Kabupaten Cirebon
                    </p>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500">
                            Kode Rumah
                        </p>

                        <p class="font-medium">
                            {{ $house->house_code }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            Wilayah
                        </p>

                        <p class="font-medium">
                            {{ $house->region?->name ?? '-' }}
                        </p>
                    </div>


                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">
                            Alamat
                        </p>

                        <p class="font-medium">
                            {{ $house->address ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            Blok
                        </p>

                        <p class="font-medium">
                            {{ $house->block ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            RT / RW
                        </p>

                        <p class="font-medium">
                            {{ $house->rt ?? '-' }} / {{ $house->rw ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            Luas Rumah
                        </p>

                        <p class="font-medium">
                            {{ $house->area_m2 ?? '-' }} m²
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            Jumlah Penghuni
                        </p>

                        <p class="font-medium">
                            {{ $house->occupant_count ?? '-' }} orang
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            Tahun Survey
                        </p>

                        <p class="font-medium">
                            {{ $house->survey_year }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <p class="font-medium">
                            {{ $house->status }}
                        </p>
                    </div>

                </div>
            </div>

            ```blade
                {{-- ========================================================= --}}
                {{-- ASSESSMENT RTLH --}}
                {{-- ========================================================= --}}

                @php
                    $latestAssessment = $house->assessments
                        ->sortByDesc('assessment_year')
                        ->sortByDesc('id')
                        ->first();
                @endphp

                ```blade
{{-- ========================================================= --}}
{{-- ASSESSMENT RTLH --}}
{{-- ========================================================= --}}

@php
    $latestAssessment = $house->assessments
        ->sortByDesc('assessment_year')
        ->sortByDesc('id')
        ->first();

    $assessmentItems = $latestAssessment?->items ?? collect();

    $assessmentItemMap = $assessmentItems->keyBy('category');

    $categoryMap = $assessmentCategories->keyBy('code');
@endphp


<div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h3 class="text-xl font-bold text-gray-900">
                Assessment RTLH
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Hasil penilaian kondisi rumah
            </p>
        </div>

        @can('update', $house)
            <a
                href="{{ route('houses.assessment.edit', $house) }}"
                class="text-sm text-blue-600 hover:text-blue-800"
            >
                Edit Assessment
            </a>
        @endcan

    </div>


    @if ($latestAssessment)

        {{-- ================================================= --}}
        {{-- RINGKASAN ASSESSMENT --}}
        {{-- ================================================= --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            {{-- TAHUN --}}
            <div class="rounded-lg border border-gray-200 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Tahun Assessment
                </p>

                <p class="mt-1 text-lg font-semibold text-gray-900">
                    {{ $latestAssessment->assessment_year }}
                </p>
            </div>


            {{-- TANGGAL --}}
            <div class="rounded-lg border border-gray-200 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Tanggal
                </p>

                <p class="mt-1 text-lg font-semibold text-gray-900">
                    {{ $latestAssessment->assessment_date?->format('d-m-Y') ?? '-' }}
                </p>
            </div>


            {{-- STATUS --}}
            <div class="rounded-lg border border-gray-200 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Status
                </p>

                @php
                    $statusLabel = match ($latestAssessment->status) {
                        'draft' => 'Draft',
                        'completed' => 'Selesai',
                        'verified' => 'Terverifikasi',
                        default => ucfirst($latestAssessment->status ?? '-'),
                    };
                @endphp

                <p class="mt-1 text-lg font-semibold text-gray-900">
                    {{ $statusLabel }}
                </p>
            </div>


            {{-- PRIORITAS --}}
            <div class="rounded-lg border border-gray-200 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Prioritas
                </p>

                @php
                    $priorityLabel = match ($latestAssessment->priority_level) {
                        'rendah' => 'Rendah',
                        'sedang' => 'Sedang',
                        'tinggi' => 'Tinggi',
                        default => '-',
                    };
                @endphp

                <p class="mt-1 text-lg font-semibold text-gray-900">
                    {{ $priorityLabel }}
                </p>
            </div>

        </div>


        {{-- SCORE --}}
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 mb-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Nilai / Score
                    </p>

                    <p class="mt-1 text-3xl font-bold text-gray-900">
                        {{ $latestAssessment->score ?? '-' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- DETAIL PENILAIAN --}}
        {{-- ================================================= --}}

        <div>

            <div class="mb-4">

                <h4 class="text-lg font-semibold text-gray-900">
                    Detail Penilaian
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Kondisi rumah berdasarkan hasil assessment.
                </p>

            </div>


            @if ($assessmentCategories->count())

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @foreach ($assessmentCategories as $category)

                        @php
                            $item = $assessmentItemMap->get($category->code);

                            $selectedValue = $item?->value;

                            $selectedMasterValue = $category->values
                                ->firstWhere('code', $selectedValue);

                            $isOther = strtoupper($selectedValue ?? '') === 'OTHER';
                        @endphp


                        <div class="rounded-lg border border-gray-200 p-5">

                            {{-- CATEGORY --}}
                            <p class="text-sm font-medium text-gray-500">
                                {{ $category->name }}
                            </p>


                            {{-- VALUE --}}
                            <p class="mt-1 text-base font-semibold text-gray-900">

                                @if ($selectedMasterValue)

                                    {{ $selectedMasterValue->label }}

                                @else

                                    <span class="text-gray-400 font-normal">
                                        Belum diisi
                                    </span>

                                @endif

                            </p>


                            {{-- OTHER DETAIL --}}
                            @if ($isOther && $item?->notes)

                                <div class="mt-3 rounded-md bg-gray-50 border border-gray-100 p-3">

                                    <p class="text-xs font-medium text-gray-500">
                                        Keterangan Lainnya
                                    </p>

                                    <p class="mt-1 text-sm text-gray-800">
                                        {{ $item->other_value    }}
                                    </p>

                                </div>

                            @elseif ($item?->notes)

                                <div class="mt-3">

                                    <p class="text-xs font-medium text-gray-500">
                                        Catatan
                                    </p>

                                    <p class="mt-1 text-sm text-gray-700 whitespace-pre-line">
                                        {{ $item->notes }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>


            @else

                <div class="rounded-lg border border-gray-200 bg-gray-50 px-5 py-5">

                    <p class="text-sm text-gray-500">
                        Belum ada kategori assessment yang tersedia.
                    </p>
                </div>
            @endif

        </div>

        {{-- ================================================= --}}
        {{-- CATATAN UMUM --}}
        {{-- ================================================= --}}

        @if ($latestAssessment->notes)

            <div class="mt-6 border-t pt-5">

                <p class="text-sm font-medium text-gray-500">
                    Catatan Umum Assessment
                </p>

                <p class="mt-1 text-sm text-gray-800 whitespace-pre-line">
                    {{ $latestAssessment->notes }}
                </p>
            </div>
        @endif


    @else

        {{-- BELUM ADA ASSESSMENT --}}
        <div class="rounded-lg border border-gray-200 bg-gray-50 px-5 py-5">

            <p class="text-sm text-gray-500">
                Belum ada assessment RTLH untuk rumah ini.
            </p>

            @can('update', $house)

                <a
                    href="{{ route('houses.assessment.edit', $house) }}"
                    class="inline-block mt-3 text-sm text-blue-600 hover:text-blue-800">
                    + Tambah Assessment
                </a>
            @endcan
        </div>
    @endif
            </div>

            {{-- KONDISI FISIK --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h3 class="text-xl font-bold text-gray-900">
                            Kondisi Fisik Rumah
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Kondisi komponen utama rumah
                        </p>
                    </div>


                    @can('update', $house)
                        <a href="{{ route('houses.condition.edit', $house) }}"
                           class="text-sm text-blue-600 hover:text-blue-800">
                            Edit Kondisi
                        </a>
                    @endcan

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- STRUKTUR --}}
                    <div class="border rounded-lg p-5">

                        <h4 class="font-semibold text-gray-800 mb-4">
                            Struktur Rumah
                        </h4>

                        <div class="space-y-3 text-sm">

                            <div>
                                <p class="text-gray-500">
                                    Pondasi
                                </p>

                                <p class="font-medium">
                                    {{ $house->structure?->foundation ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Kondisi Sloof
                                </p>

                                <p class="font-medium">
                                    {{ $house->structure?->sloofCondition?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Kondisi Kolom
                                </p>

                                <p class="font-medium">
                                    {{ $house->structure?->columnCondition?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Kondisi Balok
                                </p>

                                <p class="font-medium">
                                    {{ $house->structure?->beamCondition?->label ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>



                    {{-- LANTAI --}}
                    <div class="border rounded-lg p-5">

                        <h4 class="font-semibold text-gray-800 mb-4">
                            Lantai
                        </h4>

                        <div class="space-y-3 text-sm">

                            <div>
                                <p class="text-gray-500">
                                    Bahan
                                </p>

                                <p class="font-medium">
                                    {{ $house->floor?->material?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Kondisi
                                </p>

                                <p class="font-medium">
                                    {{ $house->floor?->condition?->label ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>



                    {{-- DINDING --}}
                    <div class="border rounded-lg p-5">

                        <h4 class="font-semibold text-gray-800 mb-4">
                            Dinding
                        </h4>

                        <div class="space-y-3 text-sm">

                            <div>
                                <p class="text-gray-500">
                                    Bahan
                                </p>

                                <p class="font-medium">
                                    {{ $house->wall?->material?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Kondisi
                                </p>

                                <p class="font-medium">
                                    {{ $house->wall?->condition?->label ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>



                    {{-- ATAP --}}
                    <div class="border rounded-lg p-5">

                        <h4 class="font-semibold text-gray-800 mb-4">
                            Atap
                        </h4>

                        <div class="space-y-3 text-sm">

                            <div>
                                <p class="text-gray-500">
                                    Kondisi Rangka
                                </p>

                                <p class="font-medium">
                                    {{ $house->roof?->frameCondition?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Bahan
                                </p>

                                <p class="font-medium">
                                    {{ $house->roof?->material?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Kondisi
                                </p>

                                <p class="font-medium">
                                    {{ $house->roof?->condition?->label ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



            {{-- SANITASI & UTILITAS --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h3 class="text-xl font-bold text-gray-900">
                            Sanitasi & Utilitas
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi sanitasi dan utilitas rumah
                        </p>
                    </div>


                    @can('update', $house)
                        <a href="{{ route('houses.sanitation-utility.edit', $house) }}"
                           class="text-sm text-green-600 hover:text-green-800">
                            Edit Sanitasi & Utilitas
                        </a>
                    @endcan

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- SANITASI --}}
                    <div class="border rounded-lg p-5">

                        <h4 class="font-semibold text-gray-800 mb-4">
                            Sanitasi
                        </h4>

                        <div class="space-y-3 text-sm">

                            <div>
                                <p class="text-gray-500">
                                    Sumber Air
                                </p>

                                <p class="font-medium">
                                    {{ $house->sanitation?->waterSource?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Ketersediaan Toilet
                                </p>

                                <p class="font-medium">
                                    @if ($house->sanitation?->toilet_available)
                                        Tersedia
                                    @else
                                        Tidak Tersedia
                                    @endif
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Jenis Toilet
                                </p>

                                <p class="font-medium">
                                    {{ $house->sanitation?->toiletType?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Pembuangan Tinja
                                </p>

                                <p class="font-medium">
                                    {{ $house->sanitation?->fecalDisposalType?->label ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Jarak Air ke Tempat Pembuangan Tinja
                                </p>

                                <p class="font-medium">
                                    {{ $house->sanitation?->water_fecal_distance ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>



                    {{-- UTILITAS --}}
                    <div class="border rounded-lg p-5">

                        <h4 class="font-semibold text-gray-800 mb-4">
                            Utilitas
                        </h4>

                        <div class="space-y-3 text-sm">

                            <div>
                                <p class="text-gray-500">
                                    Bukaan Cahaya
                                </p>

                                <p class="font-medium">
                                    {{ $house->utility?->light_opening ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Ventilasi
                                </p>

                                <p class="font-medium">
                                    {{ $house->utility?->ventilation ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-gray-500">
                                    Sumber Penerangan
                                </p>

                                <p class="font-medium">
                                    {{ $house->utility?->lightingSource?->label ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>