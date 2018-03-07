<main>
	<div id="post" class="container">
		<article class="row">
			<div class="col-md-12">
				<h2>スポットを投稿する</h2>

				<form action="post/execute" name="post_form" method="post" enctype="multipart/form-data">
					<dl>
						<dt>写真*</dt>
						<dd>
							<input type="file" id="image" name="article_image" required>
							<div id="canvas_wrap"></div>
						</dd>
					</dl>



					<dl>
						<dt>カテゴリー</dt>
						<dd>
							<select name="category" required>
								<option value="">--選択してください--</option>
								<option value="1">グルメ</option>
								<option value="2">ショッピング</option>
								<option value="3">観光</option>
								<option value="4">Other</option>
							</select>
						</dd>
					</dl>

					<dl>
						<dt>コメント</dt>
						<dd><textarea class="form-control" name="content" placeholder="キャプションを書く。"></textarea></dd>
					</dl>

					<dl>
						<dt>タグ*</dt>
						<dd><textarea  class="form-control" name="tags" placeholder="例)新宿 グルメ" required></textarea></dd>
					</dl>

					<dl>
						<dt>位置情報</dt>
						<dd><div id="map" class="map" class="col-md-12"></div></dd>
					</dl>

					<input id="lat" type="hidden" name="lat" value="">
					<input id="lng" type="hidden" name="lng" value="">

					<div class="submit">
						<p class="col-xs-6"><a href="./" class="btn btn-block btn-default" type="button">キャンセル</a></p>
						<p class="col-xs-6"><button class="btn btn-block btn-primary" type="submit">投稿</button></p>
					</div>
				</form>
			</div>
		</article>
	</div>
</main>

<script type="text/javascript" src="js/post.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfvFL7Rzv0VXf_H1pe39nx3mH0kndb29k"></script>
