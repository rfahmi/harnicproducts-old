<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="resource/img/slide/harnic_home-min.jpg" alt="First slide">
    </div>
    <?php
    $slides=$link->query("SELECT * FROM gambarhdr ORDER BY slideid DESC");
    while($slide=$slides->fetch_object()){
    echo "<div class='carousel-item'>";
      echo "<img src='resource/img/slide/".$slide->gambarslide."' class='img-fluid' alt='slide1'>";
    echo "</div>";
    }
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>