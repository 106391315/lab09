<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Car Dealership - Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Used Car Dealership - Available Cars</h1>

    <?php
    require_once("settings.php");

    // 1. Kết nối tới MySQL database
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure: " . htmlspecialchars(mysqli_connect_error()) . "</p>";
    } else {
        // 2. Thực thi câu lệnh SELECT lấy toàn bộ xe
        $query = "SELECT car_id, make, model, price, yom FROM cars";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Something is wrong with the query: " . htmlspecialchars($query) . "</p>";
        } else {
            // 3. Kiểm tra xem bảng có dữ liệu hay không
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Car ID</th>";
                echo "<th>Make</th>";
                echo "<th>Model</th>";
                echo "<th>Price ($)</th>";
                echo "<th>Year of Manufacture</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // 4. Lặp qua từng bản ghi và in ra các dòng trong bảng HTML
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                // 5. Trường hợp bảng rỗng không có bản ghi nào
                echo "<p>There are no cars to display.</p>";
            }

            // Giải phóng bộ nhớ lưu kết quả truy vấn
            mysqli_free_result($result);
        }

        // Đóng kết nối MySQL
        mysqli_close($conn);
    }
    ?>
</body>
</html>