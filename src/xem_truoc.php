
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xem trước</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->

</head>
<body>
<?php include 'navbar.php'; include'../function.php'?>
	<main style="min-height: 100vh; max-width: 100%;">
					<!-- <hr> -->
			<?php
				$id = $_GET['id_khoa_hoc'];
				$idch = $_GET['id_cau_hoi'];
			?>
			<div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Khóa học <?php
            	$sql = "SELECT * from khoa_hoc where id_khoa = $id";
            	$kq = mysqli_query($conn,$sql)->fetch_assoc();
            	echo $kq['ten_khoa'];
        	?></p>
			<a href="<?php echo 'bien_tap.php?id_khoa_hoc='.$id ?>" class="btn btn-primary">Trở lại</a>
            <form action="" method="POST" enctype="multipart/form-data">
			</div>
            <div   style="margin: 20px 30%;">
               	<?php
               		$sql = "SELECT * FROM options op left join cau_hoi ch on ch.id_ch = op.idQuestion LEFT join dap_an da on op.id = da.idOption WHERE id_ch = $idch";
               		$kq = mysqli_query($conn ,$sql);
					$row = $kq->fetch_assoc();
               	?>

                <!-- tên câu hỏi -->
                <div class="form-group">
                    <label for="name_quiz"><h4>Câu hỏi: <?php echo $row['ten_ch']?></h4></label>
                </div>

                <!-- ảnh câu hỏi -->
                <div class="form-group">
                    	<?php if($row['anh_ch'] != ""){
                    		$link = "../images/".$row['anh_ch'];
                    		echo "<img src='".$link."'>";
                    	}
                    ?>
                </div>
               
                <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
					<div class="form-group">
						<?php
							foreach ($kq as $key => $value) {
								//render đáp án để check xem có duyệt không hoạc xem đáp án

								//dòng nào có giá trị idOption là đáp án nên sẽ tích radio
								$checked = is_null($value["idOption"]) ? "" : "checked";
								echo "	<input type='radio' name='' value='' ".$checked."><b> " .$value["name"]. "</b>	<br><br>";
							}
						?>
					</div>
                </div>
               
            </div>
            </form>
		
	</main>

    <?php include 'footer.php'; ?>

</body>

	
</html>