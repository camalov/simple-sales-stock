<?php include 'header.php'; ?>

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
            <h2>Yeni məhsul</h2>
            <hr>
          </div>
          <div class="clearfix"></div>
          <form action="dbnet/operations.php" method="POST" class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-xs-12" for="first-name">Ad <span class="required">*</span>
              </label>
              <div class="col-md-6">
                <input type="text" name="product_name" placeholder="Məhsul adını daxil edin" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-xs-12" for="first-name">Alış qiyməti </label>
              <div class="col-md-6">
                <input type="number" step="any" name="product_purchase_price" min="0" placeholder="AZN"  id="first-name2" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-xs-12" for="first-name">Satış qiyməti </label>
              <div class="col-md-6">
                <input type="number float" step="any" name="product_sale_price" min="0" placeholder="AZN"  id="first-name2" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-xs-12" for="first-name">Sayı <span class="required">*</span></label>
              <div class="col-md-6">
                <input type="number" name="product_number" min="1" placeholder="Məhsul sayı"  required="" id="first-name2" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="new_product" class="btn btn-primary">Yadda saxla</button>
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