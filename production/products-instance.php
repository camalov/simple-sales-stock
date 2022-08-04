<?php include 'header.php';

include 'dbnet/connection.php'; 

if(isset($_POST['searching_list'])){

  $searching_word = $_POST['searching_word'];
  $product_query = $db->prepare("SELECT * FROM products WHERE product_name LIKE '%$searching_word%' LIMIT 25");
  $product_query->execute();

  $result_count = $product_query->rowCount();

}else{

  $product_query = $db->prepare("SELECT * FROM products LIMIT 25");
  $product_query->execute();

}

?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Məhsullar </h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mövcud məhsullar<small>              

              <?php
              if($_GET['status']=='true'){ ?>              

                <b style="color:green;">Əməliyyat yerinə yetirildi...</b>

              <?php }else if($_GET['status']=='false'){ ?>

                <b style="color:red;">Əməliyyat yerinə yetirilərkən səhv baş verdi...</b>

                <?php  } ?></small></h2>

                <div class="clearfix" align="right" style="<?php if($_GET['status']=='true' or $_GET['status']=='false'){ ?> margin-top:-27px; <? } ?>"><a href="product-add.php"><button type="button" class="btn btn-round btn-primary">Yeni məhsul</button></a></div>

                <div class="clearfix"></div>

              </div>
              <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered">

                  <thead>
                    <tr>
                      <th>Ad</th>
                      <th>Alış qiyməti (AZN)</th>
                      <th>Satış qiyməti (AZN)</th>
                      <th>Sayı</th>
                      <th>Qazanc (%)</th>
                      <th width="80" class="column-title"> </th>
                      <th width="80" class="column-title"> </th>

                    </tr>
                  </thead>

                  <?php while($product_result = $product_query->fetch(PDO::FETCH_ASSOC)){ ?>

                    <tbody>
                      <tr>
                        <td><?php echo $product_result['product_name']; ?></td>
                        <td><?php echo $product_result['product_purchase_price']; ?></td>
                        <td><?php echo $product_result['product_sale_price']; ?></td>
                        <td><?php echo $product_result['product_number']; ?></td>
                        <td><?php echo $product_result['product_earnings']; ?></td>

                        <td class=" " align="center"><a href="product-edit.php?product_id=<?php echo $product_result['product_id']; ?>"><button class="btn btn-primary btn-xs" style="width:90px;"><i class="fa fa-pencil"></i> Redaktə et</button></a></td>

                        <td class=" " align="center"><a href="dbnet/operations.php?product_del=true&product_id=<?php echo $product_result['product_id']; ?>"><button class="btn btn-danger btn-xs" style="width:80px;"><i class="fa fa-trash"></i> Sil</button></a></td>

                      </tr>
                    </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- /page content -->

    <!-- footer content -->

    <?php include 'footer.php'; ?>

  </body>
  </html>