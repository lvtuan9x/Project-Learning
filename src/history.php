<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lịch sử câu sai</title>
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
			<p class="h3">Khóa học
				<?php
				$id_khoa_hoc = $_GET['id_khoa_hoc'];
				$sql = "SELECT * from khoa_hoc where id_khoa = $id_khoa_hoc";
				$tdn = $_SESSION['tdn'];
				echo mysqli_query($conn, $sql)->fetch_assoc()['ten_khoa'];
				?>
				<!--Tên khóa học  -->
			</p>
			<!-- <a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a> -->
			<a href="bien_tap.php?id_khoa_hoc=<?php echo $id_khoa_hoc; ?>" class="btn btn-primary">Trở lại</a>
		</div>
		<br>

		<div style="margin: 20px 13% 0 13%;">
			<table class="table table-striped">
				<form method="post">
					<tr>
						<th>STT</th>
						<th>Tên khóa học</th>
						<th>Tên câu hỏi</th>
						<th>Số lần sai</th>
					</tr>
					<tr>
						<?php
							$tdn = $_SESSION['tdn'];
							$sql = "SELECT COUNT(*) as soluong, ten_khoa_hoc, ten_cau_hoi FROM `history` WHERE id_khoa_hoc = '$id_khoa_hoc' GROUP BY id_khoa_hoc, id_cau_hoi;";
							$kq = mysqli_query($conn, $sql);

							if (mysqli_num_rows($kq) == 0) {
								echo '<td align="center" colspan="7">Không có lịch sử câu sai nào</td>';
							} else {
								$dem = 1;
								foreach ($kq as $key => $value) {
									echo '<tr>';
									echo "<td>" . $dem . "</td>";
									echo "<td>" . $value['ten_khoa_hoc'] . "</td>";
									echo "<td>" . $value['ten_cau_hoi'] . "</td>";
									echo "<td>" . $value['soluong'] . "</td>";
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