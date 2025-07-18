<?php
require 'config.php';
include 'fnc.php';
//$kat=$_POST['currentcategory'];
$kategori_array=$_POST['chkcategory'];
echo "<div class='row'>";

                //PAGINATE
                $items=$link->query("SELECT * FROM mstproduk2 WHERE kategori IN (" . implode(',', array_map('intval', $kategori_array)) . ") order by kategori,kodeurut");

                if(!empty($_GET['page'])){
                  $page_number=$_GET['page'];
                }else{
                  $page_number=1;
                }
                $page_url="katalog/";
                $item_per_page=16;
                $page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
                $get_total_rows = $items->num_rows; //hold total records in variable
                $total_pages = ceil($get_total_rows / $item_per_page); //break records into pages

                //LAST CATEGORY
                $last_category=0;
                
                $items=$link->query("SELECT * FROM mstproduk2 WHERE kategori IN (" . implode(',', array_map('intval', $kategori_array)) . ") ORDER BY kategori,kodeurut LIMIT ".$page_position.",".$item_per_page."");
                if($get_total_rows > 0){
                while ($item=$items->fetch_object()){
                  if($item->kategori <> $last_category){
                    echo "<div class='h6' style='text-align:center;margin-bottom:5px;padding:3px;width:100%;background-color:#ddd;'>".strtoupper($item->kategori_nama)."</div>";
                  }
                  $last_category=$item->kategori;
                  echo "<div class='col-md-3 col-6' style='padding: 0 1px 0 1px;'>";
                    echo "<div class='card2'>";
                      echo "<div class='card2-body'>";
                        echo "<b>".strtoupper($item->kategori_nama)."</b>";
                      echo "</div>";
                        echo "<a href='#' class='nostyle itemthumb' data-toggle='modal' itemid='".$item->produk."' data-target='#itempopup_".$item->produk."'>";
                      if($item->gambar1 != NULL){
                        echo "<div class='card2-img-top'><div class='item'><img src='resource/img/product/".$item->gambar1."' class='img-fluid'></div></div>";
                      }else{
                        echo "<div class='card2-img-top'><div class='item'><img src='resource/img/no-product-image.png' class='img-fluid'></div></div>";
                      }
                    echo "</a>";
                      echo "<div class='card2-footer'>";
                        echo "<h5 class='card2-title'>".$item->kodeproduk."</h5>";
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
                              echo "<div class='col-md-5 deskripsi'>";
                              if($item->video != NULL ){
                                echo "<div class='embed-responsive embed-responsive-16by9'>";
                                  echo "<video controls poster='resource/video/".$item->video_thumb."'><source src='resource/video/".$item->video."' type='video/mp4'></video>";
                                echo "</div>";
                              }
                                
                                    echo "<b>".$item->namaproduk."</b><br>";
                                    echo $item->deskripsi;
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
                echo "<h3>NO PRODUCTS</h3>";
                echo "</div>";
              }
          echo "</div>";
          echo "<div class='kategori-divider'></div>";
          echo paginate($item_per_page, $page_number, $get_total_rows, $total_pages, $page_url);
?>
<script>
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