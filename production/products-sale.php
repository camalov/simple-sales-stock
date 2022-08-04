<?php include 'header.php';

include 'dbnet/connection.php'; 

if(isset($_POST['searching_list'])){

  $searching_word = $_POST['searching_word'];
  $product_query = $db->prepare("SELECT * FROM products WHERE product_name LIKE '%$searching_word%' LIMIT 25");
  $product_query->execute();

  $result_count = $product_query->rowCount();

}else{

  $product_query = $db->prepare("SELECT * FROM products ORDER BY product_name ASC");
  $product_query->execute();

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
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="">
          <h2>Satış bölməsi<small>              

            <?php
            if($_GET['status']=='true'){ ?>              

              <b style="color:green;">Əməliyyat yerinə yetirildi...</b>

            <?php }else if($_GET['status']=='false'){ ?>

              <b style="color:red;">Əməliyyat yerinə yetirilərkən səhv baş verdi...</b>

            <?php  }else if($_GET['num_renewal']=='false'){ ?>

              <b style="color:red;">Verilmiş sayda satış üçün yetərli məhsul yoxdur...</b>

              <?php  } ?></small></h2>
            </div>

            <div class="table-responsive">
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr class="headings">

                    <th class="column-title">Ad </th>
                    <th class="column-title text-center">Alış qiyməti (AZN) </th>
                    <th class="column-title text-center">Satış qiyməti (AZN) </th>
                    <th class="column-title text-center">Sayı </th>
                    <th width="90" class="column-title text-center">Satış sayı </th>
                    <th width="90" class="column-title"> </th>
                  </th>
                  <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  </th>
                </tr>
              </thead>
              <?php // while($product_result){ ?>
                <tbody>

                  <?php  

                  while($product_result = $product_query->fetch(PDO::FETCH_ASSOC)){

                    ?>

                    <tr class="even pointer">

                      <form action="dbnet/operations.php" method="GET">

                        <td class="text-"><?php echo $product_result['product_name']; ?></td>
                        <td class="text-center"><?php echo $product_result['product_purchase_price']; ?></i></td>
                        <td class="text-center"><?php echo $product_result['product_sale_price']; ?></i></td>
                        <td class="text-center"><?php echo $product_result['product_number']; ?></td>

                        <td class="text-center"><input type="number" required="" min="1" max="<?php echo $product_result['product_number']; ?>" style="height:25px; width:95px; margin-top:6px" class="form-control col-md-3 col-xs-12" name="sale_num"></td>

                        <input type="hidden" name="product_id" value="<?php echo $product_result['product_id']; ?>">
                        <input type="hidden" name="sale" value="true">
                        <input type="hidden" name="sale_price" value="<?php echo $product_result['product_sale_price']; ?>">

                        <td class=" "><button class="btn btn-warning btn-xx" style="width:80px;height:35px; margin-top:3px; margin-left:20px; padding-top:-7px; padding-right:50px"><i class="fa fa-money fa-"></i> Satış</button></td>

                      </form>

                    </tr>

                  <?php } ?>

                </tbody>
                <?php  // } ?>            
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