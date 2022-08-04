<?php include 'header.php'; 

date_default_timezone_set("Asia/Baku");
$time = date("Y-m-d");

$statistic_query = $db->prepare("SELECT * FROM statistic");
$statistic_query->execute();
$sale_num = $statistic_query->rowCount();

$s = '0';
$sale_price = '0';

while($statistic_result = $statistic_query->fetch(PDO::FETCH_ASSOC)){

  if($statistic_result['statistic_time'] == $time){

    $s += $statistic_result['statistic_sale_num'];
    (float) $sale_price += $statistic_result['statistic_sale_price'] * $statistic_result['statistic_sale_num'];
  }else{
    $del = $db->prepare("DELETE FROM statistic WHERE statistic_id = :id");
    $renewal = $del->execute(array( 'id' => $statistic_result['statistic_id'] ));
  }

}

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Gündəlik Satış <i class="fa fa-line-chart" ></i><small> <?php echo date("Y-m-d"); ?></small></h3>
      </div>


    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

        <!-- top tiles -->
        <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-shopping-cart"></i> Ümumi satış sayı</span>
            <div class="count"><?php echo $sale_num; ?></div>
            <hr>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-plus-circle"></i> Satılmış məhsulların ümumi sayı</span>
            <div class="count"><?php echo $s; ?></div>
            <hr>
          </div>

          <div style="margin-left:-110px;" class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Ümumi qazanc</span>
            <div class="count"><?php echo $sale_price; ?></div>
            <hr>
          </div>
        </div>
        <!-- /top tiles -->

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Günlük Satış<small>              

                <?php
                if($_GET['status']=='true'){ ?>              

                  <b style="color:green;">Əməliyyat yerinə yetirildi...</b>

                <?php }else if($_GET['status']=='false'){ ?>

                  <b style="color:red;">Əməliyyat yerinə yetirilərkən səhv baş verdi...</b>

                <?php  }else if($_GET['num_renewal']=='false'){ ?>

                  <b style="color:red;">Verilmiş sayda satış üçün yetərli məhsul yoxdur...</b>

                  <?php  } ?></small></h2>

                  <ul class="nav navbar-right panel_toolbox">
                    <li align="right" style="margin-left:50px;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                  <table  id="datatable-buttons" class="table table-bordered" style="height:50px;">
                    <thead>
                      <tr class="headings">

                        <th class="column-title">Ad </th>
                        <th class="column-title text-center">Satış qiyməti (AZN) </th>
                        <th class="column-title text-center">Satış sayı </th>
                        <th width="90" class="column-title text-center">Məbləğ </th>
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
                      
                      $statistic_query = $db->prepare("SELECT * FROM statistic ORDER BY statistic_id DESC");
                      $statistic_query->execute();

                      while($statistic_result = $statistic_query->fetch(PDO::FETCH_ASSOC)){

                        $product_id = $statistic_result['statistic_product_id'];

                        $product_query = $db->prepare("SELECT * FROM products WHERE product_id = :id");
                        $product_query->execute(array( 'id' => $product_id ));

                        while($product_result = $product_query->fetch(PDO::FETCH_ASSOC)){

                          ?>

                          <tr class="even pointer">

                            <form action="dbnet/operations.php" method="GET">

                              <td class="text-"><?php echo $product_result['product_name']; ?></td>
                              <td class="text-center"><?php echo $product_result['product_sale_price']; ?></i></td>
                              <td class="text-center"><?php echo $statistic_result['statistic_sale_num']; ?></td>
                              <td class="text-center"><?php echo $statistic_result['statistic_sale_price'] *  $statistic_result['statistic_sale_num']; ?></td>

                              <input type="hidden" name="product_id" value="<?php echo $product_result['product_id']; ?>">
                              <input type="hidden" name="statistic_id" value="<?php echo $statistic_result['statistic_id']; ?>">
                              <input type="hidden" name="sale_num" value="<?php echo $statistic_result['statistic_sale_num']; ?>">

                              <input type="hidden" name="sale_return" value="true">

                              <td class=" "><button class="btn btn-danger btn-xx" style="width:110px;height:35px; margin-top:3px; margin-left:20px; padding-top:-7px; padding-right:50px"><i class="fa fa-mail-reply fa-"></i> Geri qaytar</button></td>

                            </form>

                          </tr>
                        <?php }} ?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer -->
      <?php include 'footer.php'; ?>
       <!-- /footer -->