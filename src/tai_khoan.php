<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm câu hỏi điền từ</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->
</head>

<body>
	<?php
		include 'navbar.php';
		include '../function.php';
	?>

	<main style="min-height: 100vh; max-width: 100%;">

		<div id="action" style="margin: 20px 0 0 13%;">
			<p class="h3">Danh sách tài khoản</p>
			<a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a>
			<a href="tai_khoan_them.php" class="btn btn-primary">Thêm tài khoản</a>

			<?php
				if (isset($_POST['tai_khoan_delete'])){
					$value = $_POST['tai_khoan_delete'];
					$sql = "DELETE from tai_khoan where tai_khoan = '$value'";
					mysqli_query($conn, $sql);
					header("location: tai_khoan.php");
				}

				if (isset($_POST['tai_khoan_update'])){
					$value = $_POST['tai_khoan_update'];
					header("location: tai_khoan_sua.php?tai_khoan=$value");
				}
			?>
		</div>
		<br>
		<div style="margin: 20px 13% 0 13%;">
			<table class="table table-striped">
				<form method="post">
					<tr>
						<th>STT</th>
						<th>Tên tài khoản</th>
						<th>Vai trò</th>
						<th>Thao tác</th>
					</tr>
					<tr>
						<?php
							$tdn = $_SESSION['tdn'];
							$sql = "SELECT * from tai_khoan";
							$kq = mysqli_query($conn, $sql);
							if (mysqli_num_rows($kq) == 0) {
								echo '<td align="center" colspan="7">Không có tài khoản nào</td>';
							} else {
								$dem = 1;
								foreach ($kq as $key => $value) {
									echo '<tr>';
									echo "<td>" . $dem . "</td>";
									echo "<td>" . $value['tai_khoan'] . "</td>";
									echo "<td>" . $value['vai_tro'] . "</td>";
									echo "<td><button type = submit name = 'tai_khoan_update' value = '" . $value['tai_khoan'] . "' class='btn btn-primary' style = 'background:green'>Sửa</button>";
									echo " <button type = submit name = 'tai_khoan_delete' value = '" . $value['tai_khoan'] . "' class='btn btn-primary' style = 'background:red'>Xóa</button></td>";
									echo '</tr>';
									$dem++;
								}
							}
						?>
					</tr>
				</form>
			</table>
		</div>
	</main>
</body>

</html>