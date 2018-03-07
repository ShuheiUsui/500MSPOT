<main>
	<div id="inquiry_details" class="container">
		<h1>InquiryDetail</h1>
		<div class="info_content">
			<h1><?php echo $info['title']; ?></h1>
			<p><?php echo $info['content']; ?></p>
		</div>

		<div class="info_state">
			<dl>
				<dt>ユーザ</dt>
				<dd><?php echo $info['userName']; ?></dd>
			</dl>
			<dl>
				<dt>投稿時間</dt>
				<dd><?php echo $info['datetime']; ?></dd>
			</dl>
			<dl>
				<dt>対応状況</dt>
				<dd><?php echo $info['state']; ?></dd>
			</dl>
			<dl>
				<dt>対応担当</dt>
				<dd><?php echo $info['adminName']; ?></dd>
			</dl>
		</div>
	</div>
</main>
