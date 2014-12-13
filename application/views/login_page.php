<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

    <title>Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/main.css" rel="stylesheet">
</head>

<body>
    <div id='login-form'>
	<h2>Department Support System </h2>
	<!-- </form>-->
	 <?php
		echo anchor("cas_auth","Login");
	 ?>
	
    </div>
</body>

</html>
