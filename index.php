<?php
require 'cek-sesi.php';
include 'koneksi.php';
require 'cek_data.php';

if (isset($_GET['cari'])) {
    $bulan = $_GET['bulan'];
} else {
    $bulan = date('m');
}
//PAGI
$sql_pagi = mysqli_query($koneksi, "SELECT * FROM suhu LEFT JOIN sensor ON  suhu.sensor = sensor.id_sensor WHERE month(tanggal) = $bulan AND shift = 1 ORDER BY tanggal ASC;");
if (isset($sql_pagi)) {
    while ($row = $sql_pagi->fetch_assoc()) {
        $tgl_p[] = $row['tanggal'];
        $suhu_p[] = $row['suhu'];
        $humi_p[] = $row['kelembapan'];
        $sensor_p[] = $row['name'];
    }
    $json_tgl_p = json_encode($tgl_p);
    $json_suhu_p = json_encode($suhu_p);
    $json_humi_p = json_encode($humi_p);
    $json_sensor_p = json_encode($sensor_p);
    $tanggal_pagi = str_replace(array('[', ']'), '', $json_tgl_p);
    $suhu_pagi = str_replace(array('[', ']'), '', $json_suhu_p);
    $kelembapan_pagi = str_replace(array('[', ']'), '', $json_humi_p);
    $sensor_pagi = str_replace(array('[', ']'), '', $json_sensor_p);
}
//SIANG
$sql_siang = mysqli_query($koneksi, "SELECT * FROM suhu LEFT JOIN sensor ON  suhu.sensor = sensor.id_sensor WHERE month(tanggal) = $bulan AND shift = 2 ORDER BY tanggal ASC;");
if (isset($sql_siang)) {
    while ($row = $sql_siang->fetch_assoc()) {
        $tgl_s[] = $row['tanggal'];
        $suhu_s[] = $row['suhu'];
        $humi_s[] = $row['kelembapan'];
        $sensor_s[] = $row['name'];
    }
    $json_tgl_s = json_encode($tgl_s);
    $json_suhu_s = json_encode($suhu_s);
    $json_humi_s = json_encode($humi_s);
    $json_sensor_s = json_encode($sensor_s);
    $tanggal_siang = str_replace(array('[', ']'), '', $json_tgl_s);
    $suhu_siang = str_replace(array('[', ']'), '', $json_suhu_s);
    $kelembapan_siang = str_replace(array('[', ']'), '', $json_humi_s);
    $sensor_siang = str_replace(array('[', ']'), '', $json_sensor_s);
}

//MALAM
$sql_malam = mysqli_query($koneksi, "SELECT * FROM suhu LEFT JOIN sensor ON  suhu.sensor = sensor.id_sensor WHERE month(tanggal) = $bulan AND shift = 3 ORDER BY tanggal ASC;");
if (isset($sql_malam)) {
    while ($row = $sql_malam->fetch_assoc()) {
        $tgl_m[] = $row['tanggal'];
        $suhu_m[] = $row['suhu'];
        $humi_m[] = $row['kelembapan'];
        $sensor_m[] = $row['name'];
    }
    $json_tgl_m = json_encode($tgl_m);
    $json_suhu_m = json_encode($suhu_m);
    $json_humi_m = json_encode($humi_m);
    $json_sensor_m = json_encode($sensor_m);
    $tanggal_malam = str_replace(array('[', ']'), '', $json_tgl_m);
    $suhu_malam = str_replace(array('[', ']'), '', $json_suhu_m);
    $kelembapan_malam = str_replace(array('[', ']'), '', $json_humi_m);
    $sensor_malam = str_replace(array('[', ']'), '', $json_sensor_m);
}
$sql_suhu_realtime = mysqli_query($koneksi, "select suhu from suhu where tanggal = CURRENT_DATE ORDER BY modified_date desc limit 1");
$suhu_realtime = mysqli_fetch_assoc($sql_suhu_realtime);

