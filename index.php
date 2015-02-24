<html>
        <head>
                <title>Unicorn Travel</title>
                <link rel="stylesheet" href="./css/departure-board.css" />
        </head>
       
        <body>
                <div id="test"></div>
               
                <script src="./js/departure-board.js"></script>
                <script>
 
                
 
                       
                        var updateBoard = function() {

                        	<?php
                                require("OpenLDBWS.php");
 
                                $OpenLDBWS = new OpenLDBWS("2a991b08-7715-4ff4-ab4a-c6485047f6c5");
 
                                $departureBoardPHP = $OpenLDBWS->GetDepartureBoard(10,"HNH", "", "", 15);
 
                        //      #header("Content-Type: text/plain");
 
                        //      #print_r($departureBoard);
                ?>
	
				var jArray = <?php echo json_encode($departureBoardPHP); ?>;

				var myNode = document.getElementById("test");
			myNode.innerHTML = '';
				var board = new DepartureBoard (document.getElementById ('test'), { rowCount: 10, letterCount: 35 });
 
				if(jArray.GetStationBoardResult && jArray.GetStationBoardResult.trainServices && jArray.GetStationBoardResult.trainServices.service.length > 0) {
					
					var serviceArray  = jArray.GetStationBoardResult.trainServices.service;
					var boardArray = [];

					serviceArray.forEach(function(value) {
				    	//console.log(value.std);
				    	
				    	if(value.destination && value.destination.location && value.destination.location.locationName) {
				    		//console.log(value.destination.location.locationName);
				    		//board.setValue (value.std + value.destination.location.locationName);
				    		if (value.destination.location.locationName == 'Orpington' || value.destination.location.locationName == 'St Albans' || value.destination.location.locationName == 'Luton' || value.destination.location.locationName == 'Bedford' || value.destination.location.locationName == 'Beckenham Junction' || value.destination.location.locationName == 'Kentish Town')
				    		 {
				    		 	if (value.destination.location.locationName == 'Orpington' || value.destination.location.locationName == 'Beckenham Junction')	
				    			
				    				if (value.etd == "On time")
				    					boardArray.push(value.std + ' ' + 'Natey (Beckenham)'); 
				    				else
				    					boardArray.push(value.etd + ' ' + 'Natey (Beckenham)');	
				    			else 
				    				if (value.etd == "On time")
				    					boardArray.push(value.std + ' ' + 'Blackfriars');
				    				else
				    					boardArray.push(value.etd + ' ' + 'Blackfriars');
				    		}
				    		else 
				    				if (value.etd == "On time")
				    					boardArray.push(value.std + ' ' + value.destination.location.locationName);
				    				else
				    					boardArray.push(value.etd + ' ' + value.destination.location.locationName);
				    					
				    		
				    	}
					});

					board.setValue(boardArray);

				}

			}   
 
                       
                        
                        //board.setValue(["1335 Kings Cross", "1400 Utopia"]);
                        updateBoard();
                        window.setInterval (function () {
                                location.reload();
                                updateBoard();
                        }, 60000);
 
                </script>
        </body>
</html>