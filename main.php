<?php
include "database.php";
$selectSQL = "SELECT * FROM question";
$selectResult = mysqli_query($conn,$selectSQL);
$total_questions = mysqli_num_rows($selectResult);

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mob = mysqli_real_escape_string($conn, $_POST['mob']);
    $created_at = mysqli_real_escape_string($conn, $_POST['created_at']);    

    $insertSQL = "INSERT INTO user(`name`,`email`,`mob`,`created_at`) VALUES ('$name','$email','$mob','$created_at')";
    $insertResult = mysqli_query($conn,$insertSQL);

     $user_id = mysqli_insert_id($conn);

     header("LOCATION:quiz.php?n=1&user_id=$user_id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="container">
            <p>PHP QUIZZER</p>
        </div>
    </header>
    <main>
        <div class="container">
        <article class="userArticle">
            <h2>Test php Your Knowledge</h2>
            <p> This is multiple choice question to test your php Knowledge</p>
            <ul>
                <li class="infoList"><strong>Number of Questions : </strong><?php echo $total_questions; ?></li>
                <li class="infoList"><strong>Questions Type : </strong> MCQ</li>
            </ul>
        </article>
        <section class="userSection">
            <form method="post">
                <p>
                    <label>name : </label>
                    <input type="text" name="name">
                </p>
                <p>
                    <label>Email : </label>
                    <input type="text" name="email">
                </p>
                <p>
                    <label>Mobile Number : </label>
                    <input type="number" name="mob">
                </p>
                <p>
                    <label>Created At:</label>
                    <input type="datetime-local"  name="created_at">                    
                </p>
                <p>
                    <input type="submit" class="button" name="submit" value="submit">
                </p>
            </form>
        </section>
        </div>
    </main>
</body>
</html>