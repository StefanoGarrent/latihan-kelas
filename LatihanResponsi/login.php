<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="login-body">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="card p-3">
              <div class="card-header text-center">
                  <h3>Pustaka Digital</h3>
                  <p>Sistem Perpustakaan Nasional</p>
              </div>
              <div class="card-body">
                <form action="proses_login.php" method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Masuk</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>