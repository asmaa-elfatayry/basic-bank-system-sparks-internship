<!-- 
    -- transfer history page --
     Displays the history of all transferring

-->
<?php

// connect to mysql database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM  customers";
// check if connection faild
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="css/bootstrap.min.css ">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="styleSheet">
    <title>Bank System</title>
</head>

<body>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg bg-light ">
        <div class="container-fluid d-flex justify-content-between ">
            <a class="navbar-brand" href="#">Bank System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse  justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                    <a class="nav-link " href="./customers.php">Customers</a>
                    <a class="nav-link" href="./transfering.php">Transfer Money</a>
                    <a class="nav-link  active" href="./tranfersHistory.php">History</a>

                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- start main -->
    <main>
        <div class="container">
            <h1 class="text-center pt-4 pb-4">History of transfers</h1>

            <table class="table table-hover table-striped table-primary text-center transfer-table" id="all_customer">
                <thead>
                    <tr>

                        <th scope="col">Sender Id</th>
                        <th scope="col">Reciver Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    // select all data from transfers tabel
                    $sql = "SELECT * FROM transfers";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($rows = $result->fetch_assoc()) {
                    ?>
                    <tr>

                        <td class=' text-center py-2'>
                            <?php echo $rows['sender_id']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $rows['reciver_id']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $rows['amount']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $rows['date']; ?>
                        </td>

                    </tr>
                    <?php
                        }
                    }

                    ?>
                </tbody>
            </table>


    </main>
    <!-- end main -->
    <!-- start footer -->
    <footer>
        <p>All Rights Reserved &copy; Sparks Internship</p>
    </footer>
    <!-- end footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


</body>

</html>