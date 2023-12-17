<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Danh sách khóa học</title>
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
			<p class="h3">Danh sách khóa học</p>
			<a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a>
			<a href="khoa_hoc_them.php" class="btn btn-primary">Thêm khóa học</a>

			<?php
				if (isset($_POST['khoa_hoc_delete'])){
					$value = $_POST['khoa_hoc_delete'];
					$sql = "DELETE from khoa_hoc where id_khoa = '$value'";
					mysqli_query($conn, $sql);
					header("location: khoa_hoc_danh_sach.php");
				}

				if (isset($_POST['khoa_hoc_update'])){
					$value = $_POST['khoa_hoc_update'];
					header("location: khoa_hoc_sua.php?id_khoa=$value");
				}
			?>
		</div>
		<br>
		<div style="margin: 20px 13% 0 13%;">
			<table class="table table-striped">
				<form method="post">
					<tr>
						<th>STT</th>
						<th>Tên khóa học</th>
						<th>Id khóa học</th>
						<th>Thao tác</th>
					</tr>
					<tr>
						<?php
							$tdn = $_SESSION['tdn'];
							$sql = "SELECT * from khoa_hoc";
							$kq = mysqli_query($conn, $sql);
							if (false) {
								echo '<td align="center" colspan="7">Không có khóa học nào</td>';
							} else {
								$dem = 1;
								foreach ($kq as $key => $value) {
									echo '<tr>';
									echo "<td>" . $dem . "</td>";
									echo "<td>" . $value['ten_khoa'] . "</td>";
									echo "<td>" . $value['id_khoa'] . "</td>";
									echo "<td><button type = submit name = 'khoa_hoc_update' value = '" . $value['id_khoa'] . "' class='btn btn-primary' style = 'background:green'>Sửa</button>";
									echo " <button type = submit name = 'khoa_hoc_delete' value = '" . $value['id_khoa'] . "' class='btn btn-primary' style = 'background:red'>Xóa</button></td>";
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