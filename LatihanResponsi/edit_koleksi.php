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
  <body class="edit-body">
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
    
    <section class="edit-content">
        <?php
        include 'koneksi.php';
        $id = $_GET['id'];
        $query = "SELECT * FROM buku WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
        } else {
            echo "Data tidak ditemukan.";
            exit();
        }
        $kode_buku = $data['kode_buku'];
        $judul = $data['judul'];
        $pengarang = $data['pengarang'];
        $kategori = $data['kategori'];
        $stok = $data['stok'];

        ?>
        <div class="edit-container mt-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title text-center">Form Edit Buku</h2>
                </div>
                <div class="card-body">
                    <form action="edit_proses_koleksi.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="id">ID Buku</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $id; ?>" disabled>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kode Buku</label>
                                <input type="text" name="kode_buku" class="form-control" placeholder="Contoh: BK001" value="<?php echo $kode_buku; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Stok</label>
                                <input type="number" name="stok" class="form-control" min="1" placeholder="Minimal 1" value="<?php echo $stok; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $pengarang; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="Fiksi" <?php echo ($kategori == 'Fiksi') ? 'selected' : ''; ?>>Fiksi</option>
                                <option value="Teknologi" <?php echo ($kategori == 'Teknologi') ? 'selected' : ''; ?>>Teknologi</option>
                                <option value="Sejarah" <?php echo ($kategori == 'Sejarah') ? 'selected' : ''; ?>>Sejarah</option>
                                <option value="Sains" <?php echo ($kategori == 'Sains') ? 'selected' : ''; ?>>Sains</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-secondary" type="button" onclick="window.location.href='koleksi.php'">Kembali</button>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>            
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>