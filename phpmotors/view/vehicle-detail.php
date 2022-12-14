<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php
      echo $invInfo["invMake"] . " " . $invInfo["invModel"];
      ?> | PHP Motors, Inc.</title>
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
            echo $navList
          ?>
        </nav>
        <main>
          <?php 
          echo "<h1 class='resize-heading'>$invInfo[invMake] $invInfo[invModel]</h1><br>";
          if(isset($message)){
            echo $message; }

          if(isset($thumbnailDisplay) && isset($vehicleDisplay)){
            echo "<div id=two-cols>";
          }
           
          if(isset($thumbnailDisplay)){
              echo $thumbnailDisplay;
            }
          if(isset($vehicleDisplay)){
              echo $vehicleDisplay;
            }
            if(isset($thumbnailDisplay)){
              echo "</div>";
            }

          echo "<h2>Customer Reviews</h2><br>";
          echo "<h2>Review the $invInfo[invMake] $invInfo[invModel]</h2>";
          if(!isset($_SESSION['loggedin'])){
            echo "<p class='margins'>To add a review, please <a href='/phpmotors/accounts/?action=login-page'>sign in</a> first!</a></p>";
          }
          else{
            $screenName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];
            $clientId = $_SESSION['clientData']['clientId'];

            if(isset($_SESSION['message'])){
              echo $_SESSION['message']; 
              unset($_SESSION['message']);
            }

            echo "<form action='/phpmotors/reviews/index.php' method='post'>
            <fieldset id='review_fieldset'>
              <label for='scrName'>Screen Name:</label>
              <input name='screenName' id='scrName' type='text' readonly='readonly' value='$screenName'>
              <label for='rev'>Review:</label>
              <textarea name='reviewText' id='rev' rows='5' required></textarea>
              <input type='submit' name='submit' id='reviewbtn' class='button' value='Submit Review'>
              <input type='hidden' name='action' value='addReview'>
              <input type='hidden' name='invId' value='$invId'>
              <input type='hidden' name='clientId' value='$clientId'>
            </fieldset>
            </form>";
          }

          if(isset($message2)){
            echo $message2;
          }

          // Display the reviews here below :)
          if(isset($reviewsDisplay)){
            echo $reviewsDisplay;
          }
          ?>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>