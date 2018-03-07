<main>
	<div id="signup" class="container">
		<article>
			<h2>新規会員登録</h2>
			<form action="./SignUp/execute" method="post">
				<dl class="row">
					<dt class="col-xs-12">ニックネーム</dt>
					<dd class="col-xs-12"><input class="form-control" type="text" name="name" placeholder="keisuke_tero??" required></dd>
				</dl>

				<dl class="row">
					<dt class="col-xs-12">電話番号</dt>
					<dd class="col-xs-12"><input class="form-control" type="text" name="tel"  placeholder="08012345678" maxlength="11" required></dd>
				</dl>

				<dl class="row">
					<dt class="col-xs-12">メールアドレス</dt>
					<dd class="col-xs-12"><input class="form-control" type="email" name="address" placeholder="keisuke_tero21@gmail.com" required></dd>
				</dl>

				<dl class="row">
					<dt class="col-xs-12">パスワード</dt>
					<dd class="col-xs-12"><input class="form-control" type="password" name="password" placeholder="Password" required></dd>
				</dl>

				<dl class="row">
					<dt class="col-xs-12">パスワード(確認用)</dt>
					<dd class="col-xs-12"><input class="form-control" type="password" name="password_conf" required></dd>
				</dl>
				<div class="row">
					<p class="col-xs-6"><a class="btn btn-block btn-default" href="../">キャンセル</a></p>
					<p class="col-xs-6"><button class="btn btn-block btn-primary" type="submit" data-action="info_conf">確認</button></p>


				</div>
			</form>

			<p class="text-center">アカウントを作成すると、利用規約、およびCookieの使用を含むプライバシーポリシーに同意したことになります。</p>
			<div class="info_conf">
				確認modal
			</div>
		</article>
	</div>
</main>
