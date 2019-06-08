<?php

	include('config.php');

	$action = $_REQUEST['action'];
	
	if($action=="showAll") { // Shows all the races first value is auto selected
		
		$stmt=$dbcon->prepare('SELECT distinct name from race');
		$stmt->execute();
		
	} else { // otherwise runs it and gets information from by dropdown value
		
		$stmt=$dbcon->prepare('SELECT name from race where distance=:distance order by name');
		$stmt->execute(array(':distance'=>$action));
	}
	
	?>
	<div class="row">
	<?php
	if($stmt->rowCount() > 0) {
		
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
	
			?>
			<div class="col-xs-3">
				<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px;"><?php echo $name; ?></div><br />
			</div>
			<?php		
		}
		
	}else{
		
		?>
        <div class="col-xs-3">
			<div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px;"><?php echo $name; ?></div><br />
		</div>
        <?php		
	}
	
	
	?>
	</div>