<main>
	<div  id="login" class="container">
		<article class="row">
			<div class="col-md-12">

			<h2 class="text-center">500M SPOTにログイン</h2>

			<form action="login/execute" method="post">
				<dl>
					<dt>MailAddress</dt>
					<dd><input class="form-control" type="text" name="mailaddress" placeholder="MailAddress" required></dd>
				</dl>

				<dl>
					<dt>Password</dt>
					<dd><input class="form-control" type="password" name="password" placeholder="Password" required></dd>
				</dl>

	<?php if(isset($_GET['state'])){ ?>
				<p class="msg">
	<?php if($_GET['state'] == 1){ ?>
					アドレスとパスワードの組み合わせが一致しません。
	<?php }else if($_GET['state'] == 2){ ?>
					アドレスが登録されていません。
	<?php } ?>
				</p>
	<?php } ?>
				<div class="text-center">
					<p><button class="btn btn-block btn-primary" type="submit">LOGIN</button></p>
					<p><label><input type="checkbox" name="auto" value="true">保存する</label></p>
					<p><a class="btn" href="#">パスワードを忘れた場合</a></p>
				</div>

				<div class="text-center">
					<p>アカウントをお持ちでないですか？<a href="./SignUp">登録する</a></p>
				</div>

			</form>
			</div>
		</article>
	</div>
</main>
