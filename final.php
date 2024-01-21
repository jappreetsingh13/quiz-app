<?php
include "database.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']);
} 
$selectSQL = "SELECT * FROM question";
$selectResult = mysqli_query($conn,$selectSQL);

$selectQuizTable = "SELECT * FROM quiz_record";
$selectQuizTableResult = mysqli_query($conn,$selectQuizTable);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>Result Page</title>
    <style>
        body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f2f2f2;
}

header {
  background-color: #382e96;
  color: #fff;
  text-align: center;
  padding: 10px 0;
}

.menu {
  width: 80%;
  margin: 20px auto;
}

.container {
  width: 60%;
  margin: 0 auto;
  overflow: auto;
}

table {
  width: 100%;
  margin-top: 20px;
}

th, td {
  text-align: center;
  padding: 10px;
}

th {
  background-color: #382e96;
  color: #fff;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

.score {
  font-size: 18px;
  margin-top: 20px;
}

.percentage {
  font-size: 18px;
  margin-top: 10px;
}

.container {
  margin-top: 20px;
}

    </style>
</head>
<body>
    <header>
        <div class="container">
            <p>PHP QUIZ Result</p>
        </div>
    </header>
    <main>
        <div class="menu">
            <table class="table table-bordered">
  <thead>
    <tr>
        <th>S.NO </th>
      <th>Question</th>
      <th>Selected Answer</th>
      <th>Correct Answer</th>
      <th>Result </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $serial_num = 1;
    $score =0;

    
    $sql = "SELECT * FROM quiz_record INNER JOIN question ON quiz_record.question_id = question.question_id WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

    $total_questions = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {

        $quiz_record_id = $row['quiz_record_id'];
        $questions = htmlspecialchars($row['questions']);
        $question_id = $row['question_id'];
        $user_id = $row['user_id'];
        $selected_answer = htmlspecialchars($row['selected_answer']);
        $options = $row['options'];
        $correct_answer = $row['answers'];
        
        echo "<tr>";
        echo "<td>$serial_num</td>";
        $serial_num++;
        echo "<td>$questions</td>";
        ?>
            <td>
                <?php
                    $explodingOpt = explode("&nbqz;",$options);
                    if($selected_answer) {
                    echo $out_selected_answer = htmlspecialchars($explodingOpt[$selected_answer-1]);
                    } else {
                        echo $out_selected_answer = "no answer selected";
                    }
                ?>
            </td>
            <td>
                <?php
                    echo $out_correct_answer =  htmlspecialchars($explodingOpt[$correct_answer-1]);
                ?>
            </td>
        <?php

        if($out_correct_answer == $out_selected_answer) {
            echo '<td style="color:green">Correct</td>';
            $score++;
        } else { 
            echo '<td style="color:red">Wrong</td>';
        }
       
        echo "</tr>";
        
    }
    ?>
  </tbody>
</table>

<?php 
    echo "<br><br>";
    echo "<p><b>Your Score :</b> ".$score."<b>/</b>".$total_questions;
    $percentage = ($score/$total_questions)*100;
    echo "<b><h3>Result : $percentage% </h3></b>";
?>
        </div>
    </main>
</body>
</html>