<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Used Car Dealership</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Search Results</h1>

    <?php
    require_once("settings.php");

    // 1. Kết nối tới MySQL database
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure: " . htmlspecialchars(mysqli_connect_error()) . "</p>";
    } else {
        // 2. Kiểm tra xem tham số 'model' có được gửi qua GET và không rỗng
        if (isset($_GET['model']) && trim($_GET['model']) !== '') {
            // Làm sạch chuỗi đầu vào để chống SQL Injection
            $model = mysqli_real_escape_string($conn, trim($_GET['model']));

            // Câu truy vấn tìm kiếm gần đúng theo model
            $sql = "SELECT car_id, make, model, price, yom FROM cars WHERE model LIKE '%$model%'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Make</th>";
                echo "<th>Model</th>";
                echo "<th>Price ($)</th>";
                echo "<th>Year</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

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
                mysqli_free_result($result);
            } else {
                echo "<p>🚫 No matching cars found.</p>";
            }
        } else {
            echo "<p>Please enter a model to search.</p>";
        }

        // 3. Đóng kết nối database
        mysqli_close($conn);
    }
    ?>

    <p><a href="search_form.php">Back to Search</a> | <a href="cars.php">View All Cars</a></p>
</body>
</html>