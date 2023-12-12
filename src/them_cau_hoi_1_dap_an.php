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
	<?php include'../function.php' ;include'navbar.php';
		if(isset($_POST['dx'])){
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
                    $sql = "SELECT * from khoa where id_khoa = $id";
                    $tdn = $_SESSION['tdn'];
                    echo mysqli_query($conn,$sql)->fetch_assoc()['ten_khoa'];
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
				<input type="text" class="form-control" name="tch" placeholder="Nhập tên câu hỏi">
				<br>
				<label>Ảnh câu hỏi <span style="color: red;">(nếu có)</span></label>
				<input class="form-control " type="file" name="anh">
				<br>

                <label>Nhập số câu trả lời</label>
				<input type="text" class="form-control" name="da" placeholder="Nhập số câu trả lời">
				<br>
				<label>Đáp án câu hỏi</label>
				<input type="text" class="form-control" name="da" placeholder="Đáp án câu hỏi">
				<br><br>
				<input type="submit" class="btn btn-primary mb-3" style="width:100%;" value="Thêm câu hỏi" name="submit">
			</form>
			
			<?php 
				if (isset($_POST['submit'])){
					$ten_cau_hoi = trim($_POST['tch']);
					$dap_an = trim($_POST['da']);
					if (empty($ten_cau_hoi) || empty($dap_an)){
						if (empty($ten_cau_hoi)) {
                            echo "<div class='alert alert-warning text-center' role='alert'>Vui lòng nhập câu hỏi</div>";
                        } 
						else if (empty($dap_an)) {
                            echo "<div class='alert alert-warning text-center' role='alert'>Vui lòng nhập đáp án</div>";
						}
						// echo "Vui lòng nhập vào đầy đủ tên và đáp án câu hỏi";
					} else {
						$tch = $_POST['tch'];
						$da = $_POST['da'];
						$filename = "";
						$check = true;
						$files = $_FILES['anh'];
						if (move_uploaded_file($files['tmp_name'], "../images/".$files['name'])){
							$info = getimagesize("../images/".$files['name']);
							if ($info){
								$filename = $files['name'];
							} else {
								$check = false;
								echo "Không được chọn file không phải là ảnh ! <br>";
							}
						}
						$sql = "INSERT INTO cau_hoi(ten_ch,anh_ch,dapan_ch,id_khoa,nguoi_them,trang_thai) VALUES('$tch','$filename','$da','$id','$tdn','Chưa Duyệt')";
						if (mysqli_query($conn,$sql) && $check == true){
							echo "<div class='alert alert-warning text-center' role='alert'>Đã thêm câu hỏi thành công !</div>";
						} else {
							echo "<div class='alert alert-warning text-center' role='alert'>Chưa thêm được câu hỏi !</div>";
						}
					}
				} 
			?>
        </div>
    </main>
</body>
</html>