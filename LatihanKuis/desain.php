<?php
    session_start();
    if($_SESSION['status'] != "login"){
        $_GET['message'] = "belumLogin";
        session_destroy();
        header('Location: login.php?message=belumLogin');
    }
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
                    <a class="nav-link" href="login.php">Daftar</a>
                    <a class="nav-link active" aria-current="page" href="desain.php">Design</a>
                </div>
                </div>
            </div>
        </nav>
    </header>


    <section class="section-title container mt-5">
        <div class="title">
            <h1 class="mb-5"><i>Design Laboratory</i></h1>
            <p><strong>Image Effects</strong></p>
        </div>
    </section>

    <section class="design container">
        <div class="design image">
            <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTwDrsU9hcApOyAASDaPqSw-Va_uXWbaTRI5CKyNHNbDfoG2LsU" alt="Kucing Lucu">
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>