<?php
$page="stats";
require("header.php");
?>
<div class="page-header">
	<h1>Посмотреть оценки</h1>
</div>
<div class="row">
<?php
	$q=$pdodb->query('SELECT * from tasks ORDER BY task_id DESC;');
	$q->setFetchMode(PDO::FETCH_ASSOC);
	while($task = $q->fetch()) {
		echo "<h3>".$task["task_id"].". ".$task["taskname"]."</h3>";
		$criteria = json_decode($task['criterias']);
	?>
		<table class="table table-bordered table-striped">
			<thead>
	          <tr>
	          	<?php 
	          	if ($user->isAdmin()) {
	          		echo "<th>#</th>";	          		
	          		echo "<th>Имя</th>";
	          	}
	          	foreach ($criteria as $key => $value) {
	          		$value = get_object_vars($value);
	          		echo "<th>".$value['name']."(".$value['points'].")</th>";
	          	?>
	            	
	            <?php
	        	}
	        	?>
	            <th>Сумма баллов</th>
	          </tr>
	        </thead>
        	<tbody>
			<?php
			if (!($user->isAdmin())) {
				$q3=$pdodb->query('SELECT * from grades WHERE task_id = "'.$task['task_id'].'" AND user_id = "'.$user->id.'";');
				$q3->setFetchMode(PDO::FETCH_ASSOC);
				$grade = $q3->fetch();
				if (isset($grade['grade'])) {
					$grade['grade'] = json_decode($grade['grade'],true);
			?>
				<tr>
				<?php
					$totalpoints = 0;
		            foreach ($criteria as $key => $value) {
		            	$value = get_object_vars($value);
		            	$totalpoints+=$grade['grade'][$key]["point"];
		            	?>
		            <td>
						<? echo "<strong>(".$grade['grade'][$key]["point"].")</strong> ".$grade['grade'][$key]["comment"];?>
					</td>		            
					<?php
					}					
					echo "<td>".$totalpoints."</td>";
				} else {
					echo "<td colspan='".(count($criteria)+1)."'>Ещё не проверено</td>";
				}
				?>
	        	</tr>
	        <?php
	    	} else {
			$q2=$pdodb->query('SELECT * from users WHERE group_id = "1";');
			$q2->setFetchMode(PDO::FETCH_ASSOC);
			$s=1;
			while($student = $q2->fetch()) {
			?>
				<tr>
				<?php
				echo "<td>".$s."</td>";
				echo "<td>".$student['username']."</td>";
				$q3=$pdodb->query('SELECT * from grades WHERE task_id = "'.$task['task_id'].'" AND user_id = "'.$student['user_id'].'";');
				$q3->setFetchMode(PDO::FETCH_ASSOC);
				$grade = $q3->fetch();
				if (isset($grade['grade'])) {
					$grade['grade'] = json_decode($grade['grade'],true);
					$totalpoints = 0;
		            foreach ($criteria as $key => $value) {
		            	$value = get_object_vars($value);
		            	$totalpoints+=$grade['grade'][$key]["point"];
		            	?>
		            <td>
						<? echo "<strong>(".$grade['grade'][$key]["point"].")</strong> ".$grade['grade'][$key]["comment"];?>
		            </td>		            
					<?php
					}					
					echo "<td>".$totalpoints."</td>";
				} else {
					echo "<td colspan='".(count($criteria)*2+1)."'>Ещё не проверено</td>";
				}
				?>
	        	</tr>
	        <?php
	        $s++;
			}
	    	}
	        ?>
        	</tbody>
		</table>
	<?php
	}
	?>
</div>
<?php
require("footer.php");
?>