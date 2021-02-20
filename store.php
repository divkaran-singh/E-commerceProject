<?php
require("mysqli_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Store</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <a class="navbar-brand" href="index.php">Turn The Page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-5">
            <li class="nav-item  mr-5">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="store.php">Store</a>
            </li>
    </div>
</nav>
<div class="row m-3">
    <div class="col-md-12">
        <h3 class="text-center">Please Select a Book You Want to Buy </h3>
    </div>
</div>
<div>
    <table class="table table-striped">
        <tr class="text-center">
            <th>Book ID</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        $query = "SELECT * FROM bookinventory";
        $result = @mysqli_query($dbc, $query);

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr class='text-center'>
                     <td>{$row['bookid']}</td>
                     <td><a style='text-decoration: none;color:rgb(229,40,60)' href='checkout.php?name={$row['bookname']}'>{$row['bookname']}</a></td>
                     <td>{$row['quantity']}</td>
                  </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
