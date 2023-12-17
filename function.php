<?php
	include 'connectdb.php';

    // Begin Login function
	function isLogin(){
		if (isset($_SESSION['tdn'])){
			return true;
		} else {
			return false;
		}
	}

    // begin checkLogin
    function checkLogin($username, $password)
	{
		global $conn;
		$sql = "SELECT count(*) from tai_khoan where tai_khoan = '$username'";
		$ketqua = mysqli_query($conn,$sql)->fetch_assoc()['count(*)'];
		if ($ketqua != 0){
			$sql = "SELECT mat_khau from tai_khoan where tai_khoan = '$username'";
			$ketqua = mysqli_query($conn,$sql)->fetch_assoc()['mat_khau'];
			if (md5($password) == $ketqua){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
    // end checkLogin

    // Ve khoa hoc
    function khoa_hoc($id ,$name){
    	echo '
    	<div class="col">
			<div class="card">
				<img src="../images/khoahoc.jpg" class="card-img-top" alt="Course Image">
				<div class="card-body">
				<h5 class="card-title">'.$name.'</h5>
				<a class="btn btn-primary" href = "bien_tap.php?id_khoa_hoc='.$id.'">Truy cập</a>
				</div>
			</div>
		</div>
		';
    }

	//lấy tất cả vai trò
	function vai_tro($ma_vai_tro)
	{
		global $conn;
		if(empty($ma_vai_tro)) {
			$ma_vai_tro = "admin";
		}
		$sql = "SELECT * from vai_tro";
		$res = mysqli_query($conn, $sql);
		echo "<select name='role'>";
		while (($row = mysqli_fetch_assoc($res)) != null) {
			echo "<option value = '{$row['ma_vai_tro']}'";
			if ($ma_vai_tro == $row['ma_vai_tro'])
				echo "selected = 'selected'";
			echo ">{$row['ten_vai_tro']}</option>";
		}
		echo "</select>";
	}

	// //lấy ra câu hỏi theo khóa học
	// function lay_cau_hoi($id_khoa_hoc)
	// {
	// 		echo "<h1> tuan </h1>";
	// 	// global $conn;
	// 	// if(empty($ma_vai_tro)) {
	// 	// 	$ma_vai_tro = "admin";
	// 	// }
	// 	// $sql = "SELECT * from vai_tro";
	// 	// $res = mysqli_query($conn, $sql);
	// 	// echo "<select name='role'>";
	// 	// while (($row = mysqli_fetch_assoc($res)) != null) {
	// 	// 	echo "<option value = '{$row['ma_vai_tro']}'";
	// 	// 	if ($ma_vai_tro == $row['ma_vai_tro'])
	// 	// 		echo "selected = 'selected'";
	// 	// 	echo ">{$row['ten_vai_tro']}</option>";
	// 	// }
	// 	// echo "</select>";
	// }