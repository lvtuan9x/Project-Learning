<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="khoa_hoc.php">ProjectPHP K71</a>
    <a class="navbar-brand" href="khoa_hoc_danh_sach.php">Quản lý khóa học</a>
    <a class="navbar-brand" href="tai_khoan.php">Quản lý tài khoản</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <?php echo $_SESSION['tdn']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <form method="post">
            <li><input type="submit" name="dx" value="Đăng xuất" style="width: 100%; height: 100%;"></li>
            </form>
            <?php 
              if (isset($_POST['dx'])){
                unset($_SESSION['tdn']);
                header("location: dang_nhap.php");  
              }
            ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>