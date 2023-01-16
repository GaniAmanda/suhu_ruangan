<?php require 'koneksi.php';
require 'cek-sesi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Database Test</title>    
    <?php include './style.php'?>
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
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="database"></i></div>
                                    Master Kualifikasi
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#" class="btn btn-primary btn-icon-split float-left shadow lift lift-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="fa fa-plus-circle"></i>&NonBreakingSpace;Tambah Kualifikasi
                                </a>
                            </div>
                            <div class="card-body">
                            <?php include 'alert.php' ?>
                                <table id="datatablesSimple" style="width: 50%;">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Kualifikasi</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT * from kualifikasi;");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $data['kualifikasi'] ?></td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_kualifikasi']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                                    <div class="modal fade" id="editModal<?php echo $data['id_kualifikasi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title text-white">Edit data #<?php echo $data['id_kualifikasi']; ?></h5>
                                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="./edit-kualifikasi.php" method="POST" id="form-edit-kualifikasi<?php echo $data['id_kualifikasi']; ?>">
                                                                        <div class="mb-3"><label for="kode">ID</label><input class="form-control" id="id_kualifikasi" type="id" name="id_kualifikasi" value="<?php echo $data['id_kualifikasi']; ?>" readonly="readonly"></div>
                                                                        <div class="mb-3"><label for="nama">Nama Bagian</label><input class="form-control" id="kualifikasi" type="text" name="kualifikasi" value="<?php echo $data['kualifikasi']; ?>"></div>
                                                                        </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" form="form-edit-kualifikasi<?php echo $data['id_kualifikasi']; ?>" href="" class="btn btn-success">Simpan</button>
                                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    $no += 1;
                                                }
                                                    ?>
                                                </td>
                                            </tr>

                                    </tbody>
                                </table>
                                <!-- Large modal -->
                                <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white">Tambah kualifikasi</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="./tambah-kualifikasi.php" method="POST" id="form-tambah-kualifikasi">
                                                    <div class="mb-3"><label for="nama">Nama kualifikasi</label><input class="form-control" id="kualifikasi" name="kualifikasi" type="text" required></div>                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="form-tambah-kualifikasi" href="" class="btn btn-success">Simpan</button>
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
        }, 5000);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
    <script src="./js/simple-datatables@5.js"></script>
    <script src="js/datatables/datatables-simple-demo.js"></script>
</body>

</html>