<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="dice.png">
    <link rel="stylesheet" href="style.css">
    <title>Diceware Password Generator</title>
  </head>
  <body>
    <div class="container">
      <h1>🎲 Diceware Password Generator 🎲</h1>
      <form action="index.php" method="post">
      <input type="submit" name="generator" id="btn" value="Create Password" />
        <p>
          <span id="answer" name="answer">
          </span>
        </p>
      </form>
      <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['generator']))
        {
          generatePassword();
        }
      ?>
    </div>
  </body>
</html>

<?php
  function randomizeWord() {
    $diceResult = array();
    $i = 0;
    while ($i <2) {
      $diceThrow = rand(1, 6);
      $diceResult[] = $diceThrow;
      $i++;
    }
    $diceResult = implode(",",$diceResult);
    return $diceResult;
  }

  function newWord(){
    $words = array(
      '11Match',  
      '12Goal',  
      '13Striker',  
      '14Midfield',  
      '15Defender',  
      '16Keeper',  
      '21Coach',  
      '22Tactics',  
      '23Dribble',  
      '24Pass',  
      '25Assist',  
      '26Freekick',  
      '31Penalty',  
      '32Offside',  
      '33VAR',  
      '34Corner',  
      '35Header',  
      '36Sub',  
      '41Referee',  
      '42Fans',  
      '43Stadium',  
      '44Injury',  
      '45Yellow',  
      '46Red',  
      '51League',  
      '52Teamwork',  
      '53Counter',  
      '54Champion',  
      '55Derby',  
      '56Playmaker',  
      '61WorldCup',  
      '62Final',  
      '63Manager',  
      '64Transfer',  
      '65Hattrick',  
      '66Tifo'  
    );
    $b = 0;
    $a = 0;
    $dices = randomizeWord();
    $dices = (string)$dices;
    $dices = str_replace(",","",$dices);
    
    while ($a<1) {
      if (strpos($words[$b], $dices) === 0) {
        $a++;
        $newDices = str_replace($dices,"",$words[$b]);
        return $newDices;
      } else {
        $b++;
        continue;
      }
    }
  }

  function generator(){
    $initialWord = newWord();
    $changedWord = "@" . $initialWord;
    return $changedWord; 
  }

  function generatePassword(){
    $initialWord = newWord();
    $middleWord = newWord();
    $finalWord = newWord();
    
    if ($initialWord === $middleWord){
      $initialWord = newWord();
      generatePassword();
    }
    elseif ($initialWord === $finalWord){
      $initialWord = newWord();
      generatePassword();
    }
    elseif ($middleWord === $finalWord){
      $middleWord = newWord();
      generatePassword();
    }
    else {
      $changedWord = "@" . $initialWord;
      echo "<script lang='javascript'>";
      echo "document.getElementById('answer').style.display = 'block';";
      echo "document.getElementById('answer').innerHTML = '$changedWord' + ' ' + '$middleWord'  + ' ' + '$finalWord';";
      echo "</script>";
    }
  }
?>