　<main>
	<div id="mypage" class="container">
		<div class="row">
			<aside class="col-md-3">
				<ul>
					<li><a href="#" class="btn">プロフィール編集</a></li>
					<li><a href="#" class="btn">パスワード変更</a></li>
					<li><a href="#" class="btn">電話番号の変更</a></li>
				</ul>
			</aside>

			<article class="col-md-9">
				<form action="/GitHub/500MSPOT/Account/Execute" method="post">
					<dl>
						<dt><img src="/GitHub/500MSPOT/img/user/<?php echo $user->id; ?>.jpg" alt="ユーザーのイメージ"></dt>
						<dd>
							<a href="#" class="btn">画像を変更</a>
						</dd>
					</dl>

					<dl>
						<dt>名前</dt>
						<dd>
							<input type="text" name="name" class="form-control" value="<?php echo $user->name; ?>">
						</dd>
					</dl>

					<dl>
						<dt>自己紹介</dt>
						<dd>
							<textarea name="description" class="form-control" rows="8" cols="80"><?php echo $user->description; ?></textarea>
						</dd>
					</dl>

					<dl>
						<dt>メールアドレス</dt>
						<dd>
							<input type="text" name="address" class="form-control" value="<?php echo $user->mailAddress; ?>">
						</dd>
					</dl>

					<p>
						<button type="submit" class="btn btn-block btn-primary">変更する</button>
					</p>
				</form>
			</article>
		</div>
	</div>
</main>
