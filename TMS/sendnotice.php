<?php
include "partials/_dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["Date"];
    $subject = $_POST["Subject"];
    $mainnotice = $_POST["mainnotice"];

    session_start();
    $university_code = $_SESSION['universitycode'];

    // Use prepared statement to avoid SQL injection
    $sql = "INSERT INTO `notices` (`Subject`, `Notice`, `Date`, `University_code`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $subject, $mainnotice, $date, $university_code);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Notice sent";
        } else {
            echo "Unable to send the notice: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement: " . mysqli_error($conn);
    }
    
    // Close the connection
    mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send Notice</title>
    <style>
    body {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }

    .maincontainer {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    form {
        padding: 5%;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container w-50 maincontainer">
        <h2 class="container text-center"><u>SEND A NOTICE</u></h2>
        <form action="sendnotice.php" method="post">
            <div class="mb-1">
                <label for="Date" class="form-label">&nbsp;<b>Notice Date:</b></label>
                <input type="date" class="form-control" id="Date" name="Date" aria-describedby="emailHelp"
                    placeholder="Date">
            </div>
            <div class="mb-4">
                <label for="Subject" class="form-label"></label>
                <input type="text" class="form-control" id="Subject" name="Subject" aria-describedby="emailHelp"
                    placeholder="Subject">
            </div>

            <div class="content">
                <textarea class="form-control" placeholder="Notice: " id="mainnotice" name="mainnotice" rows="11"
                    style="height:35%;"></textarea>
                <label for="mainnotice"></label>
            </div>
            <div class="mt-4">

                <button type="submit" class="btn btn-primary">Send Notice</button>
                <a href="adminportal.php" class="btn btn-primary">Back to Home </a>

            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>