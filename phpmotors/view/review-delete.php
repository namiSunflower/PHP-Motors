<?php
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']){
        header('Location: /phpmotors/index.php');
}
$clientId = $_SESSION['clientData']['clientId'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Delete Review | PHP Motors</title>
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
          <h1>
          <?php if(isset($revInfo['invMake']) && isset($revInfo['invModel'])){ 
            echo "Delete $revInfo[invMake] $revInfo[invModel]";} 
              ?>
          </h1><br>
          <?php
          if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
          }  
          ?>
          <p>Reviewed on <?php if(isset($reviewDate)){echo date('d F,Y', strtotime($reviewDate));} elseif(isset($revInfo['reviewDate'])){echo date('d F,Y', strtotime($revInfo['reviewDate']));}?></p>
          <p class="red">Deletes cannot be undone. Are you sure you want to delete this review?</p>
          <form action="/phpmotors/reviews/index.php" method="post">
            <fieldset id='delete_field'>
              <p class="yellow_color"><?php if(isset($reviewText)){echo $reviewText;} elseif(isset($revInfo['reviewText'])){echo $revInfo['reviewText']; }?></p>
              <input type="submit" name="action" id="deleteRevBtn" class="button" value="Delete Review">
              <input type="hidden" name="action" value="deleteReview">
              <input type="hidden" name="reviewId" value="<?php if(isset($revInfo['reviewId'])){echo $revInfo['reviewId'];} elseif(isset($reviewId)){echo $reviewId;}?>">
            </fieldset>
        </form>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
