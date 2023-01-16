 <?php
    if (isset($_GET['tambah'])) {
        $ket = $_GET['tambah'];
        if ($ket == 'sukses') {
            echo '<div class="alert alert-success" role="alert">
                                            <i class="fa-solid fa-circle-info"></i> Tambah data Berhasil!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                                            <i class="fa-solid fa-circle-exclamation"></i> Tambah data gagal!</div>';
        }
    } elseif (isset($_GET['hapus'])) {
        $ket = $_GET['hapus'];
        if ($ket == 'sukses') {
            echo '<div class="alert alert-success" role="alert">
                                            <i class="fa-solid fa-circle-info"></i> Hapus data Berhasil!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                                            <i class="fa-solid fa-circle-exclamation"></i> Hapus data gagal!</div>';
        }
    } elseif (isset($_GET['update'])) {
        $ket = $_GET['update'];
        if ($ket == 'sukses') {
            echo '<div class="alert alert-success" role="alert">
                                            <i class="fa-solid fa-circle-info"></i> Update data Berhasil!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                                            <i class="fa-solid fa-circle-exclamation"></i> Update data gagal!</div>';
        }
    } elseif (isset($_GET['register'])) {
        $ket = $_GET['register'];
        if ($ket == 'exist') {
            echo '<div class="alert alert-danger" role="alert">
                                            <i class="fa-solid fa-circle-exclamation"></i> Gagal! Email sudah pernah registrasi</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
                                            <i class="fa-solid fa-circle-info"></i> Registrasi User Berhasil!</div>';
        }
    } elseif (isset($_GET['upload'])) {
        $ket = $_GET['upload'];
        if ($ket == 'sukses') {
            echo '<div class="alert alert-success" role="alert">
                                            <i class="fa-solid fa-circle-info"></i> Upload Dokumen Berhasil!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                                            <i class="fa-solid fa-circle-exclamation"></i> Upload Dokumen Gagal</div>';
        }
    }
    ?>