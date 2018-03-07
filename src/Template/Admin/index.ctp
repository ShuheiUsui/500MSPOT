<main>
	<div  id="admin" class="container">
		<div class="col-12-md">
			<h2 class="text-center">5OOM SPOT 管理者ログイン</h2>
			<form action="Admin/execute" method="post">
				<dl>
					<dt>管理者ID</dt>
					<dd><input type="text" name="adminID" class="form-control" placeholder="keisuke_tero@spot.com"></dd>
				</dl>
				<dl>
					<dt>パスワード</dt>
					<dd><input type="password" name="password" class="form-control"></dd>
				</dl>

				<div class="execute">
<?php if(isset($_GET['state'])){ ?>
					<p class="msg">
<?php if($_GET['state'] == 1){ ?>
						アドレスとパスワードの組み合わせが一致しません。
<?php }else if($_GET['state'] == 2){ ?>
						アドレスが登録されていません。
<?php } ?>
					</p>
<?php } ?>

					<p class="text-center"><button type="submit" class="btn btn-primary">LOGIN</button></p>
				</div>
			</form>
		</div>
	</div>
</main>
