<?php
require 'config.php';

$kat=str_replace('-',' ',$_GET['kat']);
$kategori=$link->query("SELECT * FROM mstkategori WHERE kategori_nama='".$kat."'")->fetch_object();
$count_subkategori=$link->query("SELECT * FROM mstkategori WHERE kategori_parent='".$kategori->kategori_id."'")->num_rows;

  $i=$kategori->kategori_parent;
  if($i > 0){
    $kategori_relasi=array();
    do{
      $p=$link->query("SELECT * FROM mstkategori WHERE kategori_id=".$i."")->fetch_object();
      array_push($kategori_relasi, $p->kategori_id);
      $i=$p->kategori_parent;
    } while ($i > 0);
    $breadcrumbs=array_reverse($kategori_relasi);
  }

if($count_subkategori > 0){
  $table='mstkategori';
  $par='kategori_parent';
  $parvalue=$kategori->kategori_id;
  $imgdir='kategori';
  $imgpar='kategori_gambar';
  $title='kategori_nama';
  $button='VIEW';
}else{
  $table='mstproduk2';
  $par='kategori';
  $parvalue=$kategori->kategori_id;
  $imgdir='product';
  $imgpar='gambar1';
  $title='kategori_nama';
  $title2='kodeproduk';
  $button='DETAIL';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Harnic Heles Indonesia Katalog <?php echo $kategori->kategori_nama;?>">

    <meta name="keywords" content="Harnic,<?php echo $kategori->kategori_nama;?>,Berkualitas,Murah,Bagus,Produk Harnic">


    <!-- Bootstrap CSS -->
    <link rel="icon" href="resource/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/addin.css?i=26">
    <title>Harnic <?php echo $kategori->kategori_nama;?> Products</title>
  </head>
  <body>
    <div class="katalog-header">
      <div class="align-middle logo">
      <img src="resource/img/logo2.png">
      </div>
      <div class="align-middle title"><?php echo strtoupper($kategori->kategori_nama);?></div>
    </div>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <?php
        echo "<li class='breadcrumb-item'><a href='/'>Home</a></li>";
        if(isset($breadcrumbs)){
          foreach ($breadcrumbs as $breadcrumb) {
            $b=$link->query("SELECT * FROM mstkategori WHERE kategori_id=".$breadcrumb."")->fetch_object();
            echo "<li class='breadcrumb-item'><a href='katalog/".str_replace(' ','-',$b->kategori_nama)."'>".$b->kategori_nama."</a></li>";
          }
        }
        echo "<li class='breadcrumb-item active' aria-current='page'>".$kategori->kategori_nama."</li>";
        ?>
      </ol>
    </nav>

    <?php
      //echo $breadcrumbs[0];
    echo "<main>";
    if($kategori->kategori_banner != NULL){
      echo "<img id='story' src='resource/img/kategori/".$kategori->kategori_banner."' class='img-fluid' alt='".$kategori->kategori_nama."'><br><br>";
    }else{
      $cek_gbr = findCategory($kategori_relasi[0])->kategori_banner;
      if($cek_gbr != NULL){
        echo "<img id='story' src='resource/img/kategori/".findCategory($kategori_relasi[0])->kategori_banner."' class='img-fluid' alt='".$kategori->kategori_nama."'><br><br>";
      }else{
        echo "<img id='story' src='resource/img/kategori/".findCategory($breadcrumbs[0])->kategori_banner."' class='img-fluid' alt='".$kategori->kategori_nama."'><br><br>";
      }
    }
    echo "<div class='container-fluid'>";
      echo "<div class='row'>";

            //PAGINATE
            $items=$link->query("SELECT * FROM ".$table." WHERE ".$par."=".$parvalue."");
            if(!empty($_GET['page'])){
              $page_number=$_GET['page'];
            }else{
              $page_number=1;
            }
            $page_url="katalog/".$_GET['kat'];
            $item_per_page=8;
            $page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
            $get_total_rows = $items->num_rows; //hold total records in variable
            $total_pages = ceil($get_total_rows / $item_per_page); //break records into pages
            
            $items=$link->query("SELECT * FROM ".$table." WHERE ".$par."=".$parvalue." LIMIT ".$page_position.",".$item_per_page."");
            if($get_total_rows > 0){
            while ($item=$items->fetch_object()){
              echo "<div class='col-md-3 col-6' style='padding: 0 1px 0 1px;'>";
                echo "<div class='card2'>";
                  echo "<div class='card2-body'>";
                    echo "<b>".strtoupper($item->$title)."</b>";
                  echo "</div>";
                if($table != 'mstproduk2'){
                    echo "<a href='katalog/".str_replace(' ','-',$item->kategori_nama)."'>";
                }else{
                    echo "<a href='#' class='nostyle' data-toggle='modal' data-target='#itempopup_".$item->produk."'>";
                }
                  if($item->$imgpar != NULL){
                    echo "<img class='card2-img-top' src='resource/img/".$imgdir."/".$item->$imgpar."' class='img-thumbnail'>";
                  }else{
                    echo "<img class='card2-img-top' src='resource/img/no-product-image.png' class='img-thumbnail'>";
                  }
                echo "</a>";
                  echo "<div class='card2-footer'>";
                    echo "<h5 class='card2-title'>".$item->$title2."</h5>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";

              if($count_subkategori == 0){
              //MODALS
              echo "<div class='modal fade' id='itempopup_".$item->produk."' tabindex='-1' role='dialog' aria-labelledby='itempopup' aria-hidden='true'>";
                echo "<div class='modal-dialog modal-lg modal-dialog-centered' role='document'>";
                  echo "<div class='modal-content'>";
                    echo "<div class='modal-body'>";
                      echo "<div class='container-fluid item-detail'>";
                        echo "<div class='row header'>";
                          echo "<div class='col-8'>";
                            echo strtoupper($item->kategori_nama);
                          echo "</div>";
                          echo "<div class='col-4' style='text-align: right;'>";
                            echo strtoupper($item->kodeproduk);
                          echo "</div>";
                        echo "</div>";
                        echo "<div class='row'>";
                          echo "<div class='col-md-7'>";
                            echo "<div class='row'>";

                              echo "<div class='col-md-12 img-primary'>";
                                echo "<img id='primary_".$item->produk."' src='resource/img/".$imgdir."/".$item->$imgpar."' width='100%' height='100%' class='img-primary-view mx-auto d-block'>";
                              echo "</div>";
                              echo "<div class='col-md-12 img-other text-center'>";
                                $variants=$link->query("SELECT * FROM imgproduk WHERE produk=".$item->produk."");
                                while($variant=$variants->fetch_object()){
                                echo "<img id='option1_".$variant->produk."' target='#primary_".$variant->produk."' src='resource/img/".$imgdir."/".$variant->gambar."' class='img-thumbnail img-option'>";
                                }
                              echo "</div>";

                            echo "</div>";
                          echo "</div>";
                          echo "<div class='col-md-5 deskripsi'>";
                            
                                echo "<b>".$item->namaproduk."</b><br>";
                                echo $item->deskripsi;
                            
                          echo "</div>";
                        echo "</div>";
                      echo "</div>";
                    echo "</div>";

                    echo "<div class='modal-body text-right'>";
                      echo "<a href='#' class='btn btn-secondary' data-dismiss='modal'>CLOSE</a> ";
                      //echo "<a href='#' class='btn btn-primary'>ORDER</a>";
                    echo "</div>";

                  echo "</div>";
                echo "</div>";
              echo "</div>";
              }
            }
          }else{
            echo "<div style='width:100%;text-align:center;'>";
            echo "<h3>NO PRODUCTS</h3>";
            echo "</div>";
          }
      echo "</div>";
    echo "<div class='kategori-divider'></div>";
    echo paginate($item_per_page, $page_number, $get_total_rows, $total_pages, $page_url);
    echo "</div>";
    echo "</main>";
    ?>


    <footer class="sticky-footer">
      Copyright &copy; <?php echo date("Y");?> HARNIC All rights reserved
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/quickfit.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

        $('.img-option').click(function(){
          var imglink = $(this).attr('src');
          var target = $(this).attr('target');
          $(target).attr('src', imglink);
        });
        $('.card2-body').quickfit();

    });
    </script>
  </body>
</html>