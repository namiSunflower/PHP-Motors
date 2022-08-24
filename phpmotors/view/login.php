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
          <?php 
          //Modularization code
          //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php';
          echo $navList;
          ?>
        </nav>
        <main>
        <h1>Sign In</h1>
        <?php
        if (isset($message)) {
           echo $message;
          }
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
         }
        ?>
        <form method="post" action="/phpmotors/accounts/index.php">
            <label for="loginEmail">Email:</label><br>
            <input name="clientEmail" id="loginEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
            <label for="loginPassword">Password:</label>
            <input name="clientPassword" id="loginPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            <input type="submit" id="login" class="button" value="Sign-in">
            <input type="hidden" name="action" value="Login">
            <a href="/phpmotors/accounts/?action=register-page" id="registerText">Not a member yet?</a>
        </form>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
