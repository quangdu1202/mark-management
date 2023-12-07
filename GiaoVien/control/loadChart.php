<?php
//    echo '<script>alert("'.$loaidiem.'")</script>';
global $conn, $BangDiem;
$arrayMaDiem = [];
$query_listMaDiem = "select * from diem, hocsinh, monhoc WHERE diem.MaHS=hocsinh.MaHS && diem.MaMonHoc=monhoc.MaMonHoc";
$results_listMaDiem = mysqli_query($conn, $query_listMaDiem);
for ($i = 0; $i < ($row = mysqli_fetch_assoc($results_listMaDiem)); $i++) {
    if ($row['MaLopHoc'] == $BangDiem['MaLopHoc'] && $row['MaMonHoc'] == $BangDiem['MaMonHoc'] && $row['MaHocKy'] == $BangDiem['MaHocKy']) {
        $arrayMaDiem[] = $row['MaDiem'];
    }
}
//    var_dump($arrayMaDiem);
if(sizeof($arrayMaDiem) > 0) {
    $separator = ',';
    $listMaDiem = implode($separator, $arrayMaDiem);
//    echo '<script>alert("'.$listMaDiem.'")</script>';
//    echo $listMaDiem;
    $query_check1 = "SELECT
                    CASE
                        WHEN DiemMieng >= 0 AND DiemMieng <= 4 THEN 'Từ 0-4'
                        WHEN DiemMieng > 4 AND DiemMieng <= 6 THEN 'Từ >4-6'
                        WHEN DiemMieng > 6 AND DiemMieng <= 8 THEN 'Từ >6-8'
                        WHEN DiemMieng > 8 AND DiemMieng <= 10 THEN 'Từ >8-10'
                    END AS LoaiDiem,
                    COUNT(*) AS SoLuong
                    FROM Diem
                    WHERE
                    MaDiem IN " . "(" . $listMaDiem . ")
                    GROUP BY
                    CASE
                        WHEN DiemMieng >= 0 AND DiemMieng <= 4 THEN 'Từ 0-4'
                        WHEN DiemMieng > 4 AND DiemMieng <= 6 THEN 'Từ >4-6'
                        WHEN DiemMieng > 6 AND DiemMieng <= 8 THEN 'Từ >6-8'
                        WHEN DiemMieng > 8 AND DiemMieng <= 10 THEN 'Từ >8-10'
                    END
                    order by LoaiDiem";

    $query_check2 = "SELECT
                        CASE
                            WHEN Diem15Phut1 >= 0 AND Diem15Phut1 <= 4 THEN 'Từ 0-4'
                            WHEN Diem15Phut1 > 4 AND Diem15Phut1 <= 6 THEN 'Từ >4-6'
                            WHEN Diem15Phut1 > 6 AND Diem15Phut1 <= 8 THEN 'Từ >6-8'
                            WHEN Diem15Phut1 > 8 AND Diem15Phut1 <= 10 THEN 'Từ >8-10'
                        END AS LoaiDiem,
                        COUNT(*) AS SoLuong
                        FROM Diem
                        WHERE
                        MaDiem IN " . "(" . $listMaDiem . ")
                        GROUP BY
                        CASE
                            WHEN Diem15Phut1 >= 0 AND Diem15Phut1 <= 4 THEN 'Từ 0-4'
                            WHEN Diem15Phut1 > 4 AND Diem15Phut1 <= 6 THEN 'Từ >4-6'
                            WHEN Diem15Phut1 > 6 AND Diem15Phut1 <= 8 THEN 'Từ >6-8'
                            WHEN Diem15Phut1 > 8 AND Diem15Phut1 <= 10 THEN 'Từ >8-10'
                        END
                        order by LoaiDiem";

    $query_check3 = "SELECT
                        CASE
                            WHEN Diem15Phut2 >= 0 AND Diem15Phut2 <= 4 THEN 'Từ 0-4'
                            WHEN Diem15Phut2 > 4 AND Diem15Phut2 <= 6 THEN 'Từ >4-6'
                            WHEN Diem15Phut2 > 6 AND Diem15Phut2 <= 8 THEN 'Từ >6-8'
                            WHEN Diem15Phut2 > 8 AND Diem15Phut2 <= 10 THEN 'Từ >8-10'
                        END AS LoaiDiem,
                        COUNT(*) AS SoLuong
                        FROM Diem
                        WHERE
                        MaDiem IN " . "(" . $listMaDiem . ")
                        GROUP BY
                        CASE
                            WHEN Diem15Phut2 >= 0 AND Diem15Phut2 <= 4 THEN 'Từ 0-4'
                            WHEN Diem15Phut2 > 4 AND Diem15Phut2 <= 6 THEN 'Từ >4-6'
                            WHEN Diem15Phut2 > 6 AND Diem15Phut2 <= 8 THEN 'Từ >6-8'
                            WHEN Diem15Phut2 > 8 AND Diem15Phut2 <= 10 THEN 'Từ >8-10'
                        END
                        order by LoaiDiem";

    $query_check4 = "SELECT
                        CASE
                            WHEN Diem1Tiet >= 0 AND Diem1Tiet <= 4 THEN 'Từ 0-4'
                            WHEN Diem1Tiet > 4 AND Diem1Tiet <= 6 THEN 'Từ >4-6'
                            WHEN Diem1Tiet > 6 AND Diem1Tiet <= 8 THEN 'Từ >6-8'
                            WHEN Diem1Tiet > 8 AND Diem1Tiet <= 10 THEN 'Từ >8-10'
                        END AS LoaiDiem,
                        COUNT(*) AS SoLuong
                        FROM Diem
                        WHERE
                        MaDiem IN " . "(" . $listMaDiem . ")
                        GROUP BY
                        CASE
                            WHEN Diem1Tiet >= 0 AND Diem1Tiet <= 4 THEN 'Từ 0-4'
                            WHEN Diem1Tiet > 4 AND Diem1Tiet <= 6 THEN 'Từ >4-6'
                            WHEN Diem1Tiet > 6 AND Diem1Tiet <= 8 THEN 'Từ >6-8'
                            WHEN Diem1Tiet > 8 AND Diem1Tiet <= 10 THEN 'Từ >8-10'
                        END
                        order by LoaiDiem";

    $query_check5 = "SELECT
                        CASE
                            WHEN DiemGiuaKi >= 0 AND DiemGiuaKi <= 4 THEN 'Từ 0-4'
                            WHEN DiemGiuaKi > 4 AND DiemGiuaKi <= 6 THEN 'Từ >4-6'
                            WHEN DiemGiuaKi > 6 AND DiemGiuaKi <= 8 THEN 'Từ >6-8'
                            WHEN DiemGiuaKi > 8 AND DiemGiuaKi <= 10 THEN 'Từ >8-10'
                        END AS LoaiDiem,
                        COUNT(*) AS SoLuong
                        FROM Diem
                        WHERE
                        MaDiem IN " . "(" . $listMaDiem . ")
                        GROUP BY
                        CASE
                            WHEN DiemGiuaKi >= 0 AND DiemGiuaKi <= 4 THEN 'Từ 0-4'
                            WHEN DiemGiuaKi > 4 AND DiemGiuaKi <= 6 THEN 'Từ >4-6'
                            WHEN DiemGiuaKi > 6 AND DiemGiuaKi <= 8 THEN 'Từ >6-8'
                            WHEN DiemGiuaKi > 8 AND DiemGiuaKi <= 10 THEN 'Từ >8-10'
                        END
                        order by LoaiDiem";

    $query_check6 = "SELECT
                        CASE
                            WHEN DiemThi >= 0 AND DiemThi <= 4 THEN 'Từ 0-4'
                            WHEN DiemThi > 4 AND DiemThi <= 6 THEN 'Từ >4-6'
                            WHEN DiemThi > 6 AND DiemThi <= 8 THEN 'Từ >6-8'
                            WHEN DiemThi > 8 AND DiemThi <= 10 THEN 'Từ >8-10'
                        END AS LoaiDiem,
                        COUNT(*) AS SoLuong
                        FROM Diem
                        WHERE
                        MaDiem IN " . "(" . $listMaDiem . ")
                        GROUP BY
                        CASE
                            WHEN DiemThi >= 0 AND DiemThi <= 4 THEN 'Từ 0-4'
                            WHEN DiemThi > 4 AND DiemThi <= 6 THEN 'Từ >4-6'
                            WHEN DiemThi > 6 AND DiemThi <= 8 THEN 'Từ >6-8'
                            WHEN DiemThi > 8 AND DiemThi <= 10 THEN 'Từ >8-10'
                        END
                        order by LoaiDiem";

    $query_check7 = "SELECT
                        CASE
                            WHEN DiemTB >= 0 AND DiemTB <= 4 THEN 'Yếu'
                            WHEN DiemTB > 4 AND DiemTB <= 6 THEN 'Trung Bình'
                            WHEN DiemTB > 6 AND DiemTB <= 8 THEN 'Khá'
                            WHEN DiemTB > 8 AND DiemTB <= 10 THEN 'Giỏi'
                        END AS LoaiDiem,
                        COUNT(*) AS SoLuong
                        FROM Diem
                        WHERE
                        MaDiem IN " . "(" . $listMaDiem . ")
                        GROUP BY
                        CASE
                            WHEN DiemTB >= 0 AND DiemTB <= 4 THEN 'Yếu'
                            WHEN DiemTB > 4 AND DiemTB <= 6 THEN 'Trung Bình'
                            WHEN DiemTB > 6 AND DiemTB <= 8 THEN 'Khá'
                            WHEN DiemTB > 8 AND DiemTB <= 10 THEN 'Giỏi'
                        END
                        order by LoaiDiem";
//    echo $query_check;
    $result_check1 = mysqli_query($conn, $query_check1);
    $result_check2 = mysqli_query($conn, $query_check2);
    $result_check3 = mysqli_query($conn, $query_check3);
    $result_check4 = mysqli_query($conn, $query_check4);
    $result_check5 = mysqli_query($conn, $query_check5);
    $result_check6 = mysqli_query($conn, $query_check6);
    $result_check7 = mysqli_query($conn, $query_check7);
    $dataDiem1 = [];
    $dataDiem2 = [];
    $dataDiem3 = [];
    $dataDiem4 = [];
    $dataDiem5 = [];
    $dataDiem6 = [];
    $dataDiem7 = [];
    while ($row2 = mysqli_fetch_assoc($result_check1)) {
        $dataDiem1[] = $row2;
    }
    while ($row2 = mysqli_fetch_assoc($result_check2)) {
        $dataDiem2[] = $row2;
    }
    while ($row2 = mysqli_fetch_assoc($result_check3)) {
        $dataDiem3[] = $row2;
    }
    while ($row2 = mysqli_fetch_assoc($result_check4)) {
        $dataDiem4[] = $row2;
    }
    while ($row2 = mysqli_fetch_assoc($result_check5)) {
        $dataDiem5[] = $row2;
    }
    while ($row2 = mysqli_fetch_assoc($result_check6)) {
        $dataDiem6[] = $row2;
    }
    while ($row2 = mysqli_fetch_assoc($result_check7)) {
        $dataDiem7[] = $row2;
    }
}else {
    exit();
}
//    var_dump($dataDiem1);
//    var_dump($dataDiem2);
//    var_dump($dataDiem3);
//    var_dump($dataDiem4);
//    var_dump($dataDiem5);
//    var_dump($dataDiem6);
//    var_dump($dataDiem7);
?>

