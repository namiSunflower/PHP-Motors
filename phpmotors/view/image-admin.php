<?php
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
    <title>Image Management</title>
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
            <h1>Image Management</h1>
            <?php
            if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
            }?>
            <p class="paragraph">Welcome! Please choose one of the options below:</p>
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>
            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label>Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset id='no_border'>
                    <label>Is this the main image for the vehicle?</label><br>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <label for="file1">Upload Image:</label>
            <input type="file" name="file1" id="file1" class="regbtn">
            <input type="submit" class="regbtn button" value="Upload">
            <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2>Existing Images</h2>
            <p class="red">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            }
            if(isset($displayClientReviews)){
              echo $displayClientReviews;
            }
             ?>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
<?php unset($_SESSION['message']); ?>
