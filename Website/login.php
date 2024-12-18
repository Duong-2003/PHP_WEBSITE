<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <title>Login</title>
  

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

   a#link-style {
      margin-top: 0;
      color: #9c8350;
      font-size: 13px;
      font-weight: normal;
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
    #ctn{

    background-image: url(../Assets/img/index/bg_sp_noibat.jpg);
    }
  </style>
</head>

<body>

  <?php
   session_start();
   
    include('../Sources/FE/top_header.php');
    include('../Sources/FE/header.php');

    ?>

  <div class="container py-5 " id="ctn">
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
                  <a href="../Website/login.php" title="Đăng nhập">Đăng nhập</a>
                </li>
                <li>
                  <a href="../Website/register.php" title="Đăng ký">Đăng ký</a>
                </li>
              </ul>
              <div id="nd-login">
                <form action="<?= '../Sources/BE/login_process.php' ?>" method="post" id="customer_login"
                  accept-charset="UTF-8" class="has-validation-callback">
                  <input name="FormType" type="hidden" value="customer_login">
                  <input name="utf8" type="hidden" value="true">
                  <input name="ReturnUrl" type="hidden" value="/username">

                  <fieldset class="form-group margin-bottom-10">
                    <label>Tài khoản<span style="color: red;">*</span></label>
                    <input id="username" placeholder="Nhập tài khoản" type="text" class="form-control" name="username"
                      required>
                  </fieldset>

                  <fieldset class="form-group margin-bottom-0">
                    <label>Mật khẩu<span style="color: red;">*</span></label>
                    <input type="password" placeholder="Nhập mật khẩu" id="password" class="form-control"
                      name="password" required>
                  </fieldset>

                  <div class="clearfix"></div>
                  <p class="text-right recover">
                    <a href="#" class="" id="link-style" title="Quên mật khẩu?">
                      <a  id="link-style"  href="../website/resetpass.php">Quên mật khẩu?</a>
                  </p>

                  <div class="text-center" style="margin-top: 15px;">
                    <button class="btn  btn-blues" type="submit" id="loginSubmit" name="submit">Đăng
                      nhập</button>
                  </div>

                  <p class="login--notes">Chúng tôi cam kết bảo mật và sẽ không bao giờ chia sẻ thông tin của bạn.</p>
                </form>

                <div class="line-break text-center">
                  <span>hoặc đăng nhập qua</span>
                </div>
                <div class="social-login text-center">


                  <a href="" class="social-login--facebook" onclick="loginFacebook()">
                    <img width="129px" height="37px" alt="facebook-login-button"
                      src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg">
                  </a>
                  <a href="" class="social-login--google" onclick="loginGoogle()">
                    <img width="129px" height="37px" alt="google-login-button"
                      src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg">
                  </a>
                </div>
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