function namabulan($m)
{
    $dateObj   = DateTime::createFromFormat('!m', $m);
    $monthName = $dateObj->format('F'); // March
    return $monthName;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
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
                <div class="container-fluid px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                                    Dashboard
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-4 col-md-4">
                            <form action="index.php" method="GET">
                                <div class="mb-3">
                                    <label for="bulan" class="control-label">Bulan</label>
                                    <select class="form-control" id="bulan" name="bulan">
                                        <?php
                                        $queri = mysqli_query($koneksi, "SELECT DISTINCT month(tanggal) as bulan from suhu;");
                                        while ($querynama = mysqli_fetch_array($queri)) {
                                            if ($querynama['bulan'] == 1) {
                                                echo '<option value="1">Januari</option>';
                                            } elseif ($querynama['bulan'] == 2) {
                                                echo '<option value="2">Februari</option>';
                                            } elseif ($querynama['bulan'] == 3) {
                                                echo '<option value="3">Maret</option>';
                                            } elseif ($querynama['bulan'] == 4) {
                                                echo '<option value="4">April</option>';
                                            } elseif ($querynama['bulan'] == 5) {
                                                echo '<option value="5">Mei</option>';
                                            } elseif ($querynama['bulan'] == 6) {
                                                echo '<option value="6">Juni</option>';
                                            } elseif ($querynama['bulan'] == 7) {
                                                echo '<option value="7">Juli</option>';
                                            } elseif ($querynama['bulan'] == 8) {
                                                echo '<option value="8">Agustus</option>';
                                            } elseif ($querynama['bulan'] == 9) {
                                                echo '<option value="9">September</option>';
                                            } elseif ($querynama['bulan'] == 10) {
                                                echo '<option value="10">Oktober</option>';
                                            } elseif ($querynama['bulan'] == 8) {
                                                echo '<option value="11">November</option>';
                                            } else {
                                                echo '<option value="12">Desember</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group col-xs-4 col-md-4">
                            <label for="ruangan" class="control-label">Ruangan</label>
                            <select class="form-control" id="ruangan" name="ruangan">
                                <?php
                                $queri = mysqli_query($koneksi, "SELECT * from ruangan;");
                                while ($querynama = mysqli_fetch_array($queri)) {
                                    echo '<option value=' . $querynama["id_ruangan"] . '>' . $querynama['ruangan'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-2 col-md-2">
                            <label for="sensor" class="control-label">Sensor</label>
                            <select class="form-control" id="sensor" name="sensor">
                                <?php
                                $queri = mysqli_query($koneksi, "SELECT DISTINCT sensor.`id_sensor`, sensor.`name` FROM suhu INNER JOIN sensor ON suhu.sensor = sensor.id_sensor WHERE sensor IS NOT NULL;");
                                while ($querynama = mysqli_fetch_array($queri)) {
                                    echo '<option value=' . $querynama["id_sensor"] . '>' . $querynama['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-2 col-md-2">
                            <br />
                            <button class="btn btn-primary form-control" type="submit" name="cari">Tampilkan</button>
                        </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-fluid px-4 mt-n10">
                <?php
                $sql_suhu_realtime = mysqli_query($koneksi, "SELECT suhu, DATE_FORMAT(modified_date, '%H:%i:%s') as last_update FROM `suhu` ORDER BY modified_date desc limit 1");
                $suhu_realtime = mysqli_fetch_assoc($sql_suhu_realtime);
                $sql_kelembapan_realtime = mysqli_query($koneksi, "select kelembapan from suhu where tanggal = CURRENT_DATE ORDER BY modified_date desc limit 1");
                $kelembapan_realtime = mysqli_fetch_assoc($sql_kelembapan_realtime);
                ?>
                <div class="row">
                    <div class="col-sm-4 mb-4">
                        <div class="card h-100 lift lift-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class=" small">Suhu (Saat ini)</div>
                                        <div class="text-lg fw-bold"><?php echo $suhu_realtime['suhu'] ?> C</div>
                                    </div>
                                    <i style="font-size: 30px;" class="fa-regular fa-snowflake"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <a class="stretched-link" href="data.php">View Report</a>
                                <div><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-4">
                        <div class="card h-100 lift lift-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class="small">Kelembapan (Saat ini)</div>
                                        <div class="text-lg fw-bold"><?php echo $kelembapan_realtime['kelembapan'] ?> %</div>
                                    </div>
                                    <i style="font-size: 30px;" class="fa-solid fa-wind"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <a class="stretched-link" href="data.php">View Report</a>
                                <div><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-4">
                        <div class="card h-100 lift lift-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3">
                                        <div class=" small">Last Update</div>
                                        <div class="text-lg fw-bold"><?php echo $suhu_realtime['last_update'] ?></div>
                                    </div>
                                    <i style="font-size: 30px;" class="fa-solid fa-repeat"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between small">
                                <a class="stretched-link" href="data.php">View Report</a>
                                <div><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-icon mb-4">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-white-50">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg></div>
                        <div class="col">
                            <div class="card-body small">
                                Pengambilan data suhu
                                <hr>
                                <div class="step">
                                    <div class="step-item step-success">
                                        <a class="step-item-link" href="#!">Pagi (07.00)</a>
                                    </div>
                                    <div class="step-item">
                                        <a class="step-item-link" href="#!">Siang (14.00)</a>
                                    </div>
                                    <div class="step-item">
                                        <a class="step-item-link disabled" href="#!" tabindex="-1" aria-disabled="true">Malam (22.00)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                    <div class="col-lg-12">
                        <div class="card mb-4">

                            <div class="card-header border-bottom">
                                <!-- Dashboard card navigation-->
                                <ul class="nav nav-tabs card-header-tabs" id="dashboardNav" role="tablist">
                                    <li class="nav-item me-1"><a class="nav-link active" id="overview-pill" href="#overview" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">Suhu</a></li>
                                    <li class="nav-item"><a class="nav-link" id="activities-pill" href="#activities" data-bs-toggle="tab" role="tab" aria-controls="activities" aria-selected="false">Kelembaban</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="dashboardNavContent">
                                    <!-- Dashboard Tab Pane 1-->
                                    <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-pill">
                                        <canvas id="myAreaChart" width="1596" height="720" style="display: block; height: 320px; width: 998px;" class="chartjs-render-monitor"></canvas>
                                        <hr>
                                        <a id="download_suhu" download="ChartImage.jpg" href="" class="btn btn-primary btn-sm" style="text-align: right;" title="Download Chart">
                                            <i class="fa fa-download"></i>&nbsp;Download Grafik
                                        </a>
                                    </div>
                                    <div class="tab-pane fade show" id="activities" role="tabpanel" aria-labelledby="overview-pill">
                                        <canvas id="myAreaChart2" width="1596" height="720" style="display: block; height: 320px; width: 998px;" class="chartjs-render-monitor p-2"></canvas>
                                        <hr>
                                        <a id="download_kelembapan" download="ChartImage.jpg" href="" class="btn btn-primary btn-sm" style="text-align: right;" title="Download Chart">
                                            <i class="fa fa-download"></i>&nbsp;Download Grafik
                                        </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/1.30.1/date_fns.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        (Chart.defaults.global.defaultFontFamily = "Metropolis"),
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = "#858796";

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + "").replace(",", "").replace(" ", "");
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
                dec = typeof dec_point === "undefined" ? "." : dec_point,
                s = "",
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return "" + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || "").length < prec) {
                s[1] = s[1] || "";
                s[1] += new Array(prec - s[1].length + 1).join("0");
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [<?php echo $tanggal_pagi; ?>],
                datasets: [{
                        label: "Pagi",
                        lineTension: 0.1,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(75, 192, 192, 1)",
                        pointBorderColor: "rgba(75, 192, 192, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(75, 192, 192, 1)",
                        pointHoverBorderColor: "rgba(75, 192, 192, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            <?php echo $suhu_pagi; ?>
                        ],
                        petugasName: [
                            <?php echo $sensor_pagi; ?>
                        ]
                    },
                    {
                        label: "Siang",
                        lineTension: 0.1,
                        backgroundColor: 'rgba(255, 206, 86, 0.1)',
                        borderColor: "rgba(255, 206, 86, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(255, 206, 86, 1)",
                        pointBorderColor: "rgba(255, 206, 86, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(255, 206, 86, 1)",
                        pointHoverBorderColor: "rgba(255, 206, 86, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            <?php echo $suhu_siang; ?>
                        ],
                        petugasName: [
                            <?php echo $sensor_siang; ?>
                        ]
                    }, {
                        label: "Malam",
                        lineTension: 0.1,
                        backgroundColor: "rgba(0, 97, 242, 0.1)",
                        borderColor: "rgba(0, 97, 242, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(0, 97, 242, 1)",
                        pointBorderColor: "rgba(0, 97, 242, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
                        pointHoverBorderColor: "rgba(0, 97, 242, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            <?php echo $suhu_malam; ?>
                        ],
                        petugasName: [
                            <?php echo $sensor_malam; ?>
                        ]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: <?php echo '"' . 'Pemantauan Suhu Ruangan Server ' . namabulan($bulan) . ' ' . date('Y') . '"'; ?>
                },
                maintainAspectRatio: true,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 25
                    }
                },
                scales: {
                    xAxes: [{
                        display: true,
                        type: 'time',
                        time: {
                            parser: 'yyyy-mm-dd',
                            tooltipFormat: 'd/mm/y',
                            unit: 'day',
                            unitStepSize: 1,
                            displayFormats: {
                                'month': 'm'
                            }
                        },
                        gridLines: {
                            display: true,
                            drawBorder: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            suggestedMin: 10,
                            suggestedMax: 35,
                            stepSize: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value) + " ℃";
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: true,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }]
                },
                legend: {
                    display: true
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: "#6e707e",
                    titleFontSize: 14,
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: "index",
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel =
                                chart.datasets[tooltipItem.datasetIndex].label || "";
                            var petugas =
                                chart.datasets[tooltipItem.datasetIndex].petugasName || "";

                            return '[' + petugas[tooltipItem.index] + '] ' + datasetLabel + " : " + number_format(tooltipItem.yLabel) + ' ℃';
                        }
                    }
                }
            }
        });

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart2");
        var myLineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [<?php echo $tanggal_pagi; ?>],
                datasets: [{
                        label: "Pagi",
                        lineTension: 0.1,
                        backgroundColor: "rgba(204, 255, 255, 0.2)",
                        borderColor: "rgba(204, 255, 255, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(204, 255, 255, 1)",
                        pointBorderColor: "rgba(204, 255, 255, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(204, 255, 255, 1)",
                        pointHoverBorderColor: "rgba(204, 255, 255, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            <?php echo $kelembapan_pagi; ?>
                        ],
                        petugasName: [
                            <?php echo $sensor_pagi; ?>
                        ]
                    },
                    {
                        label: "Sore",
                        lineTension: 0.1,
                        backgroundColor: 'rgba(153, 204, 255, 0.2)',
                        borderColor: "rgba(153, 204, 255, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(153, 204, 255, 1)",
                        pointBorderColor: "rgba(153, 204, 255, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(153, 204, 255, 1)",
                        pointHoverBorderColor: "rgba(153, 204, 255, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            <?php echo $kelembapan_siang; ?>
                        ],
                        petugasName: [
                            <?php echo $sensor_siang; ?>
                        ]
                    },
                    {
                        label: "Malam",
                        lineTension: 0.1,
                        backgroundColor: "rgba(204, 153, 255, 0.2)",
                        borderColor: "rgba(204, 153, 255, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(204, 153, 255, 1)",
                        pointBorderColor: "rgba(204, 153, 255, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(204, 153, 255, 1)",
                        pointHoverBorderColor: "rgba(204, 153, 255, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            <?php echo $kelembapan_malam; ?>
                        ],
                        petugasName: [
                            <?php echo $sensor_malam; ?>
                        ]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: <?php echo '"' . 'Pemantauan Kelembaban Ruangan Server ' . namabulan($bulan) . ' ' . date('Y') . '"'; ?>
                },
                maintainAspectRatio: true,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 25
                    }
                },
                scales: {
                    xAxes: [{
                        display: true,
                        type: 'time',
                        time: {
                            parser: 'yyyy-mm-dd',
                            tooltipFormat: 'd/mm/y',
                            unit: 'day',
                            unitStepSize: 1,
                            displayFormats: {
                                'month': 'm'
                            }
                        },
                        gridLines: {
                            display: true,
                            drawBorder: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            suggestedMin: 40,
                            suggestedMax: 80,
                            stepSize: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return number_format(value) + " %";
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: true,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }]
                },
                legend: {
                    display: true
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: "#6e707e",
                    titleFontSize: 14,
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: "index",
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel =
                                chart.datasets[tooltipItem.datasetIndex].label || "";
                            var petugas =
                                chart.datasets[tooltipItem.datasetIndex].petugasName || "";

                            return '[' + petugas[tooltipItem.index] + '] ' + datasetLabel + " : " + number_format(tooltipItem.yLabel) + ' %';
                        }
                    }
                }
            }
        });
    </script>
    <script>
        document.getElementById("download_suhu").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("myAreaChart").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("download_suhu");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
        document.getElementById("download_kelembapan").addEventListener('click', function() {
            /*Get image of canvas element*/
            var url_base64jp = document.getElementById("myAreaChart2").toDataURL("image/jpg");
            /*get download button (tag: <a></a>) */
            var a = document.getElementById("download_kelembapan");
            /*insert chart image url to download button (tag: <a></a>) */
            a.href = url_base64jp;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables/datatables-simple-demo.js"></script>
</body>

</html>