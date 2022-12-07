<!-- the main page -> Home -->
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
    <link href="css/style.min.css" rel="stylesheet">
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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="./customers.php">Customers</a>
                    <a class="nav-link" href="./transfering.php">Transfer Money</a>
                    <a class="nav-link" href="./tranfersHistory.php">History</a>

                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- start main -->
    <main class="welcome">
        <div class="overlay">
            <h1>Wlocome To Our Banking System</h1>
        </div>
    </main>
    <!-- end main -->
    <!-- start footer -->
    <footer>
        <p>All Rights Reserved &copy; Sparks Internship</p>
    </footer>
    <!-- end footer -->
    <!-- JavaScript links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="js/sweetalert2.all.min.js"></script>

</body>

</html>