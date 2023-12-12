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

  