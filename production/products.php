<?php include 'header.php';

include 'dbnet/connection.php'; 

if(isset($_POST['searching_list'])){

	$searching_word = $_POST['searching_word'];
	$product_query = $db->prepare("SELECT * FROM products WHERE product_name LIKE '%$searching_word%' ");
	$product_query->execute();

	$result_count = $product_query->rowCount();

}else{

	$product_query = $db->prepare("SELECT * FROM products ORDER BY product_name ASC");
	$product_query->execute();
	date_default_timezone_set("Asia/Baku");
}

?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Məhsullar</h3>
			</div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<h2>Mövcud məhsullar <small>              

					<?php
					if($_GET['status']=='true'){ ?>              

						<b style="color:green;">Əməliyyat yerinə yetirildi...</b>

					<?php }else if($_GET['status']=='false'){ ?>

						<b style="color:red;">Əməliyyat yerinə yetirilərkən səhv baş verdi...</b>

						<?php  } ?></small></h2>
						<div class="clearfix" align="right" style="margin-top:-33px; margin-bottom: 3px;"><a href="product-add.php"><button type="button" class="btn btn-round btn-primary">Yeni məhsul</button></a></div>


						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="column-title">Ad </th>
									<th class="column-title text-center">Alış qiyməti (AZN) </th>
									<th class="column-title text-center">Satış qiyməti (AZN) </th>
									<th class="column-title text-center">Sayı </th>
									<th class="column-title text-center">Qazanc (%) </th>
									<th width="90" class="column-title"> </th>
									<th width="80" class="column-title"> </th>
								</tr>
							</thead>


							<tbody>

								<?php while($product_result = $product_query->fetch(PDO::FETCH_ASSOC)){ ?>

									<tr>
										<td class="text-"><?php echo $product_result['product_name']; ?></td>
										<td class="text-center"><?php echo $product_result['product_purchase_price']; ?></i></td>
										<td class="text-center"><?php echo $product_result['product_sale_price']; ?></i></td>
										<td class="text-center"><?php echo $product_result['product_number']; ?></td>
										<td class="text-center"><?php echo $product_result['product_earnings']; ?></td>

										<td class=" "><a href="product-edit.php?product_id=<?php echo $product_result['product_id']; ?>"><button class="btn btn-primary btn-xs" style="width:90px;"><i class="fa fa-pencil"></i> Redaktə et</button></a></td>

										<td class=" "><a href="dbnet/operations.php?product_del=true&product_id=<?php echo $product_result['product_id']; ?>"><button class="btn btn-danger btn-xs" style="width:80px;"><i class="fa fa-trash"></i> Sil</button></td>

										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		



		<!-- /page content -->

		<!-- footer -->
		<?php include 'footer.php'; ?>
       <!-- /footer -->