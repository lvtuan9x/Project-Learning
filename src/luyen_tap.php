<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Luyện tập</title>
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
	
		$thutucauhoi = 0;
		$arrayCauHoi = array();

		$id_khoa_hoc = $_GET['id_khoa_hoc'];
		//get cau hoi random 3
		$sql = "SELECT * FROM ( SELECT * FROM cau_hoi WHERE id_khoa = $id_khoa_hoc ORDER BY RAND() LIMIT 3 ) as ch INNER JOIN options op ON ch.id_ch = op.idQuestion;";
		$kq = mysqli_query($conn, $sql); 
		$dem = 0;
		while($item = $kq -> fetch_assoc()){
			$arrayCauHoi[$dem]["id"] = $item["id"]; //id option
			$arrayCauHoi[$dem]["id_ch"] = $item["id_ch"];
			$arrayCauHoi[$dem]["ten_ch"] = $item["ten_ch"];
			$arrayCauHoi[$dem++]["name"] = $item["name"];
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
			<!--quiz start-->
			<div id="quiz" class="panel" style="margin:5%">
				<?php
				 	if(sizeof($GLOBALS['arrayCauHoi']) < 3) {
						echo "<h2>Phải có trên 3 câu hỏi mới luyện tập được</h2>";
						return;
					}
					echo "<form method='get' action='luyen_tap_ketqua.php' class='form-horizontal'>";
					lay_cau_hoi();
					lay_cau_hoi();
					lay_cau_hoi();
					echo "	<button type='submit' name='id_khoa_hoc' value='".$_GET['id_khoa_hoc']."' class='btn btn-primary' style='border-radius:0%'>Submit</button>";
					echo "</form>";
				?>
			</div> <!--quiz end-->
		</div>
		</div>
		</div>
		</div>

		<?php
			function lay_cau_hoi() {
				global $arrayCauHoi;
				global $thutucauhoi;

				//vao cuoi cung cau hoi sau do chuyen sang trang ket qua diem
				if ($thutucauhoi + 1 == sizeof($arrayCauHoi)) {
					return;
				}

				$cauhoi = $arrayCauHoi[$thutucauhoi];

				$tencauhoi = $cauhoi['ten_ch'];
				$cauHoiSo = $thutucauhoi / 4 + 1;
				
				echo "<b>Câu hỏi số $cauHoiSo :<br>$tencauhoi<br><br>";
				echo "	<br/>";
				for($i = $thutucauhoi; $i < $thutucauhoi + 4; $i++) {
					$cauhoi = $arrayCauHoi[$i];
					$idoption = $cauhoi['id'];//idoption
					$tenoption = $cauhoi['name'];

					echo "	<input type='radio' name='idOptionQuestion$cauHoiSo' value='$idoption'><b> $tenoption </b>";
					echo "	<br><br>";
				}
				$GLOBALS['thutucauhoi'] += 4;
			}
		?>
		</div>
	</main>
</body>

</html>