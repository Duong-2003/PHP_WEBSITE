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
  <title>Liên hệ</title>

 

  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }

    .page-contacts .leave-your-message h3 {
      font-size: 24px;
      margin: 0;
      font-weight: 700;
      color: #5B5B5E;
      text-transform: uppercase;
    }

    .page-contacts .leave-your-message .p-bottom {
      color: #000;
      margin: 10px 0;
      font-size: 14px;
    }

    .page-contacts #contact {
      margin-bottom: 0;
    }

    .page-contacts #contact button {
      margin-top: 10px;
      height: 51px;
      font-size: 24px;
      width: 100%;
      border-radius: 30px;
      padding: initial;
      font-weight: bold;
      background: #9c8350;
      border-color: #9c8350;
      color:#fff;
    }

    .page-contacts #contact button:hover {
      background: #272728;
      border-color: #272728;
    }

    .contact-maps {
      height: 400px; /* Đảm bảo bản đồ có chiều cao */
    }
  </style>
</head>

<body>

  <?php 
      session_start();
  include( '../Sources/FE/top_header.php'); 
  include( '../Sources/FE/header.php'); 
  ?>

  <div class="container contact page-contacts" style="padding-top: 50px;">
    <div class="row contact-padding">
      <div class="col-lg-5 col-sm-12 leave-your-message order-md-2">
        <h3>Liên hệ chúng tôi</h3>
        <p class="p-bottom">Để liên hệ và nhận các thông tin khuyến mãi sớm nhất, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất.</p>
        <form method="post" action="/postcontact" id="contact" accept-charset="UTF-8" class="has-validation-callback">
          <input name="FormType" type="hidden" value="contact">
          <input name="utf8" type="hidden" value="true">
          <input type="hidden" id="Token" name="Token" value="">

          <script src="https://www.google.com/recaptcha/api.js?render=6Ldtu4IUAAAAAMQzG1gCw3wFlx_GytlZyLrXcsuK"></script>
          <script>
            grecaptcha.ready(function() {
              grecaptcha.execute("6Ldtu4IUAAAAAMQzG1gCw3wFlx_GytlZyLrXcsuK", { action: "contact" }).then(function(token) {
                document.getElementById("Token").value = token;
              });
            });
          </script>

          <div class="row">
            <div class="col-sm-12">
              <fieldset class="form-group">
                <label>Họ và tên<span class="required" style="color:red">*</span></label>
                <input placeholder="Nhập họ và tên" type="text" name="contact[name]" id="name" class="form-control form-control-lg" required>
              </fieldset>
            </div>
            <div class="col-sm-12">
              <fieldset class="form-group">
                <label>Email<span class="required" style="color:red">*</span></label>
                <input placeholder="Nhập địa chỉ Email" type="email" name="contact[email]" id="email" class="form-control form-control-lg" required>
              </fieldset>
            </div>
            <div class="col-sm-12">
              <fieldset class="form-group">
                <label>Điện thoại<span class="required" style="color:red">*</span></label>
                <input placeholder="Nhập số điện thoại" type="tel" name="contact[phone]" id="tel" class="form-control form-control-lg" required>
              </fieldset>
            </div>
            <div class="col-sm-12">
              <fieldset class="form-group">
                <label>Nội dung<span class="required" style="color:red">*</span></label>
                <textarea placeholder="Nội dung liên hệ" name="contact[body]" id="comment" class="form-control form-control-lg" rows="5" required></textarea>
              </fieldset>
              <fieldset class="form-group">
                <button type="submit" class="btn btn-blues btn-style btn-style-active">Gửi liên hệ ngay</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>

      <div class="col-lg-7 col-12 order-md-1">
        <div class="contact-maps">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9041492965453!2d105.81368901540243!3d21.036520892888156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab128b45bf23%3A0xd1d32b58169417cd!2zMjY2IMSQ4buZaSBD4bqlbiwgTGnhu4V1IEdpYWksIEJhIMSQw6xuaCwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1628424473479!5m2!1sen!2s" style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"></iframe>
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