--QUERY 1:
INSERT INTO clients(clientFirstname, clientLastname, clientEmail, clientPassword, comment)VALUES('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n','I am the real Ironman');

--QUERY 2:
UPDATE clients SET clientLevel = 3 WHERE clientEmail ="tony@starkent.com";

--QUERY 3:
UPDATE inventory SET invDescription = REPLACE(invDescription, "small interior", "spacious interior") WHERE invId = 12;

--QUERY 4:
SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification ON inventory.classificationID = carclassification.classificationID
WHERE inventory.classificationID = 1;

--QUERY 5:
DELETE
FROM
  inventory
WHERE
  invMake = "Jeep" AND invModel = "Wrangler";

--QUERY 6:
UPDATE inventory SET invImage=concat("/phpmotors", invImage),  invThumbnail = concat("/phpmotors",  invThumbnail)