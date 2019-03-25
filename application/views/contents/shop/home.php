<br>
	Latest Products
    <tr>
		<div class="container-fluid">
                <?php foreach ($latest_products as $latest) { ?>
                    <div class="panel-body well" style=" float:left;padding:20px;margin:10px;background-color:#DCDCDC;">
                        <a href="<?= base_url('Shop/details?product='.$latest->product_id)?>" ><img style="width:250px;height:250px" src="<?php echo base_url('uploads/'.$latest->product_image)?>" alt="" /></a>
                        <h4><?php echo $latest->product_name?></h4>
                        <p><?php echo $latest->short_desc?></p>
                        <p><span class="price"><?php echo $this->cart->format_number($latest->sell_price) ?> PHP</span></p>
                        <div class="button"><span><a href="<?php echo base_url('Shop/details?product='.$latest->product_id);?>" class="btn btn-primary">Details</a></span></div>
                    </div>
                    <?php
                }
                ?>
         </div></tr>
         <tr>
         <div></div>
 		All Products
 	<br>	
		<div class="container-fluid">
                <?php foreach ($products as $single_products) { ?>
                    <div class="panel-body well" style=" float:left;padding:20px;margin:10px;background-color:#DCDCDC;">
                        <a  href="<?= base_url('Shop/details?product='.$single_products->product_id)?>" ><img style="width:250px;height:250px" src="<?php echo base_url('uploads/'.$single_products->product_image)?>" alt="" /></a>
                        <h4><?php echo $single_products->product_name?></h4>
                        <p><?php echo $single_products->short_desc?></p>
                        <p><span class="price"><?php echo $this->cart->format_number($single_products->sell_price) ?> PHP</span></p>
                        <div class="button"><span><a href="<?php echo base_url('Shop/details?product='.$single_products->product_id);?>" class="btn btn-primary">Details</a></span></div>
                    </div>
                    <?php
                }
                ?>
            </div></tr>