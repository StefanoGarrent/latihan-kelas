<?php
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <header>
        <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><strong>Komunitas Kucing</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link active" aria-current="page" href="login.php">Daftar</a>
                    <a class="nav-link" href="desain.php">Design</a>
                </div>
                </div>
            </div>
        </nav>
    </header>

    <?php
        if(isset($_GET['message'])){
            if($_GET['message'] == "belumLogin"){
                echo "<div class='alert alert-danger text-center' role='alert'>Anda harus login terlebih dahulu!</div>";
            }
            else if($_GET['message'] == "berhasilDaftar"){
                echo "<div class='alert alert-success text-center' role='alert'>Pendaftaran berhasil! Selamat datang di Komunitas Kucing.</div>";
            } 
            else if($_GET['message'] == "akunSudahTerdaftar"){
                echo "<div class='alert alert-warning text-center' role='alert'>Anda sudah memiliki akun! Anda bisa mengakses halaman desain.</div>";
            }
        }
    ?> 

    <section class="title-daftar mt-4 mb-4 text-center">
        <h1>Pendaftaran Komunitas Kucing</h1>
    </section>

    <section class="form-container mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="login_proses.php">
                                <table class="table">
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>
                                            <input type="text" name="nama_lengkap" class="form-control" aria-describedby="addon-wrapping" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>
                                            <input id="startDate" name="tanggal_lahir" class="form-control" type="date" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelompok Umur</td>
                                        <td>
                                            <select class="form-select" name="kelompok_umur" id="inputGroupSelect01" required>
                                                <option value="" selected disabled>Pilih kelompok umur</option>
                                                <option value="anak">Anak</option>
                                                <option value="remaja">Remaja</option>
                                                <option value="dewasa">Dewasa</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-Laki" id="radioDefault1" required>
                                                <label class="form-check-label" for="radioDefault1">
                                                    Laki-Laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="radioDefault2">
                                                <label class="form-check-label" for="radioDefault2">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hobi</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hobi[]" value="Main Game" id="checkDefault1">
                                                <label class="form-check-label" for="checkDefault1">Main Game</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hobi[]" value="Ngoding" id="checkDefault2" >
                                                <label class="form-check-label" for="checkDefault2">Ngoding</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hobi[]" value="Bermain Dengan Kucing" id="checkDefault3">
                                                <label class="form-check-label" for="checkDefault3">Bermain Dengan Kucing</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Asal Daerah</td>
                                        <td>
                                            <input type="text" name="asal_daerah" class="form-control" aria-describedby="addon-wrapping" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alasan Ingin Bergabung</td>
                                        <td>
                                            <textarea class="form-control" name="alasan_bergabung" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-success">KIRIM PENDAFTARAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>