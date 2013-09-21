<?php
$page="grade";
require("header.php");
?>
<div class="page-header">
	<h1>Оценить домашки</h1>
</div>
<div class="row">
<?
if(isset($_POST['task_id'])) {
	$q3=$pdodb->query('SELECT * from grades WHERE task_id = "'.$_POST['task_id'].'" AND user_id = "'.$_POST['user_id'].'";');
	$q3->setFetchMode(PDO::FETCH_ASSOC);
	$grade = $q3->fetch();

	$criterias = array();
	foreach($_POST as $key => $value) {
		if(substr_count($key, "-")) {
			$key=explode("-", $key);
			if($key[0]=="critcomment") {
				$criterias[$key[1]]["comment"] = str_replace('"', "'", $value);
			} elseif ($key[0]=="critpoint") {
				$criterias[$key[1]]["point"] = $value;
			}
		}
	}
	if(!$grade) {
		$data=array(
			"grade_id"=>"",
			"task_id"=>$_POST['task_id'],
			"user_id"=>$_POST['user_id'],
		);
		$data["grade"] = addslashes(json_encode($criterias, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT));
		$q = $pdodb->prepare("INSERT INTO grades (".(implode(",",array_keys($data))).") VALUES ('".(implode("','",$data))."');")->execute();
		if($q) {
			?>
			<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Успех!</strong> Оценка добавлена.
			</div>
			<?php
		} else {
			?>
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Что-то не так!</strong> Ошибка.
			</div>
			<?php
		}
	} else {
		$q = $pdodb->prepare("UPDATE grades SET grade='".addslashes(json_encode($criterias, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT))."' WHERE task_id = '".$_POST['task_id']."' AND user_id = '".$_POST['user_id']."';")->execute();
		if($q) {
			?>
			<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Успех!</strong> Оценка обновлена.
			</div>
			<?php
		} else {
			?>
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Что-то не так!</strong> Ошибка.
			</div>
			<?php
		}
	}
}
?>
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
	            <th>#</th>
	            <th>Имя</th>
	            <th>Оценивание</th>
	          </tr>
	        </thead>
        	<tbody>
			<?php
			$q2=$pdodb->query('SELECT * from users WHERE group_id = "1";');
			$q2->setFetchMode(PDO::FETCH_ASSOC);
			$s=1;
			while($student = $q2->fetch()) {

				$q3=$pdodb->query('SELECT * from grades WHERE task_id = "'.$task['task_id'].'" AND user_id = "'.$student['user_id'].'";');
				$q3->setFetchMode(PDO::FETCH_ASSOC);
				$grade = $q3->fetch();
				if (isset($grade['grade'])) {
					$grade['grade'] = json_decode($grade['grade'],true);
				}
			?>
				<tr>
		        	<td><? echo $s;?></td>
		            <td><? echo $student['username'];?></td>
		            <td>
			            <form role="form" method="post">
		            	<?php
		            	foreach ($criteria as $key => $value) {
		            		$value = get_object_vars($value);
		            		?>
			            	<div class="form-group">
			            		<label for="critpoint-<? echo $key; ?>"><? echo $value['name'];?>: </label>
							    <select class="form-control" name="critpoint-<? echo $key; ?>" id="critpoint-<? echo $key; ?>">
							    	<?php
							    	for ($i=0; $i <= $value["points"]; $i++) {
							    		if(isset($grade['grade'][$key]["point"]) and $grade['grade'][$key]["point"] == $i) {
							    			echo "<option value='".$i."' selected>".$i."</option>";
							    		} else {
							    			echo "<option value='".$i."'>".$i."</option>";
							    		}
							    	}
							    	?>
							    </select>
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" name="critcomment-<? echo $key; ?>" placeholder="Комментарий" value="<?
							    if(isset($grade['grade'][$key]["comment"])) {
							    	echo $grade['grade'][$key]["comment"];
							    } ?>">
							</div>
		            		<?php
		            	}
		            	?>
		            		<input type="hidden" name="user_id" value="<? echo $student['user_id']; ?>">
		            		<input type="hidden" name="task_id" value="<? echo $task['task_id']; ?>">
						 	<button type="submit" class="btn btn-primary">Отправить</button>
						</form>
		            </td>
	        	</tr>
			<?php
				$s++;
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