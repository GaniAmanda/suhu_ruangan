<?php require './cek-sesi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Alkes & Alum</title>
    <?php include './style.php' ?>
    <style>
        body {
            background-image: url("data:image/svg+xml,%3Csvg width='100%' height='100%' id='svg' viewBox='0 0 1440 700' xmlns='http://www.w3.org/2000/svg' class='transition duration-300 ease-in-out delay-150'%3E%3Cdefs%3E%3ClinearGradient id='gradient' x1='0%25' y1='50%25' x2='100%25' y2='50%25'%3E%3Cstop offset='5%25' stop-color='%23002bdc'%3E%3C/stop%3E%3Cstop offset='95%25' stop-color='%230693e3'%3E%3C/stop%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M 0 700 C 0 700 0 233 0 233 C 48.971833578792356 254.15058910162003 97.94366715758471 275.30117820324006 153 300 C 208.0563328424153 324.69882179675994 269.1971649484536 352.94587628865975 335 318 C 400.8028350515464 283.05412371134025 471.26767304860095 184.91531664212079 542 146 C 612.732326951399 107.0846833578792 683.7321428571428 127.39285714285711 749 169 C 814.2678571428572 210.6071428571429 873.8037555228279 273.51325478645066 929 273 C 984.1962444771721 272.48674521354934 1035.0528350515463 208.5541237113402 1088 192 C 1140.9471649484537 175.4458762886598 1195.9849042709868 206.27025036818853 1255 221 C 1314.0150957290132 235.72974963181147 1377.0075478645067 234.36487481590575 1440 233 C 1440 233 1440 700 1440 700 Z' stroke='none' stroke-width='0' fill='url(%23gradient)' fill-opacity='0.53' class='transition-all duration-300 ease-in-out delay-150 path-0'%3E%3C/path%3E%3Cdefs%3E%3ClinearGradient id='gradient' x1='0%25' y1='50%25' x2='100%25' y2='50%25'%3E%3Cstop offset='5%25' stop-color='%23002bdc'%3E%3C/stop%3E%3Cstop offset='95%25' stop-color='%230693e3'%3E%3C/stop%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M 0 700 C 0 700 0 466 0 466 C 62.301362297496325 504.0758468335788 124.60272459499265 542.1516936671576 180 545 C 235.39727540500735 547.8483063328424 283.8904639175258 515.4690721649483 336 487 C 388.1095360824742 458.5309278350516 443.83541973490424 433.9720176730486 515 439 C 586.1645802650958 444.0279823269514 672.7678571428572 478.64285714285717 732 469 C 791.2321428571428 459.35714285714283 823.0931516936672 405.4565537555228 882 418 C 940.9068483063328 430.5434462444772 1026.8595360824743 509.53092783505156 1085 506 C 1143.1404639175257 502.46907216494844 1173.4687039764362 416.41973490427097 1228 396 C 1282.5312960235638 375.58026509572903 1361.2656480117819 420.7901325478645 1440 466 C 1440 466 1440 700 1440 700 Z' stroke='none' stroke-width='0' fill='url(%23gradient)' fill-opacity='1' class='transition-all duration-300 ease-in-out delay-150 path-1'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">

                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                <div class="glitch-wrapper p-2">
                                        <div class="glitch" data-glitch="Temp & Hum.">Temp & Hum.</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php include 'alert.php' ?>
                                    <!-- Login form-->
                                    <form action="./proses-register.php" method="POST">
                                        <!-- Form Row-->
                                        <div class="row gx-3">

                                            <!-- Form Group (first name)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="nama">Nama</label>
                                                <input class="form-control" id="nama" name="nama" type="text" placeholder="Nama Anda" />
                                            </div>
                                        </div>
                                        <!-- Form Group (email address)            -->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="email">Email</label>
                                            <input class="form-control" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Masukan alamat email" />
                                        </div>
                                        <!-- Form Row    -->
                                        <div class="row gx-3">
                                            <!-- Form Group (password)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Masukan password" />
                                            </div>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <button class="btn btn-primary btn-block" type="submit" name="register">Buat Account</button>
                                        <a href="./auth-login.php" class="btn btn-success btn-block">Login</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
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
</body>

</html>