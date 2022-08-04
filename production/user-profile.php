<?php include 'header.php'; 

$user_info_query = $db->prepare("SELECT * FROM user WHERE user_name = :name ");
$user_info_query->execute(array( 'name' => $_SESSION['user'] ));
$user_info_result = $user_info_query->fetch(PDO::FETCH_ASSOC);
$user_id = $user_info_result['user_id'];

?>
<!-- page content -->
<div class="right_col" role="main">

  <div class="page-title">
    <div class="title_left">
      <h3>Hesab Məlumatları</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Hesab məlumatlarının redaktə bölməsi<small>

            <?php
            if($_GET['status']=='true'){ ?>              

              <b style="color:green;">Məlumatlarda edilmiş dəyişikliklər yadda saxlanıldı</b>

            <?php }else if($_GET['status']=='false'){ ?>

              <b style="color:red;">Məlumatlarda edilmiş dəyişikliklər yadda saxlanılmadı</b>

            <?php  }else if($_GET['new_user_name'] == 'available'){ ?>

             <b style="color:red;">Daxil etdiyiniz istifadəçi adı artıq mövcuddur</b>

             <?php }else if($_GET['status'] == 'systemless_command'){ ?>

             <b style="color:red;">Sistemdən kənar əməliyyat qeydə alındı. Səhifəyə girişiniz məhdudlaşdırıldı</b>

             <?php } ?></small></h2>

             <div class="clearfix"></div>
           </div>
           <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="<?php echo $user_img; ?>">
                </div>
              </div>
              <h3><?php echo $user_info_result['user_namelastname']; ?></h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $user_info_result['user_address']; ?>
              </li>

              <li class="m-top-xs">
                <i class="<?php if($user_info_result['user_gender'] == '1'){ echo "fas fa-user-tie"; }else if($user_info_result['user_gender'] == '0'){ echo "fas fa-female"; }else{ echo "fas fa-user-tie"; } ?>"></i> <?php echo $user_info_result['user_name']; ?>
              </li>
            </ul>

            <a class="btn btn-info" href="new-profile-photo-update.php?user_id=<?php echo $user_id ?>"><i class="fa fa-photo m-right-xs"></i> Profil şəklini yenilə</a>

            <form action="dbnet/operations.php" method="POST">

              <input type="hidden" name="user_photo_url" value="<?php echo $user_info_result['user_photo_url']; ?>">
              <input type="hidden" name="user_id" value="<?php echo $user_info_result['user_id']; ?>">

              <?php if(strlen($user_info_result['user_photo_url']) > '0' ){ ?>

                <button class="btn btn-danger" type="submit" name="user_photo_del"><i class="fa fa-trash-o m-right-xs"></i> Profil şəklini sil</button>

              <?php } ?>


            </form>
            
            <br />

            <!-- start skills -->

            <!-- end of skills -->

          </div>

          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="title">

              <form class="form-horizontal form-label-left" action="dbnet/operations.php" method="POST">

                <input type="hidden" name="user_id" value="<?php echo $user_info_result['user_id']; ?>">

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">İstifadəçi adı <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="user_name" value="<?php echo $user_info_result['user_name']; ?>" placeholder="İstifadəçi adı daxil edin" maxlength="15" required="required" type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad Soyad <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="user_namelastname" value="<?php echo $user_info_result['user_namelastname']; ?>" placeholder="Ad Soyad" maxlength="20" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-poçt <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email" id="email2" name="user_email" value="<?php echo $user_info_result['user_email']; ?>" placeholder="E-poçt ünvanınızı daxil edin" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    type = "email"
                    maxlength = "50">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Telefon nömrəsi 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" id="number" name="user_mob" value="<?php echo $user_info_result['user_mob']; ?>" placeholder="Telefon nömrənizi daxil edin" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    type = "number"
                    maxlength = "20">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Ölkə, şəhər, ünvan <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="user_address" value="<?php echo $user_info_result['user_address']; ?>" placeholder="Yaşadığınız ünvanı daxil edin" maxlength="100" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="ln_solid" style="margin-top:-1px;"></div>
                <div class="form-group" align="right">
                  <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" name="user_detail" class="btn btn-primary">Yadda saxla</button>
                  </div>
                </div>
              </form>
            </div>
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