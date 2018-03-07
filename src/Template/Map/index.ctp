<main>
	<div id="near" class="container">
		<div class="row">
			<div class="col-md-9 map">
				<div id="map">

				</div>
			</div>

			<div class="col-md-3 arts_wrapper">
				<form name="search">
					<h3 class="text-center">スポットを絞り込む</h3>

					<dl>
						<dt>キーワード</dt>
						<dt>
							<input type="text" class="form-control" name="tag" placeholder="#Tag">
						</dt>
					</dl>

					<dl>
						<dt>カテゴリ</dt>
						<dt>
							<select name="category">
								<option value="0" selected>--選択してください。--</option>
								<option value="1">グルメ</option>
								<option value="2">ショッピング</option>
								<option value="3">観光</option>
								<option value="4">Other</option>
							</select>
						</dt>
					</dl>

					<dl>
						<dt>範囲</dt>
						<dt>
							<select name="length">
								<option value="5" selected>500m</option>
								<option value="4">400m</option>
								<option value="3">300m</option>
								<option value="2">200m</option>
								<option value="1">100m</option>
							</select>
						</dt>
					</dl>

					<dl>
						<dt>投稿日</dt>
						<dt>
							<select name="postingDate">
								<option value="0" selected>--選択してください。--</option>
								<option value="7">7日前</option>
								<option value="14">14日前</option>
								<option value="30">30日前</option>
								<option value="60">60日前</option>
							</select>
						</dt>
					</dl>

					<p class="button">
						<a href="javascript:void(0);" type="button" data-action="search" class="btn btn-block btn-primary">検索</a>
					</p>

				</form>
			</div>
		</div>
	</div>
</main>
<script src="/Spot/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfvFL7Rzv0VXf_H1pe39nx3mH0kndb29k"></script>
