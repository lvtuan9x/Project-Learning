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
				$id = $_GET['id_khoa_hoc'];
				$sql = "SELECT * from khoa_hoc where id_khoa = $id";
				$tdn = $_SESSION['tdn'];
				echo mysqli_query($conn, $sql)->fetch_assoc()['ten_khoa'];
				?>
				<!--Tên khóa học  -->
			</p>
			<!-- <a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a> -->
			<a href="bien_tap.php?id_khoa_hoc=<?php echo $id; ?>" class="btn btn-primary">Trở lại</a>
		</div>
		<br>
		<div style="margin: 20px 13% 0 13%;">
			<form method="post" enctype="multipart/form-data">
				<label>Tên câu hỏi <span style="color: red;">*</span></label>
				<input type="text" class="form-control" name="tch" placeholder="Nhập tên câu hỏi" required>
				<br>
				<label>Ảnh câu hỏi <span style="color: red;">(nếu có)</span></label>
				<input class="form-control " type="file" name="anh">
				<br>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-12 control-label" for="11"></label>
					<div class="col-md-12">
						<input id="11" name="ansA" placeholder="Nhập đáp án A" required class="form-control input-md" type="text">

					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-12 control-label" for="12"></label>
					<div class="col-md-12">
						<input id="12" name="ansB" placeholder="Nhập đáp án B" required class="form-control input-md" type="text">

					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-12 control-label" for="13"></label>
					<div class="col-md-12">
						<input id="13" name="ansC" placeholder="Nhập đáp án C" required class="form-control input-md" type="text">

					</div>
				</div>
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-12 control-label" for="14"></label>
					<div class="col-md-12">
						<input id="14" name="ansD" placeholder="Nhập đáp án D" required class="form-control input-md" type="text">

					</div>
				</div>
				<br />
				<b>Chọn đáp án</b>:<br />
				<select id="cautraloi" name="cautraloi" placeholder="Choose correct answer " class="form-control input-md">
					<!-- <option value="a">Chọn đáp án cho câu hỏi 1</option> -->
					<option value="ansA">Đáp án A</option>
					<option value="ansB">Đáp án B</option>
					<option value="ansC">Đáp án C</option>
					<option value="ansD">Đáp án D</option>
				</select><br /><br />

				<input type="submit" class="btn btn-primary mb-3" style="width:100%;" value="Thêm câu hỏi" name="submit">
			</form>

			<?php
			if (isset($_POST['submit'])) {
				$ten_cau_hoi = trim($_POST['tch']);
				
				$ansA = trim($_POST['ansA']);
				$ansB = trim($_POST['ansB']);
				$ansC = trim($_POST['ansC']);
				$ansD = trim($_POST['ansD']);

				$cautraloi = trim($_POST['cautraloi']);

				$tch = $_POST['tch'];

				$filename = "";
				$check = true;
				$files = $_FILES['anh'];
				if (move_uploaded_file($files['tmp_name'], "../images/" . $files['name'])) {
					$info = getimagesize("../images/" . $files['name']);
					if ($info) {
						$filename = $files['name'];
					} else {
						$check = false;
						echo "Không được chọn file không phải là ảnh ! <br>";
					}
				}
				if ($_SESSION['tdn'] == "admin") {
					$sql = "INSERT INTO cau_hoi (ten_ch,anh_ch,id_khoa,nguoi_them,trang_thai) VALUES('$tch','$filename','$id','$tdn','Đã Duyệt')";
				} else {
					$sql = "INSERT INTO cau_hoi (ten_ch,anh_ch,id_khoa,nguoi_them,trang_thai) VALUES('$tch','$filename','$id','$tdn','Chưa Duyệt')";
				}
				$kq = mysqli_query($conn, $sql);

				//get id question when save
				$idQuestion = mysqli_insert_id($conn);

				$array = ["ansA" => $ansA, "ansB" => $ansB, "ansC" => $ansC, "ansD" => $ansD];
				$ansEnd = "";

				foreach ($array as $key => $value) {
					if ($key != $cautraloi) {
						//insert options
						$sql = "INSERT INTO options (idQuestion, name) VALUES('$idQuestion', '$value')";
						mysqli_query($conn, $sql);
					} else {
						$ansEnd = $value;
					}
				}

				//insert options
				$sql = "INSERT INTO options (idQuestion, name) VALUES('$idQuestion', '$ansEnd')";
				mysqli_query($conn, $sql);
				//get id option end when save
				$idOption = mysqli_insert_id($conn);

				//insert dap an
				$sql = "INSERT INTO dap_an (idQuestion, idOption) VALUES('$idQuestion','$idOption')";
				mysqli_query($conn, $sql);

				// if ($kq && $check == true) {
				// 	echo "<div class='alert alert-warning text-center' role='alert'>Đã thêm câu hỏi thành công !</div>";
				// } else {
				// 	echo "<div class='alert alert-warning text-center' role='alert'>Chưa thêm được câu hỏi !</div>";
				// }
			}
			?>
		</div>
	</main>
</body>

</html>