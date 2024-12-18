<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <title>Register</title>

 

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
      right: 30px;
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
      font-size: 15px;
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
a.btn-link-style {
    margin-top: 0;
    color: #9c8350;
    font-size: 13px;
    font-weight: normal;
}
#ctn{
  background-image: url(../Assets/img/index/bg_sp_noibat.jpg);
}
  </style>
</head>

<body>

  <?php include( '../Sources/FE/top_header.php'); ?>
  <?php include( '../Sources/FE/header.php'); ?>

  <div class="container py-5" id="ctn">
    <div class="row justify-content-md-center">
      <div class="col-lg-7 col-md-12">
        <div class="page-login account-box-shadow">
          <div id="register" class="row">
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
                <li>
                  <a href="../Website/login.php" title="Đăng nhập">Đăng nhập</a>
                </li>
                <li class="active">
                  <a href="../Website/register.php" title="Đăng ký">Đăng ký</a>
                </li>
              </ul>
              <div id="nd-register">
                <form action="<?= '../Sources/BE/register_process.php' ?>" method="post" id="customer_register" accept-charset="UTF-8" class="has-validation-callback">
                  <input name="FormType" type="hidden" value="customer_register">
                  <input name="utf8" type="hidden" value="true">

                  <div class="form-signup clearfix">
                    <fieldset class="form-group margin-bottom-10">
                      <label>Email<span style="color: red;">*</span></label>
                      <input id="email" placeholder="Email của bạn" type="email" class="form-control" name="email" required>
                    </fieldset>
                    <fieldset class="form-group margin-bottom-10">
                      <label>Tài khoản<span style="color: red;">*</span></label>
                      <input id="username" placeholder="Tài khoản bạn muốn đăng ký" type="text" class="form-control" name="username" required>
                    </fieldset>
                    <fieldset class="form-group margin-bottom-10">
                      <label>Họ và tên của bạn<span style="color: red;">*</span></label>
                      <input id="name" placeholder="Tài khoản bạn muốn đăng ký" type="text" class="form-control" name="name" required>
                    </fieldset>
                    <fieldset class="form-group margin-bottom-0">
                      <label>Mật khẩu<span style="color: red;">*</span></label>
                      <input id="password" placeholder="Nhập mật khẩu" type="password" name="password" autocomplete="new-password" class="form-control" required>
                    </fieldset>
                    <fieldset class="form-group margin-bottom-0">
                      <label>Nhập lại mật khẩu<span style="color: red;">*</span></label>
                      <input name="resetpass" placeholder="Nhập lại mật khẩu" id="resetpass" type="password" class="form-control" required>
                    </fieldset>
                    <!-- <fieldset class="form-group margin-bottom-0">
                      <label>Địa chỉ<span style="color: red;">*</span></label>
                      <input id="address" placeholder="Địa chỉ của bạn" type="text" class="form-control" name="address" required>
                    </fieldset> -->
                    <div class="clearfix"></div>
                    
                  <p class="text-right recover">
                    <a href="#" class="btn-link-style" onclick="showRecoverPasswordForm();" title="Quên mật khẩu?">Quên mật khẩu?</a>
                  </p>
                    <div class="pull-xs-left text-center" style="margin-top: 15px;">
                      <button class="btn btn-style btn-blues" type="submit" id="registerSubmit" name="submit">Đăng ký</button>
                    </div>
                    <p class="login--notes">Chúng tôi cam kết bảo mật thông tin của bạn.</p>
                  </div>
                </form>

                <div class="clearfix"></div>
                <div class="line-break">
                  <span>hoặc đăng ký qua</span>
                </div>
                <div class="social-login text-center">
                  <script>
                    function loginFacebook() {
                      var a = {
                        client_id: "947410958642584",
                        redirect_uri: "https://store.mysapo.net/account/facebook_account_callback",
                        state: JSON.stringify({ redirect_url: window.location.href }),
                        scope: "email",
                        response_type: "code"
                      };
                      var b = "https://www.facebook.com/v3.2/dialog/oauth" + encodeURIParams(a, !0);
                      window.location.href = b;
                    }

                    function loginGoogle() {
                      var a = {
                        client_id: "997675985899-pu3vhvc2rngfcuqgh5ddgt7mpibgrasr.apps.googleusercontent.com",
                        redirect_uri: "https://store.mysapo.net/account/google_account_callback",
                        scope: "email profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
                        access_type: "online",
                        state: JSON.stringify({ redirect_url: window.location.href }),
                        response_type: "code"
                      };
                      var b = "https://accounts.google.com/o/oauth2/v2/auth" + encodeURIParams(a, !0);
                      window.location.href = b;
                    }

                    function encodeURIParams(a, b) {
                      var c = [];
                      for (var d in a)
                        if (a.hasOwnProperty(d)) {
                          var e = a[d];
                          null != e && c.push(encodeURIComponent(d) + "=" + encodeURIComponent(e));
                        }
                      return 0 == c.length ? "" : (b ? "?" : "") + c.join("&");
                    }
                  </script>
                  <a href="javascript:void(0)" class="social-login--facebook" onclick="loginFacebook()">
                    <img width="129px" height="37px" alt="facebook-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg">
                  </a>
                  <a href="javascript:void(0)" class="social-login--google" onclick="loginGoogle()">
                    <img width="129px" height="37px" alt="google-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php 
  include('../Sources/FE/footer_save.php');
  include( "../Sources/FE/footer.php"); 
   ?>

</body>

</html>