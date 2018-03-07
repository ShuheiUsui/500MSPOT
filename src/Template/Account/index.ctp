<main>
	<div id="mypage" class="container">
	<div class="row">
		<aside class="col-md-3">
			<div class="user_info">
				<div class="header">
					<img src="/GitHub/500MSPOT/img/user/<?php echo $user->id; ?>.jpg" alt="ユーザーのイメージ">
				</div>

				<p><?php echo $user->name; ?></p>
			</div>

			<div class="profile">
				<h2>基本情報</h2>

				<p><?php echo nl2br(h($user->description)); ?></p>
				<p><a href="/GitHub/500MSPOT/Account/Edit" class="btn btn-block btn-primary">編集</a></p>
			</div>

			<div class="config">
				<h2>設定</h2>

				<ul>
					<li><a href="/GitHub/500MSPOT/Inquiry" class="btn">問い合わせ</a></li>
					<li><a href="/GitHub/500MSPOT/Logout" class="btn">ログアウト</a></li>
				</ul>
			</div>
		</aside>

		<div class="col-md-9 arts">
<?php if($userArts->count() != 0 ){ ?>
<?php foreach ($userArts as $art) { ?>
			<figure class="col-md-4 col-xs-6">
				<a href="Articles?id=<?php echo $art->id ?>">
					<?php echo $this->Html->image('articles/'.$art->id.'.jpg', ['alt' => 'スポットイメージ']);?>
				</a>
			</figure>
<?php } ?>
<?php }else{ ?>
			<p>写真を投稿しましょう！</p>
			<p><a href="Post" class="btn btn-default">投稿</a></p>
<?php } ?>
		</div>
	</div>
	</div>
</main>
