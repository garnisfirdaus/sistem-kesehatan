<!-- layouts/sidebar.blade.php -->
<ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="mdi mdi-view-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#dataMenu" aria-expanded="false" aria-controls="dataMenu">
            <i class="mdi mdi-database"></i>
            <span>Tambah Data</span>
        </a>
        <div class="collapse" id="dataMenu">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('data-training.index') }}">Data Training</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('data-training.create') }}">Tambah Data Baru</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#prediksiMenu" aria-expanded="false" aria-controls="prediksiMenu">
            <i class="mdi mdi-heart-pulse"></i>
            <span>Prediksi Kesehatan</span>
        </a>
        <div class="collapse" id="prediksiMenu">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prediksi.create') }}">Buat Prediksi Baru</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('riwayat.index') }}">
            <i class="mdi mdi-history"></i>
            <span>Riwayat Prediksi</span>
        </a>
    </li>
</ul>
