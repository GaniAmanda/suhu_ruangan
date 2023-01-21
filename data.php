<?php 
require './cek-sesi.php';
require 'koneksi.php'; 
?>
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
                                <a href="export-data.php" class="btn btn-success btn-icon-split shadow lift lift-sm">
                                    <i class="fa fa-download"></i>&NonBreakingSpace;Export to Excel
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Ruangan</th>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <th>Suhu</th>
                                            <th>Kelembaban</th>
                                            <th>Sensor</th>
                                            <th>Last Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT
                                        ruangan.ruangan AS ruangan_nama, 
                                        suhu.ruangan, 
                                        suhu.tanggal, 
                                        suhu.suhu, 
                                        suhu.kelembapan, 
                                        suhu.modified_date, 
                                        shift.shift, 
                                        sensor.`name`
                                    FROM
                                        suhu
                                        INNER JOIN
                                        ruangan
                                        ON 
                                            suhu.ruangan = ruangan.id_ruangan
                                        INNER JOIN
                                        shift
                                        ON 
                                            suhu.shift = shift.id_shift
                                        LEFT JOIN
                                        sensor
                                        ON 
                                            suhu.sensor = sensor.id_sensor
                                    WHERE
                                        suhu.shift <> 0");
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
                                                    <?= $data['shift'] ?>
                                                </td>
                                                <?php
                                                if ($data['suhu'] == '' || ($data['kelembapan'] == '') || ($data['name'] == '')) {
                                                ?>
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['suhu'] ?>
                                                    </td>
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['kelembapan'] ?>
                                                    </td>
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['name'] ?>
                                                    </td">
                                                    <td class="bg-warning" style="--bs-bg-opacity: .5;">
                                                        <?= $data['modified_date'] ?>
                                                    </td>
                                                    <?php
                                                } else {
                                                ?>
                                                    <td>
                                                        <?= $data['suhu'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['kelembapan'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $data['modified_date'] ?>
                                                    </td>
                                                <?php
                                                }
                                                $no+=1;
                                            }
                                                ?>
                                                
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
                                                            <div class="mb-3"><label for="kelembapan_pagi">Kelembapan Pagi</label><input class="form-control" id="kelembapan_pagi" name="kelembapan_pagi" type="number" step="any" required></div>
                                                        </div>
                                                    </div>
                                                    <!-- Sore -->
                                                    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                                        <div class="col">
                                                            <div class="mb-3"><label for="suhu_sore">Suhu Sore</label><input class="form-control" id="suhu_sore" name="suhu_sore" type="number" step="any"></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3"><label for="kelembapan_sore">Kelembapan Sore</label><input class="form-control" id="kelembapan_sore" name="kelembapan_sore" type="number" step="any"></div>
                                                        </div>
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