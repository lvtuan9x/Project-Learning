<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Khóa học</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->

</head>
<body>
	<form method="post">
		<?php include 'navbar.php'; include '../function.php';
			if(!isLogin()){
				header("location:dang_nhap.php");
			}
		?>
	</form>

	<!-- <div id="action" style="margin: 30px 0 0 11%;">
		<a href="tai_khoan_them.php" class="btn btn-primary">Thêm tài khoản</a>
	</div> -->

	<main style="min-height: 100vh; width: 100%;">
		<div class="" style="text-align: center;">
			<h2>Khóa học</h2>
		</div>
		<div class="row row-cols-1 row-cols-md-3 g-4" style="margin: 0 auto; width: 80%;">
		<!-- begin khóa học -->
		<?php
			$sql = "SELECT * from khoa_hoc";
			$kq = mysqli_query($conn,$sql);
			foreach ($kq as $key=>$value) {
				khoa_hoc($value['id_khoa'],$value['ten_khoa']);
			}
		?>
		<!-- end khóa học -->
		</div>
	</main>
	<?php include 'footer.php'; ?>
	<?php 
		if(isset($_POST['dx'])){
			unset($_SESSION['tdn']);
			header("location:dang_nhap.php");
		}
	?>
</body>

	
</html>