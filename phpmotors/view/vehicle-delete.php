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

    if($_SESSION['clientData']['clientLevel'] < 2){
        header('location: /phpmotors/');
        exit;
    }?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors>
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
          <?php if(isset($invInfo['invMake'])){ 
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?>
          </h1><br>
          <?php
          if (isset($message)) {
            echo $message;
          }  
          ?>

          <p class="red margin_top">Confirm Vehicle Deletion. The delete is permanent.</p>
          <form action="/phpmotors/vehicles/index.php" method="post" id="deleteForm">
            <?php echo $classificationList;?><br>
            <label for="make">Make</label><br>
            <input name="invMake" readonly id="make" type="text"<?php if(isset($invInfo['invMake'])){ echo " value='$invInfo[invMake]'";}?>>
            <label for="model">Model</label><br>
            <input name="invModel" readonly id="model" type="text" <?php if(isset($invInfo['invModel'])){ echo " value='$invInfo[invModel]'";}?>>
            <label for="description">Description</label><br>
            <textarea name="invDescription" readonly id="description" cols="20" rows="5"><?php if(isset($invInfo['invDescription'])){ echo "$invInfo[invDescription]";}?></textarea>
            <input type="submit" name="action" id="carbtn" class="button" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
        </form>
        </main>
        <footer>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
        </footer>
      </div>
  </body>
</html>
