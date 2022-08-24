<?php
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || (isset($_SESSION['clientData']) && $_SESSION['clientData']['clientLevel'] < 2)){
        header('Location: /phpmotors/index.php');
        exit;
    }
if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
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
            echo $navList
          ?>
        </nav>
        <main>
          <h1>Vehicle Management</h1>
          <br>
          <ul class="carManagement">
              <li><a href="/phpmotors/vehicles/?action=classification-page">Add Classification</a></li>
              <li><a href="/phpmotors/vehicles/?action=vehicle-page">Add Vehicle</a></li>
          </ul>
          <?php
            if (isset($message)) { 
                echo $message; 
            } 
            if (isset($classificationList)) { 
                echo '<br><h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
            }
            ?>
            <noscript>
              <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
      <script src="../js/inventory.js"></script>
  </body>
</html>
<?php unset($_SESSION['message']); ?>