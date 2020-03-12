
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->    
    <link rel="stylesheet" href="/lib/admin/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/lib/admin/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/admin/libs/css/style.css">
    <link rel="stylesheet" href="/lib/admin/vendor/fonts/fontawesome/css/fontawesome-all.css"> 
    <style> html, body { height: 100%; } body { display: -ms-flexbox; display: flex; -ms-flex-align: center; align-items: center;  padding-bottom: 40px; }</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <?php if(isset($_SESSION['success'])): ?>
              <!--Thông báo thành công từ đăng ký-->
              <div class="alert alert-success">
                  <strong style="color: green"><?php echo $_SESSION['success'];unset($_SESSION['success']) ?></strong> 
              </div>
            <?php endif ?>
            <?php if(isset($_SESSION['error'])): ?>
              <!--Thông báo không thành công-->
              <div class="alert alert-danger">
                  <strong style="color: red"><?php echo $_SESSION['error'];unset($_SESSION['error']) ?></strong> 
              </div>
            <?php endif ?>
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="lib/admin/images/logo.png" alt="logo"></a><span class="splash-description">Nhập thông tin đăng nhập của bạn.</span></div>
            <div class="card-body">
                <form method="POST" action="login/postLogin">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="name" id="name" type="text" placeholder="Tên đăng nhập" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Mật khẩu">
                    </div> 
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Đăng nhập</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Tạo tài khoản</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Quên mật khẩu</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="/lib/admin/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="/lib/admin/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>