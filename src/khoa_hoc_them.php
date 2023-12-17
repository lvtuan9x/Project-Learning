<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm khóa học</title>
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
			<p class="h3">Thêm khóa học</p>
			<a href="khoa_hoc_danh_sach.php" class="btn btn-primary">Trở lại</a>
		</div>
		<br>
		<div style="margin: 20px 13% 0 13%;">
			<form method="post" enctype="multipart/form-data">
				<label>Tên khóa học <span style="color: red;">*</span></label>
				<input type="texst" class="form-control" name="course" placeholder="Nhập tên khóa học">
				<br>

				<label>Id khóa học <span style="color: red;">*</span></label>
				<input type="text" class="form-control" name="id_course" placeholder="Nhập id khóa học">
				<br>

				<label>Mô tả</label>
				<input type="text" class="form-control" name="mo_ta" placeholder="Mô tả">

				<br><br>
				<input type="submit" class="btn btn-primary mb-3" style="width:100%;" value="Thêm khóa học" name="submit">
			</form>

			<?php
			if (isset($_POST['submit'])) {
				$ten_khoa_hoc = trim($_POST['course']);
				$id_khoa_hoc = trim($_POST['id_course']);
				$mo_ta = $_POST['mo_ta'];

				if (empty($ten_khoa_hoc)) {
					echo "<div class='alert alert-danger text-center' role='alert'>Vui lòng nhập tên khóa học</div>";
				} else if (empty($id_khoa_hoc)) {
					echo "<div class='alert alert-danger text-center' role='alert'>Vui lòng nhập id khóa học</div>";
				} else {
					$sql = "INSERT INTO khoa_hoc (ten_khoa, id_khoa, mo_ta) VALUES('$ten_khoa_hoc', '$id_khoa_hoc', '$mo_ta')";
		
					$kq = mysqli_query($conn, $sql);

					if ($kq == true) {
						echo "<div class='alert alert-success text-center' role='alert'>Đã thêm khóa học thành công !</div>";
					} else {
						echo "<div class='alert alert-danger text-center' role='alert'>Chưa thêm được khóa học !</div>";
					}
				}
			}
			?>
		</div>
	</main>
</body>

</html>