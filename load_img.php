<?php
require 'config.php';
$items=$link->query("SELECT * FROM mstproduk2 WHERE produk=".$_POST['produk_id']."");
$default_img=$link->query("SELECT * FROM imgproduk WHERE produk=".$_POST['produk_id']." and gambardefault=1")->fetch_object();
while ($item=$items->fetch_object()){

	echo "<div class='col-10'>";
		if($item->gambar1 != NULL){
			echo "<img id='primary_".$item->produk."' src='resource/img/product/".$item->gambar1."' angel='1' data-zoom-image='resource/img/no-product-image.png' class='img-primary-view mx-auto d-block img-primary'>";
		}else{
			echo "<img id='primary_".$item->produk."' src='resource/img/no-product-image.png' class='img-primary-view mx-auto d-block img-primary'>";
		}
	echo "</div>";
	//VARIANT OOPTION
	echo "<div class='col-2 variant-option'>";
		echo "<ul id='load_variant'>";
		$variants=$link->query("SELECT * FROM mstvarian WHERE varian IN (SELECT varian FROM imgproduk WHERE produk=".$_POST['produk_id'].")");
		while ($variant=$variants->fetch_object()){
		echo "<li data-toggle='tooltip' data-placement='left' title='".$variant->namavarian."'>";
			echo "<img src='resource/img/variant/".$variant->gambarvarian."' variantid='".$variant->varian."' itemid='".$_POST['produk_id']."' class='rounded-circle itemvariant'>";
		echo "</li>";
		}
		echo "</ul>";
	echo "</div>";

	//ANGEL OPTION
	echo "<div id='load_imgproduk_".$_POST['produk_id']."' class='col-md-12 img-other text-center'>";
	
	echo "</div>";
}
?>

<script type="text/javascript">
$(document).ready(function() {
	 $('[data-toggle="tooltip"]').tooltip();
	$.ajax({
	        type: 'POST',
	        url: 'load_imgproduk.php',
	        data: {
	          itemid: <?php echo $_POST['produk_id'];?>,
	          variant: <?php echo $default_img->varian;?>
	        },
	    success: function(data) {
	    	$("#load_imgproduk_<?php echo $_POST['produk_id'];?>").html(data);
		}
	});

    $('.itemvariant').click(function(){
    	$(".owl-carousel").owlCarousel({
	      items:5
	    });
		var itemvariant = $(this).attr('variantid');
		var itemid = $(this).attr('itemid');
		
		$('.itemvariant').removeClass('active');
        $(this).addClass('active');
	    $.ajax({
	        type: 'POST',
	        url: 'load_imgproduk.php',
	        data: {
	          itemid: <?php echo $_POST['produk_id'];?>,
	          variant: itemvariant,
	        },
	        success: function(data) {
				$("#load_imgproduk_"+itemid).html(data);
	        }
	    });
	});
});
</script>