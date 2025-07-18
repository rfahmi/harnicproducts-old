<?php
require 'config.php';
echo "<div class='owl-carousel'>";
$imgproducts=$link->query("SELECT * FROM imgproduk WHERE produk=".$_POST['itemid']." AND varian=".$_POST['variant']."");
while ($imgproduct=$imgproducts->fetch_object()){
	if ($imgproduct->keterangan == 'video-slide') {
		echo "<video autoplay><source src='resource/img/news/ricasuma870.mp4' width='100%' height='auto' type='video/mp4'></video>";
	}else{
		echo "<img id='option1_".$imgproduct->produk."_".$imgproduct->varian."_".$imgproduct->angel."' item='".$imgproduct->produk."' varian='".$imgproduct->varian."' angel='".$imgproduct->angel."' target='#primary_".$imgproduct->produk."' src='resource/img/product/".$imgproduct->gambar."' class='img-thumbnail img-option'>";
	}
}
echo "</div>";
?>
<script type="text/javascript">
	$(".owl-carousel").owlCarousel({
		items:5
	});
	$(document).ready(function(){
	    var angel = $('#primary_<?php echo $_POST['itemid'];?>').attr('angel');

		$('.img-option').click(function(){
            var imglink = $(this).attr('src');
            var target = $(this).attr('target');
            var angel = $(this).attr('angel');
            var itemvariant = $(this).attr('variantid');
			var itemid = $(this).attr('itemid');
            
            $('.img-option').removeClass('img-option-active');
            $(this).addClass('img-option-active');
            $(target).attr('src', imglink);
            $(target).attr('angel', angel);

    	});

		$('#option1_<?php echo $_POST['itemid']."_".$_POST['variant']."_";?>'+angel).click();
	});
</script>