<?php

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SHUHEI USUI | Works-Admin</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="">
	<link rel="shortcut icon" href="">

</head>
<body>

	<main>
		<section>
			<h1>Admin Form</h1>
			<form action="execute.php" method="post">
				<dl>
					<dt>NAME</dt>
					<dd><input type="text" name="name" required></dd>
				</dl>
				<dl>
					<dt>PASSWORD</dt>
					<dd><input type="password" name="password" required></dd>
				</dl>
				<input type="submit" value="LOGIN">
			</form>
		</section>
	</main>

</body>
</html>
