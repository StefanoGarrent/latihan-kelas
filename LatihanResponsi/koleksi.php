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
    <title>Koleksi Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="koleksi-body">
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #3153bb;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pustaka Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Koleksi Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Peminjaman</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a href="logout.php" class="btn btn-light text-dark"><span><i class="bi bi-box-arrow-right"></i></span> Keluar</a>
            </span>
            </div>
        </div>
    </nav>
    
    <section class="koleksi-content">
        <div class="koleksi-container">
            <div class="koleksi-judul mt-4 mb-4 text-center">
                <h1>Koleksi Buku</h1>
            </div>
            <div class="koleksi-button mb-2 text-end">
                <a href="#" class="btn btn-secondary "><span><i class="bi bi-plus"></i></span> Tambah Koleksi</a>
            </div>
            <div class="koleksi-table">
                <table class="table shadow-lg rounded overflow-hidden">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Kode Buku</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'koneksi.php';  
                            $query = "SELECT * FROM buku";
                            $result = mysqli_query($conn, $query);
                            $id = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $id; ?></th>
                            <td><?php echo $row['kode_buku']; ?></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['pengarang']; ?></td>
                            <td><?php echo $row['kategori']; ?></td>
                            <td><?php echo $row['stok']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success">Edit</a> 
                                <a href="#" class="btn btn-sm btn-warning">Hapus</a>
                            </td>
                        </tr>
                        <?php
                            $id++;
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