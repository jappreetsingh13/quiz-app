<?php
include "database.php";

session_start();
$number = $_GET['n'];
$user_id = $_GET['user_id'];

$select_dataSQL = "SELECT * FROM  question WHERE question_id =$number";
$select_dataResult = mysqli_query($conn,$select_dataSQL);
$fetch_data = mysqli_fetch_assoc($select_dataResult);

$total_questionsSQL = "SELECT * FROM question";
$total_questionsResult = mysqli_query($conn,$total_questionsSQL);
$total_questions = mysqli_num_rows($total_questionsResult);
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
            <div class="currentQuestion"> Question <?php echo $number." of ".$total_questions; ?> </div>
            <p class="question"><?php echo htmlspecialchars($fetch_data['questions']); ?></p>
            <form method="post" action="process.php">
                <ul class="answerChoices">
                  <?php
                  if($fetch_data) {
                    $explode_answer = explode("&nbqz;",$fetch_data['options']);
                    $optionNumber =1;
                    foreach($explode_answer as $choices){
                    ?>
                    <li style="list-style: none;"><input type="radio" name="selected_option" value="<?php echo $optionNumber; ?>"><?php echo htmlspecialchars($choices); ?></li>
                  <?php 
                    $optionNumber++; }
                 }  
                  ?>
                </ul>
                <input type="hidden" name="question_id" value="<?php echo $fetch_data['question_id']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="number" value="<?php echo $number; ?>">
                <input type="submit" value="Submit" name="submit">
            </form>
        </div>
    </main>
</body>
</html>