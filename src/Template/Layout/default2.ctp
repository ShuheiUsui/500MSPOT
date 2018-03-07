<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset('UTF-8') ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $this->fetch('title') ?>
		</title>
		<?= $this->Html->meta('icon') ?>
		<?= $this->Html->css('reset.css') ?>
		<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
		<link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<?= $this->Html->css('style.css') ?>
		<?= $this->Html->css('font-awesome.min.css') ?>
	</head>
	<body>
		<script src="/spot/js/jquery-3.2.1.min.js"></script>
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/Spot/">500M<br>SPOT</a>
						<?php //echo $this->Html->image('logo.png', array('alt' => 'SPOTのロゴ')); ?>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

						<ul class="nav navbar-nav navbar-right">
<?php if(isset($login)){ ?>
<?php if($login){ ?>
							<li class="icon"><i class="fa fa-camera" aria-hidden="true"></i></li>
							<li class="icon"><i class="fa fa-bell" aria-hidden="true"></i></li>
							<li class="icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></li>
<?php }else{ ?>
							<li><a href="http://localhost/Spot/SignUp">アカウント作成</a></li>
							<li><a href="http://localhost/Spot/Login">ログイン</a></li>
<?php } ?>
<?php } ?>
						</ul>

						<form class="navbar-form navbar-right" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
						</form>

					</div><!-- /.navbar-collapse -->

				</div><!-- /.container-fluid -->
			</nav>
		</header>

		<?= $this->fetch('content'); ?>

		<footer>
			<p class="container text-center"><?php echo date('Y'); ?> <i class="fa fa-copyright"></i> 500M SPOT</p>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>
