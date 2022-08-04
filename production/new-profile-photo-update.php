<?php include 'header.php'; 


$user_info_query = $db->prepare("SELECT * FROM user WHERE user_id = ?");
$user_info_query->execute(array($_GET['user_id']));
$user_info_result = $user_info_query->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Hesab Əməliyyatları</h3>
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
            <h2>Profil şəklinizi yeniləyirsiniz</h2>
                <div class="clearfix" align="right" style="margin-top:-33px; margin-bottom: 3px;"><a href="user-profile.php"><button type="button" class="btn btn-round btn-warning"><i class="fa fa-fas fa-arrow-circle-left"></i> Geri qayıt</button></a>
                  <hr>
                </div>
                <div class="clearfix"></div>
                <form action="dbnet/operations.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">

                  <input type="hidden" name="user_id" value="<?php echo $user_info_result['user_id']; ?>">
                  <input type="hidden" name="old_user_photo_url" value="<?php echo $user_info_result['user_photo_url']; ?>">

                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name"></label>
                    <div class="col-md-55">
                      <div class="thumbnail">
                        <div class="image view view-first">
                          <img style="width:100%; height:100%; display: block;" src="<?php echo $user_img; ?>" />
                          <div class="mask">
                            <p><?php echo $user_info_result['user_namelastname']; ?></p>
                            <div class="tools tools-bottom">

                            </div>
                          </div>
                        </div>
                        <div class="caption">
                          <p>Mövcud profil şəkliniz</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Profil şəklinizi seçin <span class="required">*</span>
                    </label>
                    <div class="col-md-6">
                      <input type="file" name="user_photo_url" value="" required="" id="first-name2" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="user_new_photo" class="btn btn-primary">Yadda saxla</button>
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