<?php
//build the select list
$classificationList = '<select name="classificationId" required>';
$classificationList .= "<option value=''>Choose Car Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] == $classificationId){
              $classificationList .= ' selected ';
            }
        }
        elseif(isset($invInfo['classificationId'])){
            if($classification['classificationId'] === $invInfo['classificationId']){
              $classificationList .= ' selected ';
            }
          }
        $classificationList .= ">$classification[classificationName]</option>";
        }
        $classificationList .= '</select>';
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || (isset($_SESSION['clientData']) && $_SESSION['clientData']['clientLevel'] < 2)){
        header('Location: /phpmotors/index.php');
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors>
    </title>
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
          <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
              echo "Modify$invMake $invModel"; }?>
          </h1><br>
          <?php
          if (isset($message)) {
            echo $message;
          }  
          if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
          }
          ?>

          <span class="infoSpan">*Note all Fields are Required</span>
          <form action="/phpmotors/vehicles/index.php" method="post">
            <?php echo $classificationList;?><br>
            <label for="make">Make</label><br>
            <input name="invMake" id="make" type="text" maxlength="30" <?php if(isset($invMake)){echo " value='$invMake'"; } elseif(isset($invInfo['invMake'])){echo " value='$invInfo[invMake]'"; }?> required>
            <label for="model">Model</label><br>
            <input name="invModel" id="model" type="text" maxlength="30" <?php if(isset($invModel)){echo " value='$invModel'"; } elseif(isset($invInfo['invModel'])){echo " value='$invInfo[invModel]'"; }?> required>
            <label for="description">Description</label><br>
            <textarea name="invDescription" id="description" cols="20" rows="5" required><?php if(isset($invDescription)){echo $invDescription; } elseif(isset($invInfo['invDescription'])){echo $invInfo['invDescription']; }?></textarea>
            <label for="image">Image Path</label><br>
            <input name="invImage" id="image" type="text" placeholder="/phpmotors/images/vehicles/no-image.png"  maxlength="50"<?php if(isset($invImage)){echo " value='$invImage'"; } elseif(isset($invInfo['invImage'])){echo " value='$invInfo[invImage]'"; }?> required>
            <label for="thumbnailPath">Thumbnail Path</label><br>
            <input name="invThumbnail" id="thumbnailPath" type="text" placeholder="/phpmotors/images/vehicles/no-image.png" maxlength="50"<?php if(isset($invThumbnail)){echo " value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])){echo " value='$invInfo[invThumbnail]'"; }?> required>
            <label for="price">Price</label><br>
            <input name="invPrice" id="price" type="number" step="any" <?php if(isset($invPrice)){ echo " value='$invPrice'"; } elseif(isset($invInfo['invPrice'])){echo " value='$invInfo[invPrice]'"; }?> required>
            <label for="stock"># In Stock</label><br>
            <span class="infoSpan">Inventory Stock must be less than or equal to 9999 and more than or equal to 1.</span>
            <input name="invStock" id="stock" type="number" min="1" max="9999"<?php if(isset($invStock)){ echo " value='$invStock'"; } elseif(isset($invInfo['invStock'])){echo " value='$invInfo[invStock]'"; }?> required>
            <label for="color">Color</label><br>
            <input name="invColor" id="color" type="text"  maxlength="20"<?php if(isset($invColor)){ echo " value='$invColor'"; } elseif(isset($invInfo['invColor'])){echo " value='$invInfo[invColor]'"; }?> required><br>
            <input type="submit" name="action" id="carbtn" class="button" value="Update Vehicle">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
        </form>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
