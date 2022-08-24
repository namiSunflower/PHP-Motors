//the 'use strict' directive tells the JavaScript parser to follow all rules strictly.
'use strict' 
 
 // Get a list of vehicles in inventory based on the classificationId 
let classificationList = document.querySelector("#classificationList"); 
classificationList.addEventListener("change", function () { 
    let classificationId = classificationList.value; 
    //Testing purposes
    console.log(`classificationId is: ${classificationId}`); 
    let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId; 
    //A "then" method that waits for data to be returned from the fetch. The response object is passed into an anonymous function for processing.
    fetch(classIdURL) 
    .then(function (response) { 
        if (response.ok) { 
            return response.json(); 
        } 
        throw Error("Network response was not OK"); 
        }) 
    .then(function (data) { 
    console.log(data); 
    //Sends the JavaScript object to a new function that will parse the data into HTML table elements 
    //and inject them into the vehicle management view.
    buildInventoryList(data); 
    }) 
    //A "catch" which captures any errors and sends them into an anonymous function.
    .catch(function (error) { 
        console.log('There was a problem: ', error.message) 
    }) 
    })

// Build inventory items into HTML table components and inject into DOM 
function buildInventoryList(data) { 
    let inventoryDisplay = document.getElementById("inventoryDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
     console.log(element.invId + ", " + element.invModel); 
     dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete' class="margin_left">Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable; 
}
