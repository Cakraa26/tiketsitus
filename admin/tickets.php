<?php
require_once "../libs/database.php";
require_once "../libs/pagination.php";

try {
    $currentPage = intval($_GET["page"] ?? 1);
    $perPage = 10;
    $tickets = get_paginated_data('tickets', '*', $perPage, $currentPage);
} catch (\Throwable $th) {
    die($th->getMessage());
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <script src="https://kit.fontawesome.com/fa734f2cc6.js" crossorigin="anonymous"></script> 
  </head>

<body>

    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: #34a0a4;">
        <div class="container">
            <a class="navbar-brand" href="index.html">Tiket</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <a class="btn btn-outline-light ms-auto" href="login.html" role="button">Admin</a>
            </div>
        </div>
    </nav>
    <!-- navbar end -->


    <!-- main start -->
    <main class="full-page">
        <div class="container">
            <h1 class="mt-4 mb-4 h3 text-center">Kelola Tiket</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Maskapai</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (! $tickets || $tickets->num_rows === 0) : ?>
                                <tr>
                                    <td colspan="4" class="text-center">No data</td>
                                </tr>
                            <?php else : ?>
                                <?php $index = 0;?>

                                <?php while ($ticket = mysqli_fetch_assoc($tickets)) : ?>
                                    <tr>
                                        <td>
                                            <?= make_pagination_numbering($perPage, $currentPage, $index) ?>
                                            <?php $index++ ?>
                                        </td>
                                        <td>
                                            <?= $ticket['maskapai'] ?>
                                        </td>
                                        <td>
                                            Rp. <?= $ticket['harga'] ?>
                                        </td>
                                        <td class="text-nowrap" style="width: 1%;">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#ticket-<?= $ticket['id'] ?>" class="btn btn-outline-primary btn-sm">Detail</button>
                                            <a href="../product-form.html" class="btn btn-outline-warning btn-sm">Edit</a>
                                            <button class="btn btn-outline-danger btn-sm">Delete</button>

                                            <div class="modal fade" id="ticket-<?= $ticket['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?= $ticket['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title fs-5" id="exampleModalLabel-<?= $ticket['id'] ?>">
                                                                <?= $ticket['maskapai'] ?>
                                                            </h2>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <img class="img-fluid" style="width: 300px;" src="<?= $ticket['imgurl'] ?>" alt="">
                                                            </div>
                                                            <hr>
                                                            <p class="text-wrap">
                                                                <?= $ticket['asal'] ?>
                                                            </p>
                                                            <p class="text-wrap">
                                                                <?= $ticket['tujuan'] ?>
                                                            </p>
                                                            <h4 class="fw-bold text-center">Rp
                                                                <?= $ticket['harga'] ?>
                                                            </h4>
                                                            <p class="text-wrap">
                                                                <?= $ticket['deskripsi'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?= build_pagination(100, $perPage, $currentPage) ?>
        </div>
    </main>
    <!-- main end -->


    <!-- footer start -->
    <footer>
    <div class="container">
      <div class="row py-4">
        <div class="col-12 col-lg-4">
          <h4>Deskripsi Offline Office</h4>
          <ul>
            <li>Jalan Tukad Yeh Aya</li>
            <li>+62817838887384</li>
            <li>ticket@gmail.com</li>
          </ul>
        </div>
        <div class="col-12 col-lg-4">
          <h4>Menu</h4>
          <ul>
            <li>
              <a href="#">Beranda</a>
            </li>
            <li>
              <a href="#">Tiket</a>
            </li>
            <li>
              <a href="#">Kunjungan Terbaik</a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-lg-4">
          <h4>Ikuti Kami</h4>
          <ul>
            <li>
              <a href="">
                <p><i class="fa-solid fa-globe"></i>ticketcakra.com</p>
              </a>
            </li>
            <li>
              <a href="">
                <p><i class="fa-brands fa-tiktok"></i>ticketcakra_tiktok</p>
              </a>
            </li>
            <li>
              <a href="">
                <p><i class="fa-brands fa-instagram"></i>ticketcakra</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="text-center border-top">&copy; Cakra's Ticket.</div>
    </div>
  </footer>
    <!-- footer end -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>