<?php 
    require("functions.php");
    session_start(); 
?>

<!DOCTYPE HTML>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Answer</title>
  <link href="styles.css" rel="stylesheet">
</head>

<body>
    <?php
        $questionid = explode(",", array_keys($_POST)[1]);
        $col = $questionid[0];
        $row = $questionid[1];
        
        $currentPlayer = isset($_SESSION["currentPlayer"]) ? $_SESSION["currentPlayer"] : 1;

        if(strcasecmp($_POST["answer"], $_SESSION["questions"][$col][$row]->get_answer()) == 0){
            echo "<h1>Your answer is Correct!</h1>";
            echo "<h2>You earned $" . $_SESSION["questions"][$col][$row]->get_pointVal();
            echo "</h2>";
            if($_SESSION["questions"][$col][$row]->answered == 0)
                $_SESSION["player{$currentPlayer}points"] += intval($_SESSION["questions"][$col][$row]->get_pointVal());
        }else{
            echo "<h1>Your answer is Incorrect!</h1>";
            echo "<h2>You lost $" . $_SESSION["questions"][$col][$row]->get_pointVal();
						echo "</h2>";
            echo "<h2>Correct answer: What is " . $_SESSION["questions"][$col][$row]->get_answer();
            echo "</h2>";
            if($_SESSION["questions"][$col][$row]->answered == 0)
                $_SESSION["player{$currentPlayer}points"] -= intval($_SESSION["questions"][$col][$row]->get_pointVal());
        }
        
        $_SESSION["questions"][$col][$row]->answered = 1;

        $_SESSION["currentPlayer"] = ($currentPlayer == 1) ? 2 : 1;
    ?>
    <br>
    <a href="game.php" style="color: white;">Click Here to return to the Board</a>
</body>
</html>
