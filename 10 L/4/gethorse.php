<?php

	include('config.php');

	$action = $_REQUEST['action'];
	
	if($action=="showAll") { // Shows all the information
		
		$stmt=$dbcon->prepare('SELECT distinct r.name, ri.finish, ri.tm from race r, horse h, runsin ri where ri.hid=h.horse_id and ri.rid=r.race_id');
		$stmt->execute();
		
	} else { // otherwise runs it and gets information from by the dropdown value
		
		$stmt=$dbcon->prepare('SELECT distinct r.name, ri.finish, ri.tm from race r, horse h, runsin ri where ri.hid=:horse_id and ri.rid=r.race_id');
		$stmt->execute(array(':horse_id'=>$action));
	}
	
	?>
	<div class="row">
		<!--table like column names-->
		<strong>
			<div class="col-xs-4">
				<div class="text-center">Race Names</div>
			</div>
			<div class="col-xs-4">
				<div class="text-center">Position</div>
			</div>
			<div class="col-xs-4">
				<div class="text-center">Time</div>
			</div>
		</strong>
		<br>
		<hr />	

	<?php
	if($stmt->rowCount() > 0){
				
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)) // generating HTML for all (default value)
		{
			extract($row);
	
			?>

			<div class="col-xs-4">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px; margin: 5px;"><?php echo $name; ?></div>
			</div>
			<div class="col-xs-4">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px; margin: 5px;"><?php echo $finish; ?></div>
			</div>
			<div class="col-xs-4">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px; margin: 5px;"><?php echo $tm; ?></div>
			</div>
			<?php		
		}
		
	} else { // generating HTML for selected item
		
		?>
 			<div class="col-xs-4">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px; margin: 5px;"><?php echo $name; ?></div>
			</div>
			<div class="col-xs-4">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px; margin: 5px;"><?php echo $finish; ?></div>
			</div>
			<div class="col-xs-4">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px; margin: 5px;"><?php echo $tm; ?></div>
			</div>
        <?php		
	}
	
	
	?>
	</div>