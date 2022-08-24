<?php
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || (isset($_SESSION['clientData']) && $_SESSION['clientData']['clientLevel'] < 2)){
  header('Location: /phpmotors/index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PHP Motors Template</title>
    <meta name="description" content="This is for enhancement 1 of CSE 340">
    <link href="/phpmotors/css/small.css" rel="stylesheet">
    <link href="/phpmotors/css/large.css" rel="stylesheet">
  </head>
  <body>
      <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php';?>
        </header>
        <nav>
          <?php //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php';
          echo $navList;
          ?>

        </nav>
        <main>
        <h1>Add a new classification</h1><br>
        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
  
        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="className">Classification Name</label>
            <span class="infoSpan">Please enter no more than 30 characters.</span> 
            <input name="classificationName" id="className" type="text" maxlength="30" required><br>
            <input type="submit" name="action" id="classbtn" value="Add Classification">
            <input type="hidden" name="action" value="addClass">
        </form>
        
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
