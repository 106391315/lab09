<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Cars - Used Car Dealership</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Search Car by Model</h1>

    <form action="search_result.php" method="GET">
        <p>
            <label for="model">Car Model:</label>
            <input type="text" id="model" name="model" placeholder="e.g. Corolla, Astra, X3" required>
            <button type="submit">Search</button>
        </p>
    </form>

    <p><a href="cars.php">View All Cars</a></p>
</body>
</html>