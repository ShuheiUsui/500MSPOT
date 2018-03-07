<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset('UTF-8'); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php echo $this->Html->meta('icon'); ?>
		<? $this->Html->css('reset.css'); ?>
		<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
		<link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet">
		<?php echo $this->Html->css('bootstrap.min.css'); ?>
		<?php echo $this->Html->css('font-awesome.min.css'); ?>
		<?php echo $this->Html->css('style.css'); ?>
		<?php echo $this->Html->css('modal.css'); ?>
	</head>

	<body>
		<script src="/spot/js/jquery-3.2.1.min.js"></script>
		<header class="<?php if($this->name == 'Home'){ echo 'top_main_visual'; }else{ echo 'sub_main_visual'; } ?>">
			<ul id="header_nav" class="list-inline">
<?php if(!isset($_SESSION['userInfo'])){ ?>
				<li><a href="/Spot/SignUp">新規登録</a></li>
				<li><a href="/Spot/Login">ログイン</a></li>
<?php }else{ ?>
				<li><a href="/Spot/Post"><i class="fa fa-edit"></i></a></li>
				<li><a href="/Spot/Map"><i class="fa fa-map-marker"></i></a></li>
				<li><a href="/Spot/MyPage"><i class="fa fa-home"></i></a></li>
				<li><a href="/Spot/Account"><i class="fa fa-user-circle"></i></a></li>
<?php } ?>
			</ul>

			<h1><a href="/Spot"><?php echo $this->Html->image('logo.png', array('alt' => '500MSPOTのロゴ')); ?></a></h1>
		</header>

		<div class="navToggle">
			<div id="navToggle">
				<div>
					<span></span> <span></span> <span></span>
				</div>
			</div>
		</div>

		<nav>
			<ul>
				<li><a href="/Spot/?category=1">グルメ</a></li>
				<li><a href="/Spot/?category=2">ショッピング</a></li>
				<li><a href="/Spot/?category=3">観光</a></li>
				<li><a href="/Spot/?category=4">Other</a></li>
				<li>
					<form class="header_searchform" action="/Spot/" method="Get">
						<input type="text" name="tags" placeholder="SearchForm..." required>
						<button href="#" class="btn">
							<i class="fa fa-search"></i>
						</button>
					</form>
				</li>
			</ul>
		</nav>

		<?php echo $this->fetch('content'); ?>

		<footer>
			<p class="container text-center"><?php echo date('Y'); ?> <i class="fa fa-copyright"></i> 500M <a href="Admin" id="toAdmin">SPOT</a></p>
		</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/Spot/js/modal.js"></script>
<script type="text/javascript">

//トグルメニュー
$('.navToggle').on('click','#navToggle',function(){
	$('nav').slideToggle();
	$('#navToggle > div').toggleClass('openNav');
});

// $(document).on('click','.closeNav',function(){
// 	$(this > 'div').removeClass();
// 	$(this > 'div').addClass('openNav');
//
// 	$('.navigation_main').slideUp();
// 	console.log('Close');
// });
</script>
	</body>
</html>
