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

	<script src="../js/jquery.js" type="text/javascript"></script>
</head>

<body>
	<!-- <form method="post"> -->
	<?php
		include '../function.php';
		include 'navbar.php';
		if (isset($_POST['dx'])) {
			unset($_SESSION['tdn']);
			header("location:dang_nhap.php");
		}


		//param là mã option mà người dùng chọn sau đó truy vấn lại tìm mã câu hỏi
		//mỗi câu trả lời đúng được 10 điểm

		$point = 0;
		$tong_cau_tra_loi_dung = 0;
		//tinh ket qua
		//neu 10 cau hoi thi for 10 lan
		for($i = 1; $i < 4; $i++) {
			if (isset($_GET["idOptionQuestion".$i])) {
				$idOption = $_GET["idOptionQuestion".$i];

				//tìm id option trong bảng đáp án nếu có thì trả lời đúng còn không thì sai
				$sql = "SELECT * from dap_an where idOption = '$idOption'";
				$ketqua = mysqli_query($conn, $sql);

				//mysqli_num_rows nếu có 1 đòng thì trả lời đúng
				if(mysqli_num_rows($ketqua) != 0) {
					//trả lời đúng tăng 10 điểm
					$tong_cau_tra_loi_dung++;
				} else {

					//lưu lại những câu trả lời sai nếu còn thời gian làm
					
					//lấy ra id câu hỏi và id khóa học để lưu vào câu trả lời sai
					$sql = "SELECT * FROM khoa_hoc kh INNER join cau_hoi ch on kh.id_khoa = ch.id_khoa INNER JOIN options op on op.idQuestion = ch.id_ch WHERE op.id = '$idOption'";
					$ketqua = mysqli_query($conn, $sql)->fetch_assoc();

					$id_khoa_hoc = $ketqua["id_khoa"];
					$ten_khoa_hoc = $ketqua["ten_khoa"];
					$id_ch = $ketqua["id_ch"];
					$ten_ch = $ketqua["ten_ch"];

					$sql = "INSERT INTO history (id_khoa_hoc, ten_khoa_hoc, id_cau_hoi, ten_cau_hoi) VALUES('$id_khoa_hoc', '$ten_khoa_hoc', '$id_ch', '$ten_ch')";
					mysqli_query($conn, $sql);
				}
				
			}
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
			<div class="panel">
				<center>
				<h1 class="title" style="color:#660033">Kết quả</h1>
				<center><br />
				<table class="table table-striped title1" style="font-size:20px;font-weight:1000;">
					<tr style="color:#66CCFF">
						<td>Tổng câu hỏi</td>
						<td>3</td>
					</tr>
					<tr style="color:#99cc32">
						<td>Câu trả lời đúng&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
						<td><?php echo $tong_cau_tra_loi_dung; ?></td>
					</tr>
					<tr style="color:red">
						<td>Câu trả lời sai&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td>
						<td><?php echo 3 - $tong_cau_tra_loi_dung; ?></td>
					</tr>
					<tr style="color:#66CCFF">
						<td>Điểm&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
						<td><?php echo $tong_cau_tra_loi_dung * 10; ?></td>
					</tr>
					</table>
			</div>
		</div>
	</main>
</body>

</html>