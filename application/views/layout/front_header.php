<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fabricare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--slick css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!--icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= base_url('assets/frontend/') ?>css/style.css" rel="stylesheet" >
    <script>
      var baseurl = "<?= base_url();?>";
      var pincode = "<?= $this->session->userdata('pincode');?>";
    </script>
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark bg-theme shadow-sm" aria-label="header">
      <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">
          <img src="<?= base_url('assets/frontend/') ?>images/logo.svg">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample04" style="">
          <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('about') ?>">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('services') ?>">Our Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('contact') ?>">Contact Us</a>
            </li>
          </ul>
          <span class="ms-md-4">
            <a href="<?= base_url('schedule-pickup'); ?>" class="btn btn-ouline-theme rounded-pill px-4 fw-semibold">Schedule Pickup</a>
          </span>
        </div>

        <span class="position-relative">
          <a href="<?= base_url('cart');?>" class="text-theme-light cart ps-4"><i class="bi bi-bag"></i></a>
          <span class="cart-count">0</span>
        </span>
        <span class="userlogin">
          <?php if(loggedId()){ ?>
            <span class="dropdown">
              <a class="btn text-theme-light username dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle pe-2"></i> Hi, <?= $this->session->name;?>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item" href="#">Orders History</a></li>
                <li><a class="dropdown-item" href="<?= base_url('doLogout');?>">Logout</a></li>
              </ul>
            </span>
            <?php } else{ ?>
              <a href="<?= base_url('login'); ?>" class="btn text-theme-light username d-flex align-items-center" type="button">
                <i class="bi bi-person-circle pe-2"></i> Login
              </a>
            <?php } ?>
        </span>
      </div>
    </nav>
