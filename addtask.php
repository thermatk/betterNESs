<?php
$page="addtask";
require("header.php");
?>
<div class="page-header">
	<h1>Добавить задание</h1>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
	<form role="form" method="post">
		<div class="form-group">
			<label for="taskname">Название</label>
			<input name="taskname" type="text" class="form-control" id="taskname" placeholder="Название задания">
		</div>
		<div id="criterias">
			<div id="pattern" style="display:none;" class="form-group">
		        <div class="form-inline">
			    	<label for="criteria">Критерий</label>
		            <div class="form-group">
		                <input id="critname" name="critname" type="text" class="form-control" placeholder="Название"/>
		            </div>
		            <div class="form-group">
		                <input id="critpoints" name="critpoints" type="text" class="form-control" placeholder="Максимум баллов"/>
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