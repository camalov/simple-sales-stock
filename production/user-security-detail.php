<?php include 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Təhlükəsizlik və Giriş</h3>
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
            <h2>Şifrə <small>
              <?php  

              if($_GET['status'] == 'true'){ ?>              

                <b style="color:green;">Məlumatlarda edilmiş dəyişikliklər yadda saxlanıldı</b>

              <?php }else if($_GET['status'] == 'false'){ ?>

                <b style="color:red;">Məlumatlarda edilmiş dəyişikliklər yadda saxlanılmadı</b>

              <?php  }else if($_GET['status'] == 'incorrect_passwords'){ ?>

                <b style="color:red;">Daxil edilmiş yeni şifrələr uyğun gəlmir</b> 

              <?php }else if($_GET['status'] == 'available'){ ?>

                <b style="color:red;">Yeni şifrə daxil edin</b> 
                
                <?php } ?></small></h2>
                <hr>                
                <div class="clearfix"></div>
              </div>
              <div class="x_contet">

                <form action="dbnet/operations.php" method="POST" class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Mövcud şifrəni daxil edin <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-xs-12">
                      <input type="password" name="user_password" placeholder="Mövcud şifrəni daxil edin" id="password_1" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Yeni şifrə <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-xs-12">
                      <input type="password" name="new_password_1" placeholder="Yeni şifrə daxil edin"  id="password_2" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Yeni şifrəni təkrar daxil edin <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-xs-12">
                      <input type="password" name="new_password_2" placeholder="Yeni şifrəni təkrar yazın"  id="password_3" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name"></label>
                    <div class="col-md-6 col-xs-12">
                      <input type="checkbox" onchange="document.getElementById('password_1').type = this.checked ? 'text' : 'password'; document.getElementById('password_2').type = this.checked ? 'text' : 'password'; ; document.getElementById('password_3').type = this.checked ? 'text' : 'password'"> Şifrəni göstər
                    </div>
                  </div>

                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="user_password_change" class="btn btn-primary">Yadda saxla</button>
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