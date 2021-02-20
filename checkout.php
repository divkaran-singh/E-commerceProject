<?php
session_start();
if (isset($_GET['name'])) {
    $_SESSION['name'] = $_GET['name'];
    $bookname = $_SESSION['name'];
    echo "<div class='row mt-4'>
        <div class='col-md-12'>
            <h3 class='text-center'>Fill in the details to Order {$bookname} </h3>
        </div>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class='row mt-4'>
    <div class='col-md-12'>
        <h3 id="bookNameFromSession" class='text-center'></h3>
    </div>
</div>
<div class="row m-4">
    <div class="col-md-12">
        <form id="checkOutForm" action="checkout.php" method="post">
            <div class="form-group row">
                <div class="col-md-2">
                    <label class="lead" for="firstname"><span class="text-danger">*</span> First Name:</label>
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="john"
                           value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label class="lead" for="lastname"><span class="text-danger">*</span> Last Name:</label>
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="doe"
                           value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                </div>
            </div>
            <label class="lead font-weight-bold"><span class="text-danger">*</span> Select Payment
                Method:</label><br>
            <input type="radio" id="debit" name="paymentoption" value="debit"
                <?php if (isset($_POST['paymentoption']) && $_POST['paymentoption'] == "debit") echo "checked=\'checked\'" ?>
            >
            <label class="lead" for="debit">Debit</label><br>
            <input type="radio" id="credit" name="paymentoption" value="credit"
                <?php if (isset($_POST['paymentoption']) && $_POST['paymentoption'] == "credit") echo "checked=\'checked\'" ?>
            >
            <label class="lead" for="credit">Credit</label><br>
            <input type="radio" id="cash" name="paymentoption" value="cash"
                <?php if (isset($_POST['paymentoption']) && $_POST['paymentoption'] == "cash") echo "checked=\'checked\'" ?>
            >
            <label class="lead" for="cash">Cash</label>
            <div class="row form-group offset-3 col-md-3">
                <input class="btn btn-outline-success form-control" type="submit" value="Place Order">
            </div>

        </form>
    </div>
</div>
</body>
</html>
<?php
require("mysqli_connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bookname = $_SESSION['name'];
    $flag = true;
    if (empty($_POST['firstname'])) {
        echo "<script>
document.getElementById('bookNameFromSession').innerHTML='Fill in the details to Order {$bookname}';
</script>
<div class='row col-md-12 ml-5'>
    <p class='text-danger'>First name is not entered</p>
</div>";
        $flag = false;
    }
    if (empty($_POST['lastname'])) {
        echo "<script>
document.getElementById('bookNameFromSession').innerHTML='Fill in the details to Order {$bookname}';
</script>
<div class='row col-md-12 ml-5'>
    <p class='text-danger'>Last name is not entered</p>
</div>";
        $flag = false;
    }
    if (!isset($_POST['paymentoption'])) {
        echo "<script>
document.getElementById('bookNameFromSession').innerHTML='Fill in the details to Order {$bookname}';
</script>
<div class='row col-md-12 ml-5'>
    <p class='text-danger'>Please select a payment option.</p>
</div>";
        $flag = false;
    }
    if ($flag == true) {
        $firstname = mysqli_real_escape_string($dbc, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($dbc, $_POST['lastname']);
        $paymentoption = mysqli_real_escape_string($dbc, $_POST['paymentoption']);
        echo "<script>
document.getElementById('bookNameFromSession').innerHTML='Fill in the details to Order {$bookname}';
document.getElementById('checkOutForm').reset();
</script>
<div class='row col-md-12 ml-5'>
    <p class='text-success'>Congratulations ! Your Order for {$bookname} is placed Successfully !!!</p>
</div>";
        $insertQuery = "INSERT INTO bookinventoryorder (firstname,lastname,paymentoption,bookname) VALUES ('$firstname','$lastname','$paymentoption','$bookname')";
        mysqli_query($dbc, $insertQuery);
        $reduceQuantity = "UPDATE bookinventory SET quantity=quantity-1 WHERE bookname='$bookname'";
        mysqli_query($dbc, $reduceQuantity);
    }
    mysqli_close($dbc);
}

?>
