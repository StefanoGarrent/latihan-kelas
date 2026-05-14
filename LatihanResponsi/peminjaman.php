<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: login.php?pesan=belum_login");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjaman Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="peminjaman-body">
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #3153bb;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pustaka Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="koleksi.php">Koleksi Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="peminjaman.php">Peminjaman</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a href="logout.php" class="btn btn-light text-dark"><span><i class="bi bi-box-arrow-right"></i></span> Keluar</a>
            </span>
            </div>
        </div>
    </nav>
    
    <section class="peminjaman-content">
        <div class="peminjaman-container">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="peminjaman-judul mt-4 mb-4 text-center">
                <h1>Database Peminjaman</h1>
            </div>
            <div class="peminjaman-button mb-2 text-end">
                <a href="catat_peminjaman.php" class="btn btn-secondary"><span><i class="bi bi-file-earmark-plus"></i></span> Catat Peminjaman</a>
            </div>
            <div class="peminjaman-table">
                <table class="table shadow-lg rounded overflow-hidden">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Peminjaman</th>
                            <th scope="col">Peminjam</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'koneksi.php';  
                            $queryTampil = "SELECT * FROM peminjaman";
                            $resultTampil = mysqli_query($conn, $queryTampil);
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($resultTampil)) {
                                $id_buku = $row['id_buku'];     
                                                           
                                $ambilJudulBuku = "SELECT judul FROM buku WHERE id='$id_buku'";
                                $resultJudul = mysqli_query($conn, $ambilJudulBuku);
                                $dataJudul = mysqli_fetch_assoc($resultJudul);
                                ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><?php echo $row['kode_peminjaman']; ?></td>
                            <td><?php echo $row['peminjam']; ?></td>
                            <td><?php echo $dataJudul['judul']; ?></td>
                            <td><?php echo $row['tanggal_pinjam']; ?></td>
                            <td><?php echo $row['tanggal_kembali']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <?php 
                                if ($row['status'] == 'Dipinjam') { ?>
                                    <a href="kembali_proses.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Kembalikan</a>
                                <?php } else { ?>
                                    <button class="btn btn-success btn-sm" disabled>Selesai</button>
                                 <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                            $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>