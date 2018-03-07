<main>
	<div id="user_page" class="container">
	<div class="row">
		<aside class="col-md-3">
			<div class="user_info">
				<div class="user_image">
					<?php echo $this->Html->image('user/'.$user->id.'.jpg', ['alt' => $user->name.'のイメージ']);?>
				</div>

				<p><?php echo $user->name; ?></p>

				<p><?php echo $user->description; ?></p>

<?php if($login['flg']){ ?>
	<?php if($login['user']['id'] != $user->id){ ?>
		<?php if(!$follow){ ?>
				<p>
					<a href="javascript:void(0);" class="btn btn-primary btn-block" data-action="follow">フォローする</a>
				</p>
		<?php }else{ ?>
				<p>
					<a href="javascript:void(0);" class="btn btn-warning btn-block" data-action="quit_follow">フォロー解除</a>
				</p>
		<?php } ?>
				<form name="follow">
					<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
				</form>
	<?php } ?>
<?php } ?>

			</div>

			<ul class="follows">
				<li>フォロー<?php echo $followings->count(); ?></li>
				<li>フォロワー<?php echo $followers->count(); ?></li>
				<li>いいね</li>
			</ul>
		</aside>

		<article class="col-md-9">
<?php foreach($arts as $art){ ?>
			<figure class="col-md-4">
				<?php echo $this->Html->image('articles/'.$art->id.'.jpg', ['alt' => $art->tags.'のイメージ']);?>

			</figure>
 <? } ?>
		</article>
	</div>
	<p id="err"></p>
	</div>
</main>
<script src="/GitHub/500MSPOT/js/user.js"></script>
