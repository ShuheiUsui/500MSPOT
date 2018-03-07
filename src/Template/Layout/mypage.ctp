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
		<header class="mypage_header">
			<div  class="mypage_nav">
				<ul>
					<li>HOME</li>
					<li>お知らせ</li>
					<li>メッセージ</li>
				</ul>
				<a href="#">投稿</a>
			</div>
		</header>



		<main>
			<?= $this->fetch('content'); ?>
		</main>

		<footer>
			<p>2017 <i class="fa fa-copyright">copyright</i> SPOT</p>
		</footer>
	</body>
</html>
