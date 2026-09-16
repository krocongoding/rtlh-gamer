<x-layouts.app title="Surveyor">
    <div class="pagehead">
        <div>
            <div class="kicker">SURVEYOR</div>
            <h1>Field Workspace</h1>
            <p class="muted">Input, lengkapi assessment, foto, dan kirim data ke Admin.</p>
        </div>
        <a class="btn primary" href="{{ route('surveyor.rtlh.create') }}">+ Tambah RTLH</a>
    </div>
    <div class="grid3">
        <div class="card">
            <div class="stat-label">Data Saya</div>
            <div class="stat">{{ number_format($mine) }}</div>
        </div>
        <div class="card">
            <div class="stat-label">Draft</div>
            <div class="stat">{{ number_format($draft) }}</div>
        </div>
        <div class="card">
            <div class="stat-label">Perlu Revisi</div>
            <div class="stat">{{ number_format($revision) }}</div>
        </div>
    </div>
    <div class="actions"><a class="btn" href="{{ route('surveyor.rtlh.index') }}">Data Saya</a>
</div></x-layouts.app>
