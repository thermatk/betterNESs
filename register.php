<?php
$page="register";
require("header.php");
?>
<div class="page-header">
	<h1>Добавить пользователя</h1>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
<?php
if(isset($_POST['useremails'])) {
	$useremails = explode(" ", $_POST['useremails']);
	foreach ($useremails as $useremail) {
			$genpass = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,8);
			$regdata=array(
				"username"=>explode("@",$useremail)[0],
				"email"=>$useremail,
				"password"=>$genpass
			);

			$newuser= clone $user;
			$registered = $newuser->register($regdata,false);
			if($registered) {
				$data=array(
					"regusers_id"=>"",
					"regusersemail"=>$useremail,					
					"reguserspass"=>$genpass
				);
				$q = $pdodb->prepare("INSERT INTO regusers (".(implode(",",array_keys($data))).") VALUES ('".(implode("','",$data))."');")->execute();
				if($q) {
				    ?>
				    <div class="alert alert-success alert-dismissable">
				      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				      <strong>Успех!</strong> Пользователь <?php echo explode("@",$useremail)[0]; ?> с паролем <?php echo $genpass; ?> добавлен.
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
			    foreach($newuser->error() as $err){
			      ?>
			      <div class="alert alert-danger alert-dismissable">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <strong>Ошибка!</strong> <?php echo $err?>.
			      </div>
			      <?php
			    }
			}
	}
}
?>
		<form role="form" method="post">
			<div class="form-group">
				<label for="useremails">Название</label>
				<textarea class="form-control" rows="3" id="useremails" name="useremails" placeholder="Адреса новых пользователей через пробел" autofocus></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Добавить</button>
		</form>
	</div>
</div>
<?php
require("footer.php");
?>