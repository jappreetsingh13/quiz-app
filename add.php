<?php
include "database.php";
if(isset($_POST['submit'])) {
    $questions  = $_POST['questions'];
    $answers = $_POST['answers'];

    $arrayOptions = array();
    $arrayOptions[0] = $_POST['options1'];
    $arrayOptions[1] = $_POST['options2'];
    $arrayOptions[2] = $_POST['options3'];
    $arrayOptions[3] = $_POST['options4'];
    $options = implode("&nbqz;",$arrayOptions);

    $insertSQL = "INSERT INTO question(`questions`,`options`,`answers`) VALUES ('$questions','$options','$answers')";
    $insertResult = mysqli_query($conn,$insertSQL);

    if ($insertResult) {
        $message = "DATA INSERTED SUCCESSFULLY";
    } else {
        echo "Error: ". $insertSQL. "<br>". mysqli_error($conn);
    }
}
    $selectSQL =  "SELECT * FROM question";
    $selectResult = mysqli_query($conn,$selectSQL);
    $total_questions = mysqli_num_rows($selectResult);
    $next_question = $total_questions+1;
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
            <p>PHP Quizzer</p>
        </div>
        <style>
            h4{
                color: #17e7178c;
            }
        </style>
    </header>
    <main>
        <div class="container">
            <h1 class="add-mainHeading">Add Questions for Quiz</h1>
            <?php if(isset($message)){
                echo "<h4>".$message."</h4>";
            } ?>
            <form method="post" action="add.php">
            <p>
                <label> Question ID : </label>
              <input type="number" name="question_id" value="<?php echo $next_question; ?>" disabled>
            </p>
                <p>
                    <label>Question : </label>  
                    <input type="text" name="questions">
                </p>
                    <p>
                        <label>Choice 1 : </label>
                        <input type="text" name="options1">
                    </p>
                    <p>
                        <label>Choice 2 : </label>
                        <input type="text" name="options2">
                    </p>
                    <p>
                        <label>Choice 3 : </label>
                        <input type="text" name="options3">
                    </p>        
                    <p>
                        <label>Choice 4 : </label>
                        <input type="text" name="options4">
                    </p>
                    <p>
                        <label>Correct Option Number : </label>
                        <input type="number" name="answers">
                    </p>
                    <input type="submit" class="button" name="submit" value="submit">
            </form>
        </div>
    </main>
</body>
</html>