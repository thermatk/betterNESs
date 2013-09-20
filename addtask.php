<?php
$page="addtask";
require("header.php");
?>
<div class="page-header">
	<h1>Добавить задание</h1>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
<?php
if(isset($_POST['taskname'])) {
	$data=array(
		"task_id"=>"",
		"taskname"=>$_POST['taskname'],
	);
	$criterias = array();
	$error = false;
	foreach($_POST as $key => $value) {
		if(substr_count($key, "-")) {
			$key=explode("-", $key);
			if($key[0]=="critname") {
				$criterias[$key[1]]["name"] = $value;
			} elseif ($key[0]=="critpoints") {
				if(!is_numeric($value)) {
					$error = true;
					break;
				}
				$criterias[$key[1]]["points"] = $value;
			}
		}
	}
	if(!$error) {
		$data["criterias"] = json_encode($criterias);
		$q = $pdodb->prepare("INSERT INTO tasks (".(implode(",",array_keys($data))).") VALUES ('".(implode("','",$data))."');")->execute();
		if($q) {
			?>
			<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Успех!</strong> Задание <?php echo $_POST['taskname']; ?> добавлено.
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
		?>
		<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Ошибка!</strong> Баллы должны быть числом.
		</div>
		<?php
	}
}
?>
	<form role="form" method="post">
		<div class="form-group">
			<label for="taskname">Название</label>
			<input name="taskname" type="text" class="form-control" id="taskname" placeholder="Название задания" autofocus>
		</div>
		<div id="criterias">
			<div id="pattern" style="display:none;" class="form-group">
		        <div class="form-inline">
			    	<label for="criteria">Критерий</label>
		            <div class="form-group">
		                <input id="critname" type="text" class="form-control" placeholder="Название"/>
		            </div>
		            <div class="form-group">
		                <input id="critpoints" type="text" class="form-control" placeholder="Максимум баллов"/>
		            </div>
		        </div>
			</div>
			<div id="criteria-0" class="form-group">
		        <div class="form-inline">
			    	<label for="criteria">Критерий</label>
		            <div class="form-group">
		                <input id="critname" name="critname-0" type="text" class="form-control" placeholder="Название"/>
		            </div>
		            <div class="form-group">
		                <input id="critpoints" name="critpoints-0" type="text" class="form-control" placeholder="Максимум баллов"/>
		            </div>
		        </div>
			</div>
		</div>
		<a id="addcrit" class="btn btn-default">Ещё критерий</a>
		<button type="submit" class="btn btn-primary">Добавить</button>
	</form>
  </div>
</div>
<?php
$addscripts[]="js/addtask.js";
require("footer.php");
?>