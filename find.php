<?php
require 'config.php';
include 'fnc.php';
$keyword=$_GET['keyword'];

  $table='mstproduk2';
  $par='namaproduk';
  $par2='kodeproduk';
  $par3='deskripsi';
  $parvalue=$keyword;
  $imgdir='product';
  $imgpar='gambar1';
  $title='kategori_nama';
  $title2='kodeproduk';
  $button='DETAIL';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="icon" href="resource/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.min.css?i=1">
    <link rel="stylesheet" href="css/addin.css?i=328">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <title>Cari <?php echo $keyword;?> Products</title>
  </head>
  <body>
    <div class="katalog-header">
      <div class="align-middle logo">
      <a href="/"><img src="resource/img/logo2.png"></a>
      </div>
      <div class="align-middle title">FIND PRODUCT</div>
    </div>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <?php
        echo "<li class='breadcrumb-item'><a href='/'>Home</a></li>";
        echo "<li class='breadcrumb-item active' aria-current='page'>keyword: \"".$keyword."\"</li>";
        ?>
      </ol>
    </nav>

    <?php
    echo "<main>";
    echo "<div class='container-fluid'>";
      echo "<div class='row'>";

            //PAGINATE
            $items=$link->query("SELECT * FROM ".$table." WHERE (".$par." LIKE '%".$parvalue."%' OR ".$par2." LIKE '%".$parvalue."%' OR ".$par3." LIKE '%".$parvalue."%')");
            if(!empty($_GET['page'])){
              $page_number=$_GET['page'];
            }else{
              $page_number=1;
            }
            $page_url="find/".$keyword;
            $item_per_page=8;
            $page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
            $get_total_rows = $items->num_rows; //hold total records in variable
            $total_pages = ceil($get_total_rows / $item_per_page); //break records into pages
            
            $items=$link->query("SELECT * FROM ".$table." WHERE (".$par." LIKE '%".$parvalue."%' OR ".$par2." LIKE '%".$parvalue."%' OR ".$par3." LIKE '%".$parvalue."%') ORDER BY kategori,kodeproduk LIMIT ".$page_position.",".$item_per_page."");

            if($get_total_rows > 0){
            while ($item=$items->fetch_object()) {
              echo "<div class='col-md-3 col-6' style='padding: 0 1px 0 1px;'>";
                echo "<div class='card2'>";
                  echo "<div class='card2-body'>";
                    echo "<b>".strtoupper($item->$title)."</b>";
                  echo "</div>";
                if($table != 'mstproduk2'){
                    echo "<a href='katalog/".str_replace(' ','-',$item->kategori_nama)."'>";
                }else{
                    echo "<a href='#' class='nostyle itemthumb' data-toggle='modal' itemid='".$item->produk."' data-target='#itempopup_".$item->produk."'>";
                }
                  if($item->gambar1 != NULL){
                    echo "<div class='card2-img-top'><div class='item'><img src='resource/img/product/".$item->gambar1."' class='img-fluid'></div></div>";
                  }else{
                        echo "<div class='card2-img-top'><div class='item'><img src='resource/img/no-product-image.png' class='img-fluid'></div></div>";
                  }
                echo "</a>";
                  echo "<div class='card2-footer'>";
                    echo "<h5 class='card2-title'>".$item->$title2."</h5>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";

              //MODALS
                  echo "<div class='modal fade' id='itempopup_".$item->produk."' tabindex='-1' role='dialog' aria-labelledby='itempopup' aria-hidden='true'>";
                    echo "<div class='modal-dialog modal-lg modal-dialog-centered' role='document'>";
                      echo "<div class='modal-content'>";
                        echo "<div class='modal-body'>";
                          echo "<div class='container-fluid item-detail'>";
                            echo "<div class='row header'>";
                              echo "<div class='col-8 modal_title_fit'>";
                                echo strtoupper($item->kategori_nama);
                              echo "</div>";
                              echo "<div class='col-4' style='text-align: right;'>";
                                echo strtoupper($item->kodeproduk);
                              echo "</div>";
                            echo "</div>";
                            echo "<div class='row'>";
                              echo "<div class='col-md-7'>";
                                echo "<div id='load_img_".$item->produk."' class='row' style='background-color:#eee;'>";
                                //LOAD GAMBAR DISINI
                                  
                                echo "</div>";
                              echo "</div>";
                              echo "<div class='col-md-5 deskripsi' style='position:relative;'>";
                              if($item->video != NULL ){
                                echo "<div class='embed-responsive embed-responsive-16by9'>";
                                  echo "<video controls poster='resource/video/".$item->video_thumb."'><source src='resource/video/".$item->video."' type='video/mp4'></video>";
                                echo "</div>";
                              }

                                    echo "<b>".$item->namaproduk."</b><br>";
                                    echo $item->deskripsi;
                                    echo "<button type='button' class='btn btn-primary' disabled>Buy</button>";
                                    echo "<div style='position:absolute;bottom:0;right:0;'>";
                                      echo "<img data-dismiss='modal' class='close_button' width='30px' src='resource/img/close2.png'>";
                                    echo "</div>";
                                
                              echo "</div>";
                            echo "</div>";
                          echo "</div>";
                        echo "</div>";

                        /*echo "<div class='modal-body text-right'>";
                          echo "<a href='#' class='btn btn-secondary' data-dismiss='modal'>CLOSE</a> ";
                          //echo "<a href='#' class='btn btn-primary'>ORDER</a>";
                        echo "</div>";*/

                      echo "</div>";
                    echo "</div>";
                  echo "</div>";
            }
          }else{
            echo "<div style='width:100%;text-align:center;'>";
            echo "<h3>NO PRODUCTS FOUND</h3>";
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
    <script src="js/owl.carousel.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('.card2-body').quickfit();
      $('.itemthumb').click(function(){
        var itemidselect = $(this).attr('itemid');
        $.ajax({
          type: 'POST',
          url: 'load_img.php',
          data: {
            produk_id: itemidselect
          },
          success: function(data) {
            $("#load_img_"+itemidselect).html(data);
          }
        });
      });
    });
    </script>
  </body>
</html>