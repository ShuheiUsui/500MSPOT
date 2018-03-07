<main>
	<div id="article" class="container">
		<article>
			<div class="article_user">
				<div class="user">
					<ul class="list-inline">
						<li class="icon"><a href="./User/?user_id=<?php echo $arts->users['id']; ?>"><?php echo $this->Html->image('user/'.$arts->users['id'].'.jpg', ['alt' => $arts->users['name']]); ?></a></li>
						<li><a href="./User/?user_id=<?php echo $arts->users['id']; ?>"><?php echo $arts->users['name'];?></a></li>
					</ul>
				</div>

				<div>
					<a href="javascript:void(0);" class="btn btn-default" data-action="modal-open"><i class="fa fa-edit"></i></a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<figure>
						<?php echo $this->Html->image('articles/'.$arts->id.'.jpg', ['alt' => 'スポットイメージ']);?>
					</figure>

					<div class="action">
						<p>
							<a href="javascript:void(0);" data-action="good"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
							<a href="javascript:void(0);" ><i class="fa fa-comment-o" aria-hidden="true"></i></a>
						</p>
					</div>

					<div>
						<p>いいね！<?php echo $arts->good; ?>件</p>
					</div>

					<div class="content">
						<p><?php echo $arts->content; ?></p>
					</div>

					<div class="hash">
						<ul class="list-inline">
							<?php foreach (explode(',',$arts->tags) as $tag) { echo '<li><a href="/GitHub/500MSPOT/?tags='.$tag.'">#'.$tag,'</a><li>'; } ?>
						</ul>
					</div>

					<div class="date">
						<p class="text-right"><?php $date = new DateTime($arts->datetime); echo $date->format('Y-m-d'); ?></p>
					</div>

					<div id="map"></div>
				</div>

				<div class="col-md-4">
					<h3 class="text-center"><i class="fa fa-comment-o" aria-hidden="true"></i>コメント<span>(<?php echo $cmtNum; ?>)<span></h3>
					<div class="comments user">
						<ul>
	<?php if($cmtNum > 0){?>
	<? foreach ($comments as $row) { ?>
							<li><a href="./User/?user_id=<?php echo $row->users['id'];?>"><?php echo $this->Html->image('user/'.$row->users['image'], ['alt' => $row->users['name']])?></a><?php echo $row->comment ?></li>
	<?php } ?>
						<!-- debug -->
						<!-- <pre><?php //foreach ($comments as $row) {print_r($row); } ?></pre> -->
	<?php } ?>
						</ul>
						<!-- action="/GitHub/500MSPOT/Articles/Comment" -->
						<form name="comment_form" method="post">
							<input type="hidden" name="article_id" value="<?php echo $arts->id; ?>">
							<p><input type="text" class="form-control" name="comment" placeholder="Comment..." maxlength="100"></p>
							<p><button class="btn btn-block btn-primary" data-action="comment_submit">コメントする</button></p>
						</form>


						<p id="err"></p>

					</div>
				</div>
			</div>

		</article>

		<div id="modal">
			<div class="modal_field sml">
				<ul>
					<li><a href="#" class="btn btn-block">シェア</a></li>
	<?php if(isset($_SESSION['userInfo'])){ // ログイン中に表示 ?>
					<li><a href="#" class="btn btn-block">通報</a></li>
		<?php if($_SESSION['userInfo']['id'] == $arts->user_id){ //自分の投稿の時表示 ?>
					<li><a href="/GitHub/500MSPOT/Post/Edit/?id=<?php echo $arts->id; ?>" class="btn btn-block">編集</a></li>
					<li><a href="#" class="btn btn-block">削除</a></li>
		<?php } ?>
	<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</main>
<script type="text/javascript">
var map = '';

var pos = {
	'lat':<?php echo $arts->lat; ?>,
	'lng':<?php echo $arts->lng; ?>
};

function initMap() {
	this.map = new google.maps.Map(
	document.getElementById('map'), {
		center:this.pos,
		zoom:16
	}
	);
	var marker = new google.maps.Marker({
		position: this.pos,
		map: map,
		title:"Hello!"
	});
}
</script>
<script type="text/javascript" src="js/articles.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfvFL7Rzv0VXf_H1pe39nx3mH0kndb29k&callback=initMap"></script>
