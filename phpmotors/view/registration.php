<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PHP Motors Registration</title>
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
        <h1>Register</h1>
        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>
  
        <form action="/phpmotors/accounts/index.php" method="post">
            <label for="fName">First Name</label>
            <input name="clientFirstname" id="fName" type="text" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
            <label for="lName">Last Name</label>
            <input name="clientLastname" id="lName" type="text" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
            <label for="email">Email</label><br>
            <input name="clientEmail" id="email" type="email" placeholder="Enter a valid email address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
            <label for="password">Password</label>
            <span class="infoSpan">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
            <input name="clientPassword" id="password" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            <!-- <button id="showPass">Show Password</button> -->
            <input type="submit" name="action" id="regbtn" value="Register">
            <input type="hidden" name="action" value="register">
        </form>
        
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
