<?php
/**
 * Vehicles Model
 */

 //Add a new classification
 function addClassification($classificationName){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//Add a new vehicle
function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}
// Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    //before, it got *
    $sql = 'SELECT invMake, invModel, invPrice, images.invId, inventory.invId,
    invStock, invColor, invDescription, classificationId, imgPath, imgPrimary 
    FROM inventory JOIN images ON inventory.invId = images.invId WHERE inventory.invId = :invId AND imgPrimary LIKE "1%" AND imgPath NOT LIKE "%-tn%"';
    //JOIN inventory ON images.invId = inventory.invId WHERE imgPrimary LIKE "1%"
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
//original
// function getInvItemInfo($invId){
//     $db = phpmotorsConnect();
//     $sql = 'SELECT * FROM inventory WHERE invId = :invId';
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
//     $stmt->execute();
//     $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $invInfo;
// }
//Update vehicle info
function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
//Gets a list of vehicles based on the classification
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'SELECT invMake, invModel, invPrice, images.invId,
    invStock, invColor, invDescription, classificationId, imgPath, imgPrimary 
    FROM images JOIN inventory ON images.invId = inventory.invId WHERE imgPrimary LIKE "1%" AND imgPath LIKE "%-tn%" AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }

   // imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel, invPrice, 
    //invStock, invColor, invDescription, classificationId
// function getImages() {
//     $db = phpmotorsConnect();
//     $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId';
//     $stmt = $db->prepare($sql);
//     $stmt->execute();
//     $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $imageArray;
//    }

//    SELECT invModel, classificationName
//    FROM inventory
//    INNER JOIN carclassification ON inventory.classificationID = carclassification.classificationID
//    WHERE inventory.classificationID = 1; 

// Get information for all vehicles
function getVehicles(){
       $db = phpmotorsConnect();
       $sql = 'SELECT invId, invMake, invModel FROM inventory';
       $stmt = $db->prepare($sql);
       $stmt->execute();
       $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $stmt->closeCursor();
       return $invInfo;
   }
?>