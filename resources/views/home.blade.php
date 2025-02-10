<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>E-Ticketing - Pesan Tiket Pesawat Online</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="vendors/plyr/plyr.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-holder{
            background-image:url(assets/img/hero-bg.jpg);background-position:center;background-size:cover;
        }

        .bg-holder::before {
          content: "";
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5); /* Sesuaikan transparansi */
      }

      .hero-text {
      text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6); /* Efek shadow lebih terlihat */
      }


    </style>

  </head>


  <body>
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg fixed-top py-3 backdrop" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="#">
            <i class="fas fa-plane-departure text-primary me-2"></i>
            <span class="text-primary">E-Ticketing</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
              <li class="nav-item"><a class="nav-link" href="#destinations">Destinasi</a></li>
              <li class="nav-item"><a class="nav-link" href="#booking">Booking</a></li>
              @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
              @else
                <li class="nav-item"><a class="btn btn-primary ms-2" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="btn btn-outline-primary ms-2" href="{{ route('register') }}">Register</a></li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>
      <section class="py-1" id="home">
        <div class="bg-holder" style="">
        </div>
        <div class="container position-relative">
          <div class="row align-items-center min-vh-75 my-lg-8">
            <div class="col-md-7 col-lg-6 text-md-start text-center py-8">
              <h1 class="display-1 text-white fw-bold mb-4 hero-text">Jelajahi Dunia<br/>Bersama Kami</h1>
              <p class="lead text-white mb-5 hero-text">Temukan pengalaman perjalanan terbaik dengan layanan pemesanan tiket pesawat online kami.</p>
              <a class="btn btn-lg btn-primary" href="{{ route('register') }}">Mulai Sekarang</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Features Section -->
      <section class="py-7" id="features">
        <div class="container">
          <div class="row justify-content-center text-center mb-6">
            <div class="col-lg-6">
              <h2 class="fw-bold">Kenapa Memilih Kami?</h2>
              <p class="lead">Nikmati berbagai keuntungan memesan tiket pesawat bersama kami</p>
            </div>
                            </div>
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-lg">
                <div class="card-body text-center p-5">
                  <i class="fas fa-ticket-alt fa-3x text-primary mb-3"></i>
                  <h4 class="fw-bold">Booking Mudah</h4>
                  <p>Proses pemesanan tiket yang cepat dan mudah</p>
                          </div>
                        </div>
                      </div>
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-lg">
                <div class="card-body text-center p-5">
                  <i class="fas fa-dollar-sign fa-3x text-primary mb-3"></i>
                  <h4 class="fw-bold">Harga Terbaik</h4>
                  <p>Dapatkan harga tiket pesawat termurah</p>
                            </div>
                          </div>
                        </div>
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-lg">
                <div class="card-body text-center p-5">
                  <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                  <h4 class="fw-bold">24/7 Support</h4>
                  <p>Layanan pelanggan siap membantu 24 jam</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
      </section>

      <!-- Destinations Section -->
      <section class="py-7 bg-light" id="destinations">
        <div class="container">
          <div class="row justify-content-center text-center mb-6">
            <div class="col-lg-6">
              <h2 class="fw-bold">Destinasi Populer</h2>
              <p class="lead">Jelajahi berbagai destinasi menarik di seluruh Indonesia</p>
                            </div>
                          </div>
          <div class="row">
            <!-- Maldives -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 text-white hover-top">
                <img class="img-fluid" src="assets/img/gallery/maldives.png" alt="Maldives">
                          <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                  <div class="pt-3">
                    <span class="badge bg-primary">Rp 8.600.000</span>
                  </div>
                            <div class="ps-3 d-flex justify-content-between align-items-center">
                              <h5 class="text-white">Maldives</h5>
                              <h6 class="text-600">3 days</h6>
                            </div>
                          </div>
                        </div>
                      </div>

            <!-- Indonesia -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 text-white hover-top">
                <img class="img-fluid" src="assets/img/gallery/indonesia.png" alt="Indonesia">
                          <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                  <div class="pt-3">
                    <span class="badge bg-primary">Rp 5.600.000</span>
                  </div>
                            <div class="ps-3 d-flex justify-content-between align-items-center">
                              <h5 class="text-white">Indonesia</h5>
                              <h6 class="text-600">7 days</h6>
                            </div>
                          </div>
                        </div>
                      </div>

            <!-- Kathmandu -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 text-white hover-top">
                <img class="img-fluid" src="assets/img/gallery/kathmandu.png" alt="Kathmandu">
                <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                  <div class="pt-3">
                    <span class="badge bg-primary">Rp 3.400.000</span>
                  </div>
                  <div class="ps-3 d-flex justify-content-between align-items-center">
                    <h5 class="text-white">Kathmandu</h5>
                    <h6 class="text-600">5 days</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Travel Categories Section -->
      <section class="pt-5">
        <div class="container">
          <div class="row flex-center mb-5">
            <div class="col-lg-8 text-center">
              <h1 class="fw-bold fs-md-3 fs-lg-4 fs-xl-5">Travel categories</h1>
              <hr class="mx-auto text-primary my-4" style="height:3px; width:70px;" />
            </div>
          </div>
          <div class="row h-100 flex-center">
            <div class="row flex-lg-center">
              <div class="col-md-12">
                      <div class="row h-100">
                  <!-- Food -->
                        <div class="col-6 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                    <div class="card h-100 w-100 text-white">
                      <a class="stretched-link" href="#!">
                        <img class="img-fluid" src="assets/img/gallery/food.png" alt="Food" />
                      </a>
                            <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                              <h5 class="text-white fs--1">Food</h5>
                            </div>
                          </div>
                        </div>

                  <!-- Backpacking -->
                        <div class="col-6 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                    <div class="card h-100 w-100 text-white">
                      <a class="stretched-link" href="#!">
                        <img class="img-fluid" src="assets/img/gallery/backpacking.png" alt="Backpacking" />
                      </a>
                            <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                              <h5 class="text-white fs--1">Backpacking</h5>
                      </div>
                    </div>
                  </div>

                  <!-- Beaches -->
                  <div class="col-6 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                    <div class="card h-100 w-100 text-white">
                      <a class="stretched-link" href="#!">
                        <img class="img-fluid" src="assets/img/gallery/beaches.png" alt="Beaches" />
                      </a>
                      <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                        <h5 class="text-white fs--1">Beaches</h5>
                      </div>
                    </div>
                  </div>

                  <!-- Art & Culture -->
                  <div class="col-6 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                    <div class="card h-100 w-100 text-white">
                      <a class="stretched-link" href="#!">
                        <img class="img-fluid" src="assets/img/gallery/art-culture.png" alt="Art & Culture" />
                      </a>
                      <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                        <h5 class="text-white fs--1">Art & Culture</h5>
                      </div>
                    </div>
                  </div>

                  <!-- Wildlife -->
                  <div class="col-6 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                    <div class="card h-100 w-100 text-white">
                      <a class="stretched-link" href="#!">
                        <img class="img-fluid" src="assets/img/gallery/wild.png" alt="Wildlife" />
                      </a>
                      <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                        <h5 class="text-white fs--1">Wildlife</h5>
                      </div>
                    </div>
                  </div>

                  <!-- Hill Nature -->
                  <div class="col-6 col-sm-4 col-xl-2 mb-3 hover-top px-2">
                    <div class="card h-100 w-100 text-white">
                      <a class="stretched-link" href="#!">
                        <img class="img-fluid" src="assets/img/gallery/hill.jpg" alt="Hill Nature" />
                      </a>
                      <div class="card-img-overlay d-flex align-items-end bg-dark-gradient">
                        <h5 class="text-white fs--1">Hill Nature</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Booking Section -->
      <section class="py-7" id="booking">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h2 class="fw-bold mb-5">Mulai Perjalanan Anda</h2>
              <a href="{{ route('tiket.list') }}" class="btn btn-lg btn-primary">Cari Tiket Sekarang</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer Section -->
      <footer class="pt-7 pb-4 bg-dark text-white">
        <div class="container">
          <div class="row mb-5">
            <!-- Company Info -->
            <div class="col-lg-4 mb-4">
              <a class="d-flex align-items-center mb-3" href="#">
                <i class="fas fa-plane-departure text-primary me-2 fa-2x"></i>
                <h3 class="text-white mb-0">E-Ticketing</h3>
              </a>
              <p class="text-muted">Sistem pemesanan tiket pesawat online terpercaya dengan harga terbaik dan pelayanan 24/7.</p>
              <div class="d-flex gap-3 mt-4">
                <a href="#" class="text-white hover-primary">
                  <i class="fab fa-facebook-f fa-lg"></i>
                </a>
                <a href="#" class="text-white hover-primary">
                  <i class="fab fa-twitter fa-lg"></i>
                </a>
                <a href="#" class="text-white hover-primary">
                  <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="#" class="text-white hover-primary">
                  <i class="fab fa-youtube fa-lg"></i>
                </a>
              </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
              <h5 class="text-white mb-3">Quick Links</h5>
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="#home" class="text-muted text-decoration-none hover-white">Home</a>
                </li>
                <li class="mb-2">
                  <a href="#features" class="text-muted text-decoration-none hover-white">Fitur</a>
                </li>
                <li class="mb-2">
                  <a href="#destinations" class="text-muted text-decoration-none hover-white">Destinasi</a>
                </li>
                <li class="mb-2">
                  <a href="#booking" class="text-muted text-decoration-none hover-white">Booking</a>
                </li>
              </ul>
            </div>

            <!-- Support -->
            <div class="col-lg-2 col-md-6 mb-4">
              <h5 class="text-white mb-3">Support</h5>
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="#" class="text-muted text-decoration-none hover-white">FAQ</a>
                </li>
                <li class="mb-2">
                  <a href="#" class="text-muted text-decoration-none hover-white">Kebijakan Privasi</a>
                </li>
                <li class="mb-2">
                  <a href="#" class="text-muted text-decoration-none hover-white">Syarat & Ketentuan</a>
                </li>
                <li class="mb-2">
                  <a href="#" class="text-muted text-decoration-none hover-white">Hubungi Kami</a>
                </li>
              </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 mb-4">
              <h5 class="text-white mb-3">Hubungi Kami</h5>
              <ul class="list-unstyled">
                <li class="mb-3">
                  <div class="d-flex">
                    <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                    <p class="text-muted mb-0">Jl. Contoh No. 123, Jakarta Pusat<br>Indonesia, 10110</p>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex">
                    <i class="fas fa-phone-alt text-primary me-3 mt-1"></i>
                    <p class="text-muted mb-0">+62 123 4567 890</p>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex">
                    <i class="fas fa-envelope text-primary me-3 mt-1"></i>
                    <p class="text-muted mb-0">info@e-ticketing.com</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- Bottom Footer -->
          <div class="row pt-4 border-top border-secondary">
            <div class="col-md-6 text-center text-md-start">
              <p class="text-muted mb-0">&copy; 2024 E-Ticketing. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
              <p class="text-muted mb-0">
                Made with <i class="fas fa-heart text-danger"></i> by E-Ticketing Team
              </p>
            </div>
          </div>
        </div>
      </footer>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="vendors/plyr/plyr.polyfilled.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Add this CSS to your existing styles -->
    <style>
      .hover-primary:hover {
        color: #5e72e4 !important;
        transition: color 0.3s ease;
      }

      .hover-white:hover {
        color: white !important;
        transition: color 0.3s ease;
      }

      footer .list-unstyled li a {
        transition: color 0.3s ease;
      }

      footer .fab, footer .fas {
        transition: transform 0.3s ease;
      }

      footer .fab:hover, footer .fas:hover {
        transform: translateY(-3px);
      }
    </style>
  </body>

</html>
