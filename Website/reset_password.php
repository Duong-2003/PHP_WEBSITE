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

    .account-box-shadow {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }

    .error>p {
      font-size: 18px;
      text-align: center;
      font-weight: 600;
    }

    .auth-block__menu-list {
      list-style: none;
      display: flex;
      justify-content: center;
      border-bottom: 1px solid #eee;
      margin-bottom: 20px;
    }

    .auth-block__menu-list li {
      margin: 0 15px;
    }

    .auth-block__menu-list li a {
      font-size: 20px;
      color: #999;
      transition: color 0.3s;
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

    .form-control {
      height: 45px;
      border-radius: 8px;
      border: 1px solid #ced4da;
      box-shadow: none;
    }

    .form-group label {
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
    button#loginSubmit {
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
                    <button class="btn btn-blues" type="submit" id="loginSubmit" name="submit">Thay đổi</button>
                  </div>

                  
                </div>
              </div>

              <div id="recover-password" class="form-signup" style="display:none;">
                <div class="fix-sblock text-center">
                  Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua email.
                </div>
                <form method="post" action="/account/recover" id="recover_customer_password" accept-charset="UTF-8" class="has-validation-callback">
                  <fieldset class="form-group">
                    <label>Tài khoản<span class="required">*</span></label>
                    <input id="recover_account" placeholder="Nhập tài khoản" type="text" class="form-control" name="account" required>
                  </fieldset>

                  <div class="action_bottom text-center">
                    <button class="btn btn-blues" style="margin-top: 10px;" type="submit" value="Lấy lại mật khẩu">Lấy lại mật khẩu</button>
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