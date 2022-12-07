<!-- 
    -transfering page has two functions
    1- transfer money from one customer to anthor
    2- select Specific Customer with the id
 -->

<?php
// connect to mysql database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
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
    <link rel="stylesheet" href="css/sweetalert2.min.css ">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="styleSheet">
    <link rel="shortcut icon" href="./images/bank_icon_129525.ico" type="image/x-icon">
    <script src="js/sweetalert2.all.min.js"></script>
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
                    <a class="nav-link  " href="./customers.php">Customers</a>
                    <a class="nav-link active" href="./transfering.php">Transfer Money</a>
                    <a class="nav-link" href="./tranfersHistory.php">History</a>

                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->





    <!-- start main -->
    <main class="trasferPage">

        <div class="container">
            <h1 class="text-center pt-4 pb-4">Transferring Action </h1>
            <form method="post">
                <?php
                // make this action when user click on submit button
                if (isset($_POST['submit'])) {
                    // get sender & reciver id and amount from inputs
                    $sender = $_POST['sender_id'];
                    $reciver = $_POST['reciver_id'];
                    $amount = $_POST['amount_of_money'];

                    // if user didn't enter any thing or enter zero or negative value -> show error alert
                    if ($amount <= 0 || $sender <= 0 || $reciver <= 0) {
                ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'input fields must be more than zero !',

                })
                </script>
                <?php
                    } else {
                        // if input value correct selecet the row of sender and reciver and get the result in array formal
                        $sqlGetSender = "SELECT * from customers where id=$sender";
                        $sender_query = mysqli_query($conn, $sqlGetSender);
                        $sqlSender = mysqli_fetch_array($sender_query);

                        $sqlGetReciver = "SELECT * from customers where id=$reciver";
                        $recive_query = mysqli_query($conn, $sqlGetReciver);
                        $sqlReciver = mysqli_fetch_array($recive_query);
                        // if current balance of sender more than the amount -> transfer the money from him and add the value to recive
                        // update the tables in database
                        if ($amount < $sqlSender['current_balance']) {
                            $newbalanceC = $sqlSender['current_balance'] - $amount;
                            $sql = "UPDATE customers set current_balance=$newbalanceC where id=$sender";
                            mysqli_query($conn, $sql);

                            $newbalanceR = $sqlReciver['current_balance'] + $amount;
                            $sql = "UPDATE customers set current_balance=$newbalanceR where id=$reciver";
                            mysqli_query($conn, $sql);
                            // get id 
                            $senderID = $sqlSender['id'];
                            $reciverID = $sqlReciver['id'];
                            // Add the tranfering process to a table of transfers to make history of all process
                            $Insertsql = "INSERT INTO `transfers` (`trans_No`, `sender_id`, `reciver_id`, `amount`, `date`) VALUES ('NULL','$senderID ','$reciverID','$amount', current_timestamp())";
                            $insert = mysqli_query($conn, $Insertsql);
                            //  if the insert done tell the user
                            if ($insert) {
                ?>
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Transferring done successfully  ',
                    showConfirmButton: false,
                    timer: 1500
                })
                </script>
                <?php
                            }
                            // reset values
                            $newbalance = 0;
                            $amount = 0;
                        }
                        // if current balance of sender less than the amount -> display error message 
                        else if ($amount > $sqlSender['current_balance']) {
                ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sorry the amount of money is more than you have !',

                })
                </script>
                <?php
                        }

                    }

                }


                ?>
                <div class="mb-3">
                    <label class="form-label">Transfer From</label>
                    <input type="number" class="form-control" name="sender_id" aria-describedby="From">
                    <div id="emailHelp" class="form-text">Enter Your id.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Transfer To</label>
                    <input type="number" class="form-control" name="reciver_id" aria-describedby="To">
                    <div id="emailHelp" class="form-text">Enter the id of reciever.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount_of_money">
                </div>

                <button type="submit" name='submit' class="btn btn-outline-primary transfer-btn">Transfer</button>
            </form>

        </div>


        <!-- if the user want to select Specific Customer-->
        <div class="selcted-Cst">
            <h2 class="text-center pt-4 pb-4">Select A Specific Customer</h2>
        </div>
        <form method="get" class="container">

            <div class="mb-3">

                <input type="number" class="form-control custom" name="selctedid" placeholder="ID">
            </div>
            <button type="submit" name='select' class="btn btn-outline-success transfer-btn mt-3 mb-3">Show Customer
                Data</button>


            <?php
            if (isset($_GET['select'])) {
                $selctedId = $_GET['selctedid'];
                // dislay error message if user enter incorrect id value
                if ($selctedId <= 0) {

            ?>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Input field should be number more than zero !',

            })
            </script>



            <?php
                } else {
                    // get data of the selected customer in table
            ?>
            <table class="table table-hover table-striped table-primary text-center mt-5" id="all_customer">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Balance</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    $sql_custome = "SELECT * FROM customers WHERE id=$selctedId";
                    $res = mysqli_query($conn, $sql_custome);

                    if ($res->num_rows > 0) {
                        $row = $res->fetch_assoc()

                        ?>
                    <tr>
                        <td class=' text-center py-2'>
                            <?php echo $row['id']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $row['first_name']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $row['last_name']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $row['email']; ?>
                        </td>
                        <td class=' text-center py-2'>
                            <?php echo $row['current_balance']; ?>
                        </td>

                    </tr>
                    <?php
                    }
                }

                    ?>
                </tbody>
            </table>
            <?php

            }

            ?>
        </form>
    </main>
    <!-- end main -->
    <!-- start footer -->
    <footer>
        <p>All Rights Reserved &copy; Sparks Internship</p>

    </footer>
    <!-- end footer -->
    <!-- js links -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    </script>


</body>

</html>