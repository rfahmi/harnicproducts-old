<?php
require 'config.php';
include 'fnc.php';
$kat=str_replace('-',' ',$_GET['kat']);
$kategori=$link->query("SELECT * FROM mstkategori WHERE kategori_nama='".$kat."'")->fetch_object();

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

if($kategori->kategori_parent == 0){
  $is_first_child=TRUE;
}else{
  $is_first_child=FALSE;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="manifest" href="manifest.json">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Harnic Heles Indonesia Katalog <?php echo $kategori->kategori_nama;?>">

    <meta name="keywords" content="Harnic,<?php echo $kategori->kategori_nama;?>,Berkualitas,Murah,Bagus,Produk Harnic">


    <!-- Bootstrap CSS -->
    <link rel="icon" href="resource/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.min.css?i=1">
    <link rel="stylesheet" href="css/addin.css?i=400">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <title>Harnic <?php echo $kategori->kategori_nama;?> Products</title>
  </head>
  <body>
   

    <?php
    
      //echo $breadcrumbs[0];
    echo "<main>";
    echo "<div class='kategori-banner'>";
      //echo "<img src='' data-src='resource/img/kategori/".$kategori->kategori_banner."' class='bg img-fluid' alt='".$kategori->kategori_nama."'>";
      if($kategori->kategori_banner == NULL){
        echo "<div class='bg' style='background-image:url(resource/img/kategori/".$kategori->kategori_banner.");background-size:cover;'></div>";
      }else{
        echo "<div class='bg' style='background-image:url(resource/img/kategori/".$kategori->kategori_banner.");background-size:cover;'></div>";
      }
      echo "<div class='label'>".$kat."</div>";
      echo "<img src='' data-src='resource/img/logo-glow.png' class='logo' alt='harnicproduct'>";
    echo "</div>";
    //CONTAINER
    echo "<div class='container-fluid' style='min-height: 50vh;'>";
      if($is_first_child == TRUE){
        echo "<div class='breadcrumb'>";
          echo "<li class='breadcrumb-item'><a href='/'>Home</a></li>";
          if(isset($breadcrumbs)){
            foreach ($breadcrumbs as $breadcrumb) {
              $b=$link->query("SELECT * FROM mstkategori WHERE kategori_id=".$breadcrumb."")->fetch_object();
              echo "<li class='breadcrumb-item'><a href='katalog/".str_replace(' ','-',$b->kategori_nama)."'>".$b->kategori_nama."</a></li>";
            }
          }
          echo "<li class='breadcrumb-item active' aria-current='page'>".$kategori->kategori_nama."</li>";
        echo "</div>";
        echo "<div class='row'>";
          $items=$link->query("SELECT * FROM mstkategori WHERE kategori_parent=".$kategori->kategori_id."");
          $get_total_rows=$items->num_rows;
          if($get_total_rows > 0){
            while ($item = $items->fetch_object()) {
              
                //echo "<a href='katalog/".str_replace(' ','-',$item->kategori_nama)."'>".$item->kategori_nama."</a>";

              echo "<div class='col-md-6 col-sm-12' style='padding: 0 1px 0 1px;'>";
                echo "<div class='card2'>";
                  echo "<div class='card2-body'>";
                    echo "<b>".strtoupper($item->kategori_nama)."</b>";
                  echo "</div>";
                  echo "<a href='katalog/".str_replace(' ','-',$item->kategori_nama)."'>";
 
                  if($item->kategori_gambar != NULL){
                    echo "<div class='card2-img-top'><div class='subcategory'><img src='' data-src='resource/img/kategori/".$item->kategori_gambar."'></div></div>";
                  }else{
                    echo "<div class='card2-img-top'><div class='subcategory'><img src='' data-src='resource/img/no-product-image.png'></div></div>";
                  }
                echo "</a>";
                echo "</div>";
              echo "</div>";
            }
          }
        echo "</div>";
      }else{
      //ITEM
      //MAIN ROW
      echo "<div class='row'>";
        //FILTER
        echo "<div class='col-md-3'>";
          echo "<div class='card' style='position: -webkit-sticky;position: sticky;top:5px;margin-bottom:10px;'>";
            //echo "<div class='card-header h6'>";
              echo "<div class='breadcrumb'>";
                echo "<li class='breadcrumb-item'><a href='/'>Home</a></li>";
                if(isset($breadcrumbs)){
                  foreach ($breadcrumbs as $breadcrumb) {
                    $b=$link->query("SELECT * FROM mstkategori WHERE kategori_id=".$breadcrumb."")->fetch_object();
                    echo "<li class='breadcrumb-item'><a href='katalog/".str_replace(' ','-',$b->kategori_nama)."'>".$b->kategori_nama."</a></li>";
                  }
                }
                echo "<li class='breadcrumb-item active' aria-current='page'>".$kategori->kategori_nama."</li>";
                echo "<a class='dropdown-toggle dropdown-toggle-split' style='color:#878787;position:absolute;top:10px;right:5px;padding: .5625rem;' data-toggle='collapse' href='#collapsefilter'></a>";
              echo "</div>";
            //echo "</div>";
            //CONTAINER
            echo "<div class='container'>";
              echo "<div class='collapse' id='collapsefilter'>";
              echo "<form class='form-control' style='border:none;' id='filter'>";
                //UL ROOT
                echo "<ul class='filter-nav'>";
                  $maincat = $link->query("SELECT * FROM mstkategori WHERE kategori_id=".$kategori->kategori_id." ORDER BY kategori_nama");
                  while($main = $maincat->fetch_object()){
                    echo "<li class='custom-control custom-checkbox'>";
                      echo "<input type='checkbox' value='".$main->kategori_id."' class='custom-control-input katcheck' id='mainCategory_".$main->kategori_id."' onclick='return false' />";
                      echo "<label class='custom-control-label' for='mainCategory_".$main->kategori_id."'>".$main->kategori_nama."</label>";
                      //echo "<a class='float-right dropdown-toggle' style='padding:13px 10px 0 0;' data-toggle='collapse' href='#collapsechild_".$main->kategori_id."'></a>";
                      echo "<ul class='filter-nav'>";
                        $childs = $link->query("SELECT * FROM mstkategori WHERE kategori_parent=".$main->kategori_id."");
                        while($child = $childs->fetch_object()){
                        echo "<li>";
                          echo "<input type='checkbox' value='".$child->kategori_id."' class='custom-control-input katcheck' id='child".$child->kategori_id."'>";
                          echo "<label class='custom-control-label' for='child".$child->kategori_id."'>".$child->kategori_nama."</label>";
                          echo "<ul class='filter-nav'>";
                            $childs2 = $link->query("SELECT * FROM mstkategori WHERE
                            kategori_parent=".$child->kategori_id."");
                            while($child2 = $childs2->fetch_object()){
                            echo "<li>";
                              echo "<input type='checkbox' value='".$child2->kategori_id."' class='custom-control-input katcheck' id='child".$child2->kategori_id."'>";
                              echo "<label class='custom-control-label' for='child".$child2->kategori_id."'>".$child2->kategori_nama."</label>";
                            echo "</li>";
                            }
                          echo "</ul>";
                        echo "</li>";
                        }
                      echo "</ul>";
                    echo "</li>";
                  }
                echo "</ul>";
                //END UL ROOT
              echo "</form>";
              //UL ATAS
            echo "</div>";
            echo "</div>";
            //END CONTAINER
          echo "</div>";
        echo "</div>";

        //PRODUK SECTION
        echo "<div class='col-md-9' id='load_items'>";
          

          //load disni


        echo "</div>";
      echo "</div>";
      //END MAIN ROW
      }
    echo "</div>";
    //END CONTAINER
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
    <script src="js/main.js"></script>
    <script src="js/quickfit.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script type="text/javascript">
    [].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
            img.setAttribute('src', img.getAttribute('data-src'));
            img.onload = function() {
              img.removeAttribute('data-src');
            };
    });
    $('.breadcrumb').quickfit();
    $(document).ready(function() {
        //EXPAND ALL
        $('#collapsefilter').collapse({toggle: true});
        //CHECK MAIN KATEGORI
        $('#mainCategory_<?php echo $kategori->kategori_id;?>').prop('checked', true);
        //CHECK ALL CHILD
        $('#mainCategory_<?php echo $kategori->kategori_id;?>').siblings('ul').find("input[type='checkbox']").prop('checked', true);

        //AUTO CHECK CHILD ON CHANGE
        $("input[type='checkbox']").change(function (){
          $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked);
        });

        //KIRIM DATA DEFAULT
        var chkcategory = getValueFilter();
          $.ajax({
            type: 'POST',
            url: 'load_items.php',
            data: {chkcategory:chkcategory},
            success: function(data) {
              $("#load_items").fadeOut(300);
              $("#load_items").html(data);
              $("#load_items").fadeIn(300);
            }
          });
        
        //ONCHANGE GANTI DATA
        $('#filter').change(function(){
          var chkcategory = getValueFilter();
          $.ajax({
            type: 'POST',
            url: 'load_items.php',
            data: {
              chkcategory:chkcategory
            },
            success: function(data) {
              $("#load_items").fadeOut(300);
              $("#load_items").html(data);
              $("#load_items").fadeIn(300);
            }
          });
        });
        /*
        */
        $('.img-option').click(function(){
          var imglink = $(this).attr('src');
          var target = $(this).attr('target');
          $(target).attr('src', imglink);
        });

        //FUNCTION
        function getValueFilter(){
          /* declare an checkbox array */
          var chkArray = [];
          
          /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
          $(".katcheck:checked").each(function() {
            chkArray.push($(this).val());
          });
          
          /* we join the array separated by the comma */
          var selected;
          selected = chkArray.join(',') ;
          
          /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
          if(selected.length > 0){
            return chkArray; 
          }else{
            return 0;
          }
        }
    });
    </script>
  </body>
</html>