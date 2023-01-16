<?php require 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pencatatan Suhu Ruangan</title>
    <?php include './style.php' ?>
</head>

<body class="nav-fixed">
    <!-- Include navibar-->
    <?php include 'nav.php' ?>
    <!-- Include sidenav-->
    <?php include 'sidenav.php' ?>
    <!-- Content-->
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                <div class="container-fluid px-4 px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                                    Pencatatan Suhu Ruangan
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-fluid px-4 mt-n10">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#" class="btn btn-primary btn-icon-split float-left shadow lift lift-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="fa fa-plus-circle"></i>&NonBreakingSpace;Tambah Data
                                </a>
                                &NonBreakingSpace;
                                <a href="export-data.php" class="btn btn-success btn-icon-split shadow lift lift-sm">
                                    <i class="fa fa-download"></i>&NonBreakingSpace;Export to Excel
                                </a>
                            </div>
                            <div class="card-body">
                                <?php include 'alert.php' ?>
                                <table id="datatablesSimple">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Ruangan</th>
                                            <th>Tanggal</th>
                                            <th>Suhu Pagi</th>
                                            <th>Kelembaban Pagi</th>
                                            <th>Petugas Pagi</th>
                                            <th>Suhu Sore</th>
                                            <th>Kelembaban Sore</th>
                                            <th>Petugas Sore</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT
                                        suhu.id, 
                                        suhu.ruangan, 
                                        suhu.tanggal, 
                                        ruangan.ruangan AS ruangan_nama, 
                                        suhu.suhu_pagi, 
                                        suhu.kelembapan_pagi,
                                        suhu.petugas_pagi,
                                        suhu.suhu_sore, 
                                        suhu.kelembapan_sore,
                                        suhu.petugas_sore
                                    FROM
                                        suhu
                                        INNER JOIN
                                        ruangan
                                        ON 
                                            suhu.ruangan = ruangan.id_ruangan;");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $data['ruangan_nama'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['suhu_pagi'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['kelembapan_pagi'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['petugas_pagi'] ?>
                                                </td>
                                                <?php
                                                if ($data['suhu_sore'] == '' || ($data['kelembapan_sore'] == '') || ($data['petugas_sore'] == '')) {
                                                ?>
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['suhu_sore'] ?>
                                                    </td>
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['kelembapan_sore'] ?>
                                                    </td>
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['petugas_sore'] ?>
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td>
                                                        <?= $data['suhu_sore'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['kelembapan_sore'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['petugas_sore'] ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $data['id']; ?>"><i class="fa-solid fa-trash"></i></button></button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">Delete data suhu: <strong>
                                                                            <?= $data['tanggal']; ?>
                                                                        </strong> </h5>
                                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">Anda yakin?</div>
                                                                <div class="modal-footer"><a class="btn btn-danger" href="delete_data.php?id=<?= $data['id']; ?>" type="button">Hapus</a><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="editModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title text-white">Edit data #
                                                                        <?php echo $data['ruangan']; ?>
                                                                    </h5>
                                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="./edit-data.php" method="POST" id="form<?php echo $data['id']; ?>">
                                                                        <div class="mb-3"><label for="kode">ID</label><input class="form-control" id="id" type="id" name="id" value="<?php echo $data['id']; ?>" readonly="readonly"></div>
                                                                        <div class="mb-3">
                                                                            <label for="kualifikasi">Ruangan</label><select class="form-control" id="ruangan" name="ruangan">
                                                                                <?php
                                                                                $queri = mysqli_query($koneksi, "SELECT * FROM `ruangan`;");
                                                                                while ($querynama = mysqli_fetch_array($queri)) {

                                                                                    if ($querynama['id_ruangan'] == $data['ruangan']) {
                                                                                        echo '<option value="' . $querynama['id_ruangan'] . '" selected>' . $querynama["ruangan"] . '</option>';
                                                                                    } else {
                                                                                        echo '<option value="' . $querynama['id_ruangan'] . '">' . $querynama["ruangan"] . '</option>';
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3"><label for="tanggal">Tanggal</label><input class="form-control" id="tanggal" name="tanggal" type="date" value="<?php echo $data['tanggal']; ?>" required></div>
                                                                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label for="suhu_pagi">Suhu Pagi</label><input class="form-control" id="suhu_pagi" name="suhu_pagi" type="text" value="<?php echo $data['suhu_pagi']; ?>" required></div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="mb-3"><label for="kelembapan_pagi">Kelembapan Pagi</label><input class="form-control" id="kelembapan_pagi" name="kelembapan_pagi" type="number" value="<?php echo $data['kelembapan_pagi']; ?>" required></div>
                                                                            </div>
                                                                            <div class="mb-3"><label for="petugas_pagi">Petugas Catat Pagi</label><input class="form-control" id="petugas_pagi" name="petugas_pagi" type="text" value="<?php echo $data['petugas_pagi']; ?>" required></div>
                                                                        </div>
                                                                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label for="suhu_sore">Suhu Sore</label><input class="form-control" id="suhu_sore" name="suhu_sore" type="text" value="<?php echo $data['suhu_sore']; ?>" required></div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="mb-3"><label for="kelembapan_sore">Kelembapan Sore</label><input class="form-control" id="kelembapan_sore" name="kelembapan_sore" type="number" value="<?php echo $data['kelembapan_sore']; ?>" required></div>
                                                                            </div>
                                                                            <div class="mb-3"><label for="petugas_sore">Petugas Catat Sore</label><input class="form-control" id="petugas_sore" name="petugas_sore" type="text" value="<?php echo $data['petugas_sore']; ?>" required></div>

                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" form="form<?php echo $data['id']; ?>" href="" class="btn btn-success">Simpan</button>
                                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    $no += 1;
                                                }
                                                    ?>
                                                    </div>
                                                </td>
                                            </tr>

                                    </tbody>
                                </table>
                                <!-- Large modal -->
                                <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white">Tambah Data</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="./tambah-data.php" method="POST" id="form2">
                                                    <div class="mb-3">
                                                        <label for="hasil_test">Hasil</label><select class="form-control" id="ruangan" name="ruangan" required>
                                                            <option value="" selected disabled hidden>--Pilih Ruangan--</option>
                                                            <?php
                                                            include "koneksi.php";
                                                            $query    = mysqli_query($koneksi, "SELECT * FROM `ruangan`;");
                                                            while ($data = mysqli_fetch_array($query)) {
                                                            ?>
                                                                <option value="<?= $data['id_ruangan']; ?>">
                                                                    <?php echo $data['ruangan']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3"><label for="tanggal">Tanggal</label><input class="form-control" id="tanggal" name="tanggal" type="date" required></div>
                                                    <!-- Pagi -->
                                                    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                                        <div class="col">
                                                            <div class="mb-3"><label for="suhu_pagi">Suhu Pagi</label><input class="form-control" id="suhu_pagi" name="suhu_pagi" type="number" step="any" required></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3"><label for="kelembapan_pagi">Kelembapan Pagi</label><input class="form-control" id="kelembapan_pagi" name="kelembapan_pagi" type="number" required></div>
                                                        </div>
                                                        <div class="mb-3"><label for="petugas_pagi">Petugas Catat Pagi</label><input class="form-control" id="petugas_pagi" name="petugas_pagi" type="text" required></div>
                                                    </div>
                                                    <!-- Sore -->
                                                    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                                        <div class="col">
                                                            <div class="mb-3"><label for="suhu_sore">Suhu Sore</label><input class="form-control" id="suhu_sore" name="suhu_sore" type="number" step="any"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3"><label for="kelembapan_sore">Kelembapan Sore</label><input class="form-control" id="kelembapan_sore" name="kelembapan_sore" type="number"></div>
                                                        </div>
                                                        <div class="mb-3"><label for="petugas_sore">Petugas Catat Sore</label><input class="form-control" id="petugas_sore" name="petugas_sore" type="text"></div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="form2" href="" class="btn btn-success">Simpan</button>
                                                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'footer.php' ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
    <script src="./js/simple-datatables@5.js"></script>
    <script src="js/datatables/datatables-simple-demo.js"></script>
</body>

</html>