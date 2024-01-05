<?php

require_once "../libs/validation.php";
require_once "../libs/database.php";

    $errors = [];
    $actionResult = '';

    if(count($_POST) > 0){
      $validationRules = [
        'imgurl' => ['required', 'is_valid_url'],
        'asal' => ['required'],
        'tujuan' => ['required'],
        'maskapai' => ['required', 'min_length:5', 'max_length:100'],
        'harga' => ['required', 'min_value:200000'],
        'deskripsi' => ['required', 'min_length:10', 'max_length:1000'],
      ];

      $errors = form_validation($_POST, $validationRules);

      if (count ($errors) === 0){
        $result = insert_data('tickets', $_POST);

        if($result){
          $actionResult = 'Data berhasil disimpan!';
        } else {
          $actionResult = 'Tidak dapat menemukan data, terdapat kesalahan';
        }
      }
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
  
         <!-- main: start -->
    <main class="full-page">
        <div class="container py-5">
          <div class="row justify-content-center">
            <div class="col-12 col-lg-5">
              <div class="card shadow rounded-4">
                <div class="card-body">
                  <h4 class="text-center mb-4">Tambah Tiket</h4>
                  <hr />
                  <form action="" method="post">
                    <div role="alert" class="alert alert-danger">
                      <?= $actionResult?>
                    </div>
                    <div class="mb-3">
                      <label for="inputImage" class="form-label">Gambar URL</label>
                      <input
                        type="text"
                        class="form-control"
                        id="inputImage"
                        placeholder="masukkan url gambar"
                        name="imgurl"
                      />
                      <?php if (key_exists('imgurl', $errors) && count($errors['imgurl']) > 0): ?>
                        <?php foreach ($errors ['imgurl'] as $key => $error) :?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                    </div>
  
                    <div class="mb-3">
                      <label for="inputName" class="form-label"
                        >Asal</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="inputName"
                        placeholder="masukkan kota keberangkatan"
                        name="asal"
                      />
                      <?php if (key_exists('asal', $errors) && count($errors['asal']) > 0): ?>
                        <?php foreach ($errors ['asal'] as $key => $error) :?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                    </div>

                    <div class="mb-3">
                      <label for="inputName" class="form-label"
                        >Tujuan</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="inputName"
                        placeholder="masukkan kota tujuan"
                        name="tujuan"
                      />
                      <?php if (key_exists('tujuan', $errors) && count($errors['tujuan']) > 0): ?>
                        <?php foreach ($errors ['tujuan'] as $key => $error) :?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                    </div>

                    <div class="mb-3">
                      <label for="inputName" class="form-label"
                        >Maskapai</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="inputName"
                        placeholder="cth: Lion Air - ABC123"
                        name="maskapai"
                      />
                      <?php if (key_exists('maskapai', $errors) && count($errors['maskapai']) > 0): ?>
                        <?php foreach ($errors ['maskapai'] as $key => $error) :?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                    </div>
  
                    <div class="mb-3">
                      <label for="inputPrice" class="form-label"
                        >Harga</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="inputPrice"
                        placeholder="masukkan harga tiket"
                        name="harga"
                      />
                      <?php if (key_exists('harga', $errors) && count($errors['harga']) > 0): ?>
                        <?php foreach ($errors ['harga'] as $key => $error) :?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                    </div>
  
                    <div class="mb-3">
                      <label for="inputDescription" class="form-label"
                        >Deskripsi</label>
                      <textarea
                        class="form-control"
                        id="inputDescription"
                        rows="3"
                        placeholder="tambahkan deskripsi bila ada"
                        name="deskripsi"
                      ></textarea>
                      <?php if (key_exists('deskripsi', $errors) && count($errors['deskripsi']) > 0): ?>
                        <?php foreach ($errors ['deskripsi'] as $key => $error) :?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                    </div>
  
                    <div class="d-flex justify-content-between">
                      <button class="btn btn-secondary px-4">Batal</button>
                      <button class="btn btn-primary px-4">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- main: end -->
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