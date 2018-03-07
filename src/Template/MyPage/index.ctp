<main>
	<div id="mypage" class="container">
		<article class="row">
			<div>
<?php if($arts->count() != 0){ ?>
<?php foreach ($arts as $art) { ?>
				<figure class="col-md-3 col-xs-6">
					<a href="Articles?id=<?php echo $art->id ?>">
						<?php echo $this->Html->image('articles/'.$art->id.'.jpg', ['alt' => 'スポットイメージ']);?>
					</a>
				</figure>
<?php } ?>
<?php }else{ ?>
				<p>フォローしているユーザーがいません。</p>
				<p>誰かをフォローしましょう！</p>
<?php } ?>
			</div>
		</article>
	</div>
</main>
