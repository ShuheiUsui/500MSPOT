<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset('UTF-8') ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $this->fetch('title') ?>
		</title>
		<?= $this->Html->meta('icon') ?>
		<?= $this->Html->css('common.css') ?>

	</head>
	<body>
		<header class="user_header">
			<div class="user_image">
				<img src="#" alt="ユーザーのイメージ">
			</div>

		</header>

		<div class="user_nav">
			<div class="wrapper">
				<div class="user_icon">
					<img src="#" alt="ユーザーのアイコン">
				</div>

				<div class="link_wrapper">
					<ul>
						<li><a href="#">HOME</a></li>
						<li><a href="#">お知らせ</a></li>
						<li><a href="#">メッセージ</a></li>
					</ul>
					<a href="#">投稿</a>
				</div>
			</div>
		</div>

		<main>
			<?= $this->fetch('content'); ?>
		</main>

		<footer>
			<p>2017 <i class="fa fa-copyright">copyright</i> SPOT</p>
		</footer>
	</body>
</html>
