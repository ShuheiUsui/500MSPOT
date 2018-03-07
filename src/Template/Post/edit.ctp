<main id="post_edit" class="container">
	<article class="row">
		<div class="col-md-12">
			<h2>投稿の編集</h2>

			<form action="/GitHub/500MSPOT/Post/EditExecute" name="post_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $art->id; ?>">
				<dl>
					<dt>写真*</dt>
					<dd>
						<div id="canvas_wrap"></div>
						<?php echo $this->Html->image('articles/'.$art->id.'.jpg', ['alt' => 'スポットイメージ']);?>
					</dd>
				</dl>

				<dl>
					<dt>コメント</dt>
					<dd><textarea class="form-control" name="comment" placeholder="キャプションを書く。"><?php echo str_replace("\n", '<br>', $art->content); ?></textarea></dd>
				</dl>

				<dl>
					<dt>タグ*</dt>
					<dd><textarea  class="form-control" name="tags" placeholder="例)新宿 グルメ" required><?php echo str_replace(',', ' ', $art->tags); ?></textarea></dd>
				</dl>

				<dl class="map">
					<div id="map" class="col-md-12"></div>
				</dl>

				<div class="submit">
					<p class="col-xs-6"><a href="./" class="btn btn-block btn-default" type="button">キャンセル</a></p>
					<p class="col-xs-6"><button class="btn btn-block btn-primary" type="submit">変更</button></p>
				</div>
			</form>
		</div>
	</article>
</main>

<script type="text/javascript">
var map = '';

var pos = {
	'lat':<?php echo $art->lat; ?>,
	'lng':<?php echo $art->lng; ?>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfvFL7Rzv0VXf_H1pe39nx3mH0kndb29k&callback=initMap"></script>