<script type="text/javascript">
    function changeChart() {
        var divs = document.getElementsByClassName('mark-chart');
        for (var i = 0; i < divs.length; i++) {
            divs[i].style.display = "none";
        }
        var LoaiDiems = document.getElementById("listDiem");
        var selectedValue = LoaiDiems.value;
        //Thống kê điểm

        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data1 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem1 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var data2 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem2 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var data3 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem3 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var data4 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem4 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var data5 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem5 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var data6 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem6 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var data7 = google.visualization.arrayToDataTable([
                ['Loại điểm', 'Số lượng'],
                <?php
                foreach ($dataDiem7 as $key) {
                    echo "['" . $key['LoaiDiem'] . "', " . (int)($key['SoLuong']) . "],";
                }
                ?>
            ]);

            var options1 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm miệng'
                // chartArea: {
                //     left: "3%",
                //     top: "3%",
                //     height: "94%",
                //     width: "94%"
                // }
            };

            var options2 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm 15 phút lần 1'
            };

            var options3 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm 15 phút lần 2'
            };

            var options4 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm 1 tiết'
            };

            var options5 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm giữa kì'
            };

            var options6 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm thi'
            };

            var options7 = {
                width: 900,
                height: 600,
                title: 'Thống kê theo Điểm trung bình'
            };

            var chart1 = new google.visualization.PieChart(document.getElementById('DiemMieng'));
            var chart2 = new google.visualization.PieChart(document.getElementById('Diem15Phut1'));
            var chart3 = new google.visualization.PieChart(document.getElementById('Diem15Phut2'));
            var chart4 = new google.visualization.PieChart(document.getElementById('Diem1Tiet'));
            var chart5 = new google.visualization.PieChart(document.getElementById('DiemGiuaKi'));
            var chart6 = new google.visualization.PieChart(document.getElementById('DiemThi'));
            var chart7 = new google.visualization.PieChart(document.getElementById('DiemTB'));

            if (selectedValue === 'DiemMieng') {
                chart1.draw(data1, options1);
            } else if (selectedValue === 'Diem15Phut1') {
                chart2.draw(data2, options2);
            } else if (selectedValue === 'Diem15Phut2') {
                chart3.draw(data3, options3);
            } else if (selectedValue === 'Diem1Tiet') {
                chart4.draw(data4, options4);
            } else if (selectedValue === 'DiemGiuaKi') {
                chart5.draw(data5, options5);
            } else if (selectedValue === 'DiemThi') {
                chart6.draw(data6, options6);
            } else if (selectedValue === 'DiemTB') {
                chart7.draw(data7, options7);
            }
        }

        document.getElementById(selectedValue).style.display = "block";
    }
</script>