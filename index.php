<?php require 'config.php';require 'fnc.php';require 'statistik.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="manifest" href="manifest.json">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Harnic Heles Indonesia Katalog Official">

    <meta name="keywords" content="Harnic,Heles,Kitchen,Home,Beauty,Health,Berkualitas,Murah,Bagus,Produk Harnic">

    <!-- Bootstrap CSS -->
    <link rel="icon" href="resource/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/addin.css?i=329">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Harnic Official Website</title>
  </head>
  <body id="home" data-spy="scroll" data-offset="50" data-target="#scrollspy">
    <?php include 'slider.php'; ?>
    <nav id="scrollspy" class="navbar navbar-dark bg-light nav-c">
      <ul class="nav nav-pills mx-auto" style="font-size: 8pt;">
        <li class="nav-item">
          <a class="nav-link" href="#home">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#product">PRODUCTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#news">NEWS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#find_us">FIND US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">ABOUT US</a>
        </li>
      </ul>
    </nav>
    <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
      <div class="kategori-divider" id="product"></div>

      <form action="find" method="GET">
      <div class="form-group container" style="margin-top: 10px;">
        <input type="text" name="keyword" class="form-control" style='text-align: center;' id="itemSearch" placeholder="Search for..." autocomplete="off">
      </div>
      </form>

      <div class="kategori-b">OUR PRODUCTS</div>
      <?php
      //LOOPING KATEGORI
      $getkategori=$link->query("SELECT * FROM mstkategori WHERE kategori_parent=0 ORDER by kategori_nama");
      while ($kategori=$getkategori->fetch_object()) {
        echo "<a href='katalog/".str_replace(' ','-',$kategori->kategori_nama)."'><img src='' data-src='resource/img/kategori/".$kategori->kategori_gambar
        ."' class='img-fluid' width='100%' alt='".$kategori->kategori_nama."'></a><br>";
      }
      ?>



      <!------------NEWS------------------------->
      <div class="kategori-divider" id="news"></div>
      <div class="kategori-b">OUR NEWS</div>

      <div id="carouselNews" class="carousel slide" data-script="resource/js/bootstrap.min.js" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <!--
          <div class="carousel-item active">
            <a href="https://www.instagram.com/harnicshops">
            <img src="" data-src="resource/img/news/Gonxifachai.jpg" width='100%' class="img-fluid" alt="Gong Xi Fa Chai">
            </a>
          </div>
        

          <div class="carousel-item active">
            <div align="center">
              <a href="https://harnicproducts.com/find?keyword=HL-730">
                <video poster="resource/img/news/ricasuma870.jpg">
                  <source src="resource/img/news/ricasuma870.mp4" width="100%" height="auto" type="video/mp4">
                </video>
              </a>
            </div>
          </div>
          -->

          <div class="carousel-item active">
            <a href="https://harnicproducts.com/find?keyword=HL-713">
            <img src="" data-src="resource/img/news/HL713.jpg" width='100%' class="img-fluid" alt="slide1">
            </a>
          </div>

          <div class="carousel-item">
            <a href="https://harnicproducts.com/find?keyword=D-072GK">
            <img src="" data-src="resource/img/news/D072GKricasuma.jpg" width='100%' class="img-fluid" alt="slide1">
            </a>
          </div>

          <div class="carousel-item">
            <a href="https://harnicproducts.com/find?keyword=HL-730">
            <img src="" data-src="resource/img/news/ricasuma870.jpg" width='100%' class="img-fluid" alt="slide1">
            </a>
          </div>
      
          <div class="carousel-item">
            <a href="https://harnicproducts.com/find?keyword=HL-710">
            <img src="" data-src="resource/img/news/HL-710-ricasuma.jpg" width='100%' class="img-fluid" alt="slide1">
            </a>
          </div>
      
        </div>
        <a class="carousel-control-prev" href="#carouselNews" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselNews" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <!------------NEWS------------------------->
      <div class="kategori-divider" id="find_us"></div>
      <div class="kategori-b">FIND US</div>
      <div class="row text-center">
        <div class="col-md-3 col-sm-6 col-6"><a href="https://tokopedia.com/"><img class="img-fluid" src="resource/img/findus/tokopedia.jpg"></a></div>
        <div class="col-md-3 col-sm-6 col-6"><a href="https://lazada.co.id/"><img class="img-fluid" src="resource/img/findus/lazada.jpg"></a></div>
        <div class="col-md-3 col-sm-6 col-6"><a href="https://jd.id/"><img class="img-fluid" src="resource/img/findus/jd.jpg"></a></div>
        <div class="col-md-3 col-sm-6 col-6"><a href="https://blibli.com"><img class="img-fluid" src="resource/img/findus/blibli.jpg"></a></div>
        <div class="col-md-3 col-sm-6 col-6"><a href="https://bukalapak.com/"><img class="img-fluid" src="resource/img/findus/bukalapak.jpg"></a></div>
        <div class="col-md-3 col-sm-6 col-6"><a href="https://shopee.com"><img class="img-fluid" src="resource/img/findus/shopee.jpg"></a></div>
        <div class="col-md-3 col-sm-6 col-6"><a href="https://instagram.com/harnicshops"><img class="img-fluid" src="resource/img/findus/instagram.jpg"></a></div>

      </div>
      <!------------ABOUT US------------------------->

      <div class="kategori-divider" id="about"></div>
      <div class="kategori-b">ABOUT US</div>
      <div id="carouselAbout" class="carousel slide" data-script="resource/js/bootstrap.min.js" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselAbout" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
          
          <div class="carousel-item active">
            <a href="about"><img src="resource/img/banner-skeleton.svg" data-src="resource/img/slide/about/guangdong_manufacturing_facility.jpeg" class="img-fluid" width="100%" alt="slide1"></a>
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5);" style="background: rgba(0,0,0,0.5);">
              <h1 style="color: #fff;" style="color: #fff;">Guangdong Manufacturing Facility</h1>
            </div>
          </div>

          <div class="carousel-item">
            <a href="about"><img src="resource/img/banner-skeleton.svg" data-src="resource/img/slide/about/zhejiang_branch_office.jpeg" class="img-fluid" width="100%" alt="slide1"></a>
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5);">
              <h1 style="color: #fff;">Zhejiang Branch Office</h1>
            </div>
          </div>
          <div class="carousel-item">
            <a href="about"><img src="resource/img/banner-skeleton.svg" data-src="resource/img/slide/about/head_office.jpeg" class="img-fluid" width="100%" alt="slide1"></a>
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5);">
              <h1 style="color: #fff;">Head Office</h1>
            </div>
          </div>
          <div class="carousel-item">
            <a href="about"><img src="resource/img/banner-skeleton.svg" data-src="resource/img/slide/about/harnic_showroom.jpeg" class="img-fluid" width="100%" alt="slide1"></a>
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5);">
              <h1 style="color: #fff;">Harnic Showroom</h1>
            </div>
          </div>
          <div class="carousel-item">
            <a href="about"><img src="resource/img/banner-skeleton.svg" data-src="resource/img/slide/about/harnic_main_showroom.jpeg" class="img-fluid" width="100%" alt="slide1"></a>
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5);">
              <h1 style="color: #fff;">Harnic Main Showroom</h1>
            </div>
          </div>

        </div>
        <a class="carousel-control-prev" href="#carouselAbout" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselAbout" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


    <footer class="sticky-footer">
      Copyright &copy; <?php echo date("Y");?> HARNIC All rights reserved
    </footer>

    <script type="text/javascript">
    [].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
            img.setAttribute('src', img.getAttribute('data-src'));
            img.onload = function() {
              img.removeAttribute('data-src');
            };
    });
    $(document).ready(function() {
        $('.carousel').carousel();
        $('body').scrollspy({
          target: '#scrollspy'
        });
        $('[data-toggle="popover"]').popover({
          trigger: 'focus'
        });
    });
    </script>
  </body>
</html>