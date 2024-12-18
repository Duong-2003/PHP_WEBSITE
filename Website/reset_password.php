<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <title>Quên Mật Khẩu</title>



  <style>
    

  

    .error>p {
      font-size: 20px;
      text-align: center;
      font-weight: 600;
    }

    .account-box-shadow .account-content .auth-block__menu-list {
      list-style: none;
      display: flex;
      height: 50px;
      border-bottom: 1px solid #eee;
    }

    .account-box-shadow .account-content .auth-block__menu-list li {
      flex: 1 1;
      text-align: center;
     
      position: relative;
    }

    .account-box-shadow .account-content .auth-block__menu-list li.active:before {
      content: "";
      position: absolute;
      height: 1px;
      left: 30px;
      right: 60px;
      bottom: -1px;
      background-color: #9c8350;
    }

    .account-box-shadow .account-content .auth-block__menu-list li.active a {
      font-weight: 600;
      color: #303846;
    }

    .account-box-shadow .account-content .auth-block__menu-list li a {
      display: flex;
      height: 100%;
      width: 100%;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      line-height: 22px;
      color: #999;
    }

    .page-login .btn-blues {
      padding: 0;
      height: 40px;
      font-weight: 700;
      font-size: 13px;
      width: 100%;
      border-radius: 4px;
      background-color: #999;
    }

    .login--notes {
      text-align: center;
      color: #999;
      font-size: 12px;
      margin-top: 10px;
      line-height: 1.1;
    }

    .line-break span {
      display: inline-block;
      font-size: 13px;
      color: #999;
      padding: 1px 10px;
      border-radius: 15px;
      border: 1px solid #eee;
      background-color: #fff;
      position: relative;
      z-index: 1;
    }

    .page-login .form-group label {
      font-weight: 600;
      font-size: 14px;
      text-transform: uppercase;
      margin-bottom: 5px;
    }

    .page-login input[type="text"],
    .page-login input[type="email"],
    .page-login input[type="password"] {
      background: #fafafa;
      height: 40px;
      padding: 0 15px;
      border: 1px solid #ececec;
      outline: none;
      box-shadow: none;
    }
    .line-break {
    text-align: center;
}
#ctn{
  background-image: url(../Assets/img/index/bg_sp_noibat.jpg);
}
  </style>
</head>

<body>
  <?php include('../Sources/FE/top_header.php'); ?>
  <?php include('../Sources/FE/header.php'); ?>

  
 <div class="container py-5" id="ctn">
    <div class="row justify-content-md-center">
      <div class="col-lg-7 col-md-12">
        <div class="page-login account-box-shadow">
          <div id="login" class="row">
            <div class="error">
              <?php
              $error = isset($_GET["error"]) ? $_GET["error"] : '';
              $notifi = isset($_GET["notifi"]) ? $_GET["notifi"] : '';
              ?>
              <p id="notifi_log" class="text-success"><?= $notifi ?></p>
              <p id="error_log" class="text-danger"><?= $error ?></p>
            </div>
            <div class="col-lg-12 col-md-12 account-content">
              <ul class="auth-block__menu-list">
                <li class="active">
                  <a href="../Website/reset_password.php" title="Quên mật khẩu">Quên mật khẩu</a>
                </li>
               
              </ul>
              <div id="nd-resetpass">
              <form action="<?='../Sources/BE/reset_pass_process.php' ?>" method="post">
                  <input name="FormType" type="hidden" value="customer_login">
                  <input name="utf8" type="hidden" value="true">
                  <input name="ReturnUrl" type="hidden" value="username">

                  <fieldset class="form-group margin-bottom-10">
                    <label>Tài khoản<span style="color: red;">*</span></label>
                    <input placeholder="Tài khoản của bạn" id="username" type="text" class="form-control" name="username" required>
                  </fieldset>

                  <fieldset class="form-group margin-bottom-0">
                    <label>Email<span style="color: red;">*</span></label>
                    <input id="email" placeholder="Email của bạn" type="email" class="form-control" name="email" required>
                  </fieldset>

                  <fieldset class="form-group margin-bottom-0">
                    <label>Mật khẩu mới<span style="color: red;">*</span></label>
                    <input type="password" placeholder="Mật khẩu mới" id="resetpassword" class="form-control" name="resetpassword" required>
                  </fieldset>

                 
                  <div class="text-center" style="margin-top: 15px;">
                    <button class="btn btn-style btn-blues" type="submit" id="loginSubmit" name="submit">Thay đổi</button>
                  </div>

                  <p class="login--notes">Chúng tôi cam kết bảo mật và sẽ không bao giờ chia sẻ thông tin của bạn.</p>
                </form>

                <div class="line-break">
                  <span>hoặc đăng nhập qua</span>
                </div>
                <div class="social-login text-center">
                 
             
                  <a href="javascript:void(0)" class="social-login--facebook" onclick="loginFacebook()">
                    <img width="129px" height="37px" alt="facebook-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg">
                  </a>
                  <a href="javascript:void(0)" class="social-login--google" onclick="loginGoogle()">
                    <img width="129px" height="37px" alt="google-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg">
                  </a>
                </div>
              </div>

              <div id="recover-password" class="form-signup" style="display:none;">
                <div class="fix-sblock text-center">
                  Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua email.
                </div>
                <form method="post" action="/account/recover" id="recover_customer_password" accept-charset="UTF-8" class="has-validation-callback">
                  <input name="FormType" type="hidden" value="recover_customer_password">
                  <input name="utf8" type="hidden" value="true">
                  
                  <fieldset class="form-group">
                    <label>Tài khoản<span class="required">*</span></label>
                    <input id="recover_account" placeholder="Nhập tài khoản" type="text" class="form-control" name="account" required>
                  </fieldset>

                  <div class="action_bottom text-center">
                    <button class="btn btn-style btn-blues" style="margin-top: 10px;" type="submit" value="Lấy lại mật khẩu">Lấy lại mật khẩu</button>
                  </div>
                  <div class="text-login text-center">
                    <p>Quay lại <a href="javascript:;" class="btn-link-style btn-register" onclick="hideRecoverPasswordForm();" title="Quay lại">tại đây.</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
  include('../Sources/FE/footer_save.php');
  include("../Sources/FE/footer.php");  
  ?>
</body>

</html>