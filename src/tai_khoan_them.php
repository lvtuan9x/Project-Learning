<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm tài khoản</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->
</head>

<body>
	<!-- <form method="post"> -->
	<?php include '../function.php';
	include 'navbar.php';
	if (isset($_POST['dx'])) {
		unset($_SESSION['tdn']);
		header("location:dang_nhap.php");
	}
	?>
	<!-- </form> -->
	<main style="min-height: 100vh; max-width: 100%;">

		<div id="action" style="margin: 20px 0 0 13%;">
			<p class="h3">Thêm tài khoản</p>
			<a href="tai_khoan.php" class="btn btn-primary">Trở lại</a>
		</div>
		<br>
		<div style="margin: 20px 13% 0 13%;">
			<form method="post" enctype="multipart/form-data">
				<label>Tên tài khoản <span style="color: red;">*</span></label>
				<input type="text" class="form-control" name="user_name" placeholder="Nhập tên tài khoản">
				<br>

				<label>Vai trò</label>
				<?php
					vai_tro("admin");
				?>
				<br><br>

				<label>Mật khẩu</label>
				<input type="password" class="form-control" name="password" placeholder="Mật khẩu">

				<br><br>
				<input type="submit" class="btn btn-primary mb-3" style="width:100%;" value="Thêm tài khoản" name="submit">
			</form>

			<?php
			if (isset($_POST['submit'])) {
				$ten_tai_khoan = trim($_POST['user_name']);
				$mat_khau = trim($_POST['password']);
				$vai_tro = $_POST['role'];

				if (empty($ten_tai_khoan)) {
					echo "<div class='alert alert-danger text-center' role='alert'>Vui lòng nhập tên tài khoản</div>";
				} else if (empty($mat_khau)) {
					echo "<div class='alert alert-danger text-center' role='alert'>Vui lòng nhập mật khẩu</div>";
				} else {
					$mat_khau_md5 = md5($mat_khau );
					$sql = "INSERT INTO tai_khoan (tai_khoan, mat_khau, vai_tro) VALUES('$ten_tai_khoan', '$mat_khau_md5', '$vai_tro')";
		
					$kq = mysqli_query($conn, $sql);

					if ($kq == true) {
						echo "<div class='alert alert-success text-center' role='alert'>Đã thêm tài khoản thành công !</div>";
					} else {
						echo "<div class='alert alert-danger text-center' role='alert'>Chưa thêm được tài khoản !</div>";
					}
				}
			}
			?>
		</div>
	</main>
</body>

</html>