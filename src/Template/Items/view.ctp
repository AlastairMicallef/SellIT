<h2>Items - List</h2>

<?php

foreach ($items as $item) {
    if($item->Item_public != true){
    ?>
<div class="card mb-3">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Item Name<?php echo $item->Item_ID ?> </h5>
    <p class="card-text"><?php echo $item->Item_Disc ?> </p>
    <p class="card-text">€<?php echo $item->Item_Price ?> </p>
    <p class="card-text"><small class="text-muted">Last updated <?php echo $item->Item_TimeStemp ?></small></p>
  </div>
</div>


<?php
    }
}
?>