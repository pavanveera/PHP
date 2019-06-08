<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
<style type="text/css">
select {
	
	width:250px;
	padding:5px;
	border-radius:3px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{		
	// function to get all information from table
	function getAll() {
		
		$.ajax
		({
			url: 'getdistance.php',
			data: 'action=showAll',
			cache: false,
			success: function(r)
			{
				$("#display").html(r);
			}
		});			
	}
	
	getAll();
	// function to get all information from table
	
	
	// code to get all information from table via select box
	$("#getDistance").change(function()
	{				
		var id = $(this).find(":selected").val();

		var dataString = 'action='+ id;
				
		$.ajax
		({
			url: 'getdistance.php',
			data: dataString,
			cache: false,
			success: function(r)
			{
				$("#display").html(r);
			} 
		});
	})
	// code to get all information from table via select box
});
</script>

</head>
<body>

<div class="container">    
	<div class="page-header text-center">
        <h1>Race Names for Selected Distance</h1>
        <p>Showing Race Names for Selected Distance</p>           
        <strong>Select a Distance: </strong> 
        <select id="getDistance">
	        <option value="showAll" selected="selected">Show All Races</option>
	        <?php
	        require_once 'config.php';
	        
	        $stmt = $dbcon->prepare('SELECT distinct distance FROM race order by distance');
	        $stmt->execute();
	        
	        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	        {
	            extract($row);
	            ?>
	            <option value="<?php echo $distance; ?>"><?php echo $distance; ?></option>
	            <?php
	        }
	        ?>
        </select>
    </div>

    <hr />
    
    <div class="" id="display">
       <!-- All the filtered information will be displayed here  -->
    </div>
</div>
</body>
</html>