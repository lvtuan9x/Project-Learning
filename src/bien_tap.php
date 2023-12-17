<?php
// include '../function.php';  
?>
<?php
if (isset($_POST['dx'])) {
    unset($_SESSION['tdn']);
    header("location:dang_nhap.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên tập</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- End bootstrap cdn -->
    <style>
        img {
            max-width: 400px;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <form method="post">
        <?php
        include 'navbar.php';
        include '../function.php';
        ?>
    </form>
    <main style="min-height: 100vh; max-width: 100%;">

        <div id="action" style="margin: 20px 0 0 13%;">
            <p class="h3">Khóa học
                <?php
                $id = $_GET['id_khoa_hoc'];
                $sql = "SELECT * from khoa_hoc where id_khoa = $id";
                echo mysqli_query($conn, $sql)->fetch_assoc()['ten_khoa'];
                if (isset($_POST['duyet'])) {
                    $value = $_POST['duyet'];
                    $sql = "UPDATE cau_hoi SET trang_thai = 'Đã duyệt' WHERE id_ch = $value";
                    mysqli_query($conn, $sql);
                    header("location: bien_tap.php?id_khoa_hoc=$id");
                }
                if (isset($_POST['xt'])){
                    $cauhoi = $_POST['xt'];
                    header("location: xem_truoc.php?id_khoa_hoc=$id&id_cau_hoi=$cauhoi");
                }
                if (isset($_POST['xoa'])){
                    $value = $_POST['xoa'];
                    $sql = "DELETE from cau_hoi where id_ch = $value";
                    mysqli_query($conn,$sql);
                    header("location: bien_tap.php?id_khoa_hoc=$id");
                }
                ?>
                <!--Tên khóa học  -->
            </p>
            <a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a>

            <a href="them_cau_hoi.php?id_khoa_hoc=<?php echo $_GET['id_khoa_hoc']; ?>" class="btn btn-primary">Thêm câu hỏi</a>

            <a href="luyen_tap.php?id_khoa_hoc=<?php echo $_GET['id_khoa_hoc']; ?>" class="btn btn-primary">Luyện tập</a>

            <a href="history.php?id_khoa_hoc=<?php echo $_GET['id_khoa_hoc']; ?>" class="btn btn-primary">Lich sử câu sai</a>
            
        </div>
        <div class="d-flex flex-wrap flex-column align-items-center" style="padding: 1%;margin: 5% 0 0 0; ">
            <p class="h3">Danh sách câu hỏi</p>
            <table class="table table-striped">
                <form method="post">
                    <tr>
                        <th>STT</th>
                        <th>Tên câu hỏi</th>
                        <th>Tác giả</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    <tr>
                        <?php
                        $id = $_GET['id_khoa_hoc'];
                        $tdn = $_SESSION['tdn'];
                        $sql = "SELECT COUNT(*) from cau_hoi where id_khoa = '$id' AND nguoi_them = '$tdn' ";
                        $kq = mysqli_query($conn, $sql)->fetch_assoc()['COUNT(*)'];

                        $sql1 = "SELECT vai_tro from tai_khoan where tai_khoan = '$tdn' ";
                        $role = mysqli_query($conn, $sql1)->fetch_assoc()['vai_tro'];

                        if ($role == 'admin') {
                            $sql = "SELECT * FROM cau_hoi WHERE id_khoa = '$id'";
                            $kq = 1;
                        }
                        if ($kq == 0) {
                            echo '<td align="center" colspan="7">Không có câu hỏi nào</td>';
                        } else {
                            $dem = 1;
                            $sql = "SELECT * FROM cau_hoi WHERE id_khoa = '$id' AND nguoi_them = '$tdn'";
                            if ($role == 'admin') {
                                $sql = "SELECT * FROM cau_hoi WHERE id_khoa = '$id'";
                            }
                            $kq = mysqli_query($conn, $sql);
                            foreach ($kq as $key => $value) {
                                echo '<tr>';
                                echo "<td>" . $dem . "</td>";
                                echo "<td>" . $value['ten_ch'] . "</td>";
                                echo "<td>" . $value['nguoi_them'] . "</td>";
                                echo "<td>" . $value['trang_thai'] . "</td>";
                                if ($role != "admin") {
                                    echo "<td>";
                                    echo "<button type = submit name = xt value = '".$value['id_ch']."' class='btn btn-primary'>Xem trước</button>";
                                    echo "</td>";
                                } else {
                                    echo "<td>";
                                    // echo "<input type = submit name = xt value = '".$value['id_ch']."'class='btn btn-primary'>";
                                    echo "<button type = submit name = xt value = '".$value['id_ch']."'class='btn btn-primary'>Xem trước </button>";
                                    if ($value['trang_thai'] == 'Chưa Duyệt'){
                                        echo "<button type = submit name = 'duyet' value = '" . $value['id_ch'] . "' class='btn btn-primary' style = 'background:green'>Duyệt</button>";
                                    }
                                    echo "<button type = submit name = 'xoa' value = '" . $value['id_ch'] . "' class='btn btn-primary' style = 'background:red'>Xóa</button>";
                                    echo "</td>";
                                }
                                echo '</tr>';
                                $dem++;
                                $idch = $value['id_ch'];
                            }
                        }

                       
                        ?>
                    </tr>
                </form>
            </table>
        </div>
    </main>
    <?php
    // include 'footer.php'; 
    ?>
</body>


</html>