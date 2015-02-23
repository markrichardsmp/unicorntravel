<html>
        <head>
                <title>JavaScript/CSS3 Departure Board</title>
                <link rel="stylesheet" href="./css/departure-board.css" />
        </head>
       
        <body>
                <div id="test"></div>
               
                <script src="./js/departure-board.js"></script>
                <script>
 
                <?php
                                require("OpenLDBWS.php");
 
                                $OpenLDBWS = new OpenLDBWS("2a991b08-7715-4ff4-ab4a-c6485047f6c5");
 
                                $departureBoardPHP = $OpenLDBWS->GetDepartureBoard(10,"HNH");
 
                        //      #header("Content-Type: text/plain");
 
                        //      #print_r($departureBoard);
                ?>
 
                       
                        var updateBoard = function() {
	
console.log("Updating board....");
				var jArray = <?php echo json_encode($departureBoardPHP); ?>;

				var myNode = document.getElementById("test");
			myNode.innerHTML = '';
				var board = new DepartureBoard (document.getElementById ('test'), { rowCount: 10, letterCount: 25 });
 
				if(jArray.GetStationBoardResult && jArray.GetStationBoardResult.trainServices && jArray.GetStationBoardResult.trainServices.service.length > 0) {
					
					var serviceArray  = jArray.GetStationBoardResult.trainServices.service;
					var boardArray = [];

					serviceArray.forEach(function(value) {
				    	//console.log(value.std);
				    	
				    	if(value.destination && value.destination.location && value.destination.location.locationName) {
				    		//console.log(value.destination.location.locationName);
				    		//board.setValue (value.std + value.destination.location.locationName);
				    		if (value.destination.location.locationName == 'Orpington' || value.destination.location.locationName == 'St Albans' || value.destination.location.locationName == 'Luton' || value.destination.location.locationName == 'Bedford')
				    		 {
				    		 	if (value.destination.location.locationName == 'Orpington')	
				    			boardArray.push(value.std + ' ' + 'Natey & MP House'); 	
				    			else 
				    			boardArray.push(value.std + ' ' + 'Make Positive HQ');
				    		}
				    		
				    	}
					});

					board.setValue(boardArray);

				}

			}   
 
                       
                        
                        //board.setValue(["1335 Kings Cross", "1400 Utopia"]);
                        updateBoard();
                        window.setInterval (function () {
                                updateBoard();
                        }, 60000);
 
                </script>
        </body>
</html>