<?php include 'header.php'; 

$product_query = $db->prepare("SELECT * FROM products WHERE product_id = :id");
$product_query->execute(array( 'id' => $_GET['product_id'] ));
$product_result = $product_query->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Məhsullar</h3>
      </div>

<!--   <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div> -->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div>
            <h2>Redaktə<small>              

              <?php  

              if($_GET['status']=='true'){ ?>              

                <b style="color:green;">Əməliyyat yerinə yetirildi...</b>

              <?php }else if($_GET['status']=='false'){ ?>

                <b style="color:red;">Əməliyyat yerinə yetirilərkən səhv baş verdi...</b>

              <?php  }else if($_GET['status']=='price_false'){ ?>

                <b style="color:red;">Satış qiyməti, alış qiymətindən böyük olmalıdır</b>

                <?php  } ?></small></h2>
                <div class="clearfix" align="right" style="margin-top:-33px; margin-bottom: 3px;"><a href="products.php"><button type="button" class="btn btn-round btn-warning"><i class="fa fa-fas fa-arrow-circle-left"></i> Geri qayıt</button></a>
                </div></h2>
                <hr>
              </div>
              <div class="clearfix"></div>
              <form action="dbnet/operations.php" method="POST" class="form-horizontal form-label-left">

                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">

                <div class="form-group">
                  <label class="control-label col-md-3 col-xs-12" for="first-name">Ad <span class="required">*</span>
                  </label>
                  <div class="col-md-6">
                    <input type="text" name="product_name" placeholder="Məhsul adını daxil edin" value="<?php echo $product_result['product_name']; ?>" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-xs-12" for="first-name">Alış qiyməti </label>
                  <div class="col-md-6">
                    <input type="number" step="any" name="product_purchase_price" min="0" placeholder="AZN" value="<?php echo $product_result['product_purchase_price']; ?>"  id="first-name2" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-xs-12" for="first-name">Satış qiyməti </label>
                  <div class="col-md-6">
                    <input type="number" step="any" name="product_sale_price" min="0" placeholder="AZN"  id="first-name2" value="<?php echo $product_result['product_sale_price']; ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-xs-12" for="first-name">Sayı <span class="required">*</span></label>
                  <div class="col-md-6">
                    <input type="number" name="product_number" min="1" placeholder="Məhsul sayı"  required="" id="first-name2" value="<?php echo $product_result['product_number']; ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>


                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="product-edit" class="btn btn-primary">Yadda saxla</button>
                </div>
              </form>        
            </form>
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