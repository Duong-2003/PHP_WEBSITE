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
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }

    #ctn {
      background-image: url(../Assets/img/index/bg_sp_noibat.jpg);
      background-size: cover;
      background-position: center;
      padding: 30px 0;
    }

    .error>p {
      font-size: 18px;
      text-align: center;
      font-weight: 600;
    }

    .account-box-shadow {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }

    .account-content .auth-block__menu-list {
      list-style: none;
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #eee;
      margin-bottom: 20px;
    }

    .auth-block__menu-list li a {
      flex: 1;
      text-align: center;
      padding: 10px;
      font-size: 16px;
      color: #999;
      transition: color 0.3s;
    }

    .auth-block__menu-list li.active a {
      font-weight: 600;
      color: #303846;
    }

    .auth-block__menu-list li a:hover {
      color: #9c8350;
    }

    .btn-blues {
      background-color: #9c8350;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .btn-blues:hover {
      background-color: #7a663e;
    }

    .form-signup .form-control {
      height: 45px;
      border-radius: 8px;
      border: 1px solid #ced4da;
      box-shadow: none;
    }

    .form-signup label {
      font-weight: 600;
    }

    .login--notes {
      text-align: center;
      color: #999;
      font-size: 14px;
      margin-top: 10px;
    }

    .line-break {
      text-align: center;
      margin: 20px 0;
    }

    .line-break span {
      display: inline-block;
      font-size: 14px;
      color: #999;
      padding: 5px 10px;
      border-radius: 15px;
      border: 1px solid #eee;
      background-color: #fff;
      position: relative;
      z-index: 1;
    }

    .social-login img {
      max-width: 100%;
      height: auto;
      transition: transform 0.3s;
    }

    .social-login img:hover {
      transform: scale(1.05);
    }
    button#registerSubmit {
    background-color: bisque;
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
                      <input id="name" placeholder="Họ và tên của bạn" type="text" class="form-control" name="name" required>
                    </fieldset>
                    <fieldset class="form-group margin-bottom-0">
                      <label>Mật khẩu<span style="color: red;">*</span></label>
                      <input id="password" placeholder="Nhập mật khẩu" type="password" name="password" autocomplete="new-password" class="form-control" required>
                    </fieldset>
                    <fieldset class="form-group margin-bottom-0">
                      <label>Nhập lại mật khẩu<span style="color: red;">*</span></label>
                      <input name="resetpass" placeholder="Nhập lại mật khẩu" id="resetpass" type="password" class="form-control" required>
                    </fieldset>

                    <div class="clearfix"></div>

                    <p class="text-right recover">
                      <a href="#" class="btn-link-style" onclick="showRecoverPasswordForm();" title="Quên mật khẩu?">Quên mật khẩu?</a>
                    </p>
                    <div class="text-center" style="margin-top: 15px;">
                      <button class="btn btn-blues" type="submit" id="registerSubmit" name="submit">Đăng ký</button>
                    </div>
                    <p class="login--notes">Chúng tôi cam kết bảo mật thông tin của bạn.</p>
                  </div>
                </form>

                <div class="clearfix"></div>
                <div class="line-break">
                  <span>hoặc đăng ký qua</span>
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