<main>
	<div id="top" class="container">
	<article class="row">
<?php if(isset($_GET['tags'])){ ?>
	<div class="text-center">
		<h2>#<?php echo h($_GET['tags']); ?></h2>
		<p>投稿数<?php echo $arts->count(); ?>件</p>
	</div>
<?php } ?>

<?php if(isset($_GET['category'])){ ?>
	<div class="text-center index">
		<h2>
<?php
switch ($_GET['category']) {
	case 1:
		echo "グルメ";
		break;
	case 2:
		echo "ショッピング";
		break;
	case 3:
		echo "観光";
		break;
	case 4:
		echo "Other";
		break;
}
 ?>
		</h2>
		<p>投稿数<?php echo $arts->count(); ?>件</p>
	</div>
<?php } ?>

<?php if($popular->count() > 0){ ?>
	<h2>人気な投稿</h2>
	<?php foreach ($popular as $row) { ?>
		<figure class="col-md-3 col-xs-6">
			<a href="Articles?id=<?php echo $row->id ?>" class="spot">
				<?php echo $this->Html->image('articles/'.$row->id.'.jpg', ['alt' => 'スポットイメージ']);?>
				<p class="hover_info">
					<?php echo $row->good; ?> <i class="fa fa-thumbs-o-up"></i>
				</p>
			</a>
		</figure>
	<?php } ?>
<?php } ?>

<?php if($arts->count() > 0){ ?>
	<h2>新着記事</h2>
	<?php foreach ($arts as $row) { ?>
		<figure class="col-md-3 col-xs-6">
			<a href="Articles?id=<?php echo $row->id ?>" class="spot">
				<?php echo $this->Html->image('articles/'.$row->id.'.jpg', ['alt' => 'スポットイメージ']);?>
			</a>
		</figure>
	<?php } ?>
<?php }else{ ?>
		<div class="">
			<h2 class="text-center">お探しのSPOTが見つかりませんでした。</h2>
		</div>
<?php } ?>
	</article>
	</div>
</main>


<script type="text/javascript">
	// $(document).on('mouseover','figure > a',function(){
	// 	$(this).children('.hover_info').fadeIn();
	// });

	// $(document).on('mouseout','figure',function(){
	// 	$(this).children('.hover_info').fadeOut();
	// });
</script>
