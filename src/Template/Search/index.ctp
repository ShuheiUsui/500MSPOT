<main>
	<div id="top" class="container">
		<article class="row">
<?php foreach ($arts as $row) { ?>
			<figure class="col-md-3 col-xs-6">
				<a href="Articles?id=<?php echo $row->id ?>" class="spot">
					<?php echo $this->Html->image('spot/'.$row->image.$row->id.'.jpg', ['alt' => 'スポットイメージ']);?>
				</a>
			</figure>
<?php } ?>
		</article>
	</div>
</main>

<a href="./Post">投稿</a>
<a href="./Map">Map</a>
<a href="./MyPage">マイページ</a>
<a href="./User">ユーザページ</a>
<a href="./Logout">logout</a>
<a href="./Inquiry">問い合わせ</a>
<a href="./AdminLogin">管理者</a>
