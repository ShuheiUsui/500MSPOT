<main>
	<main id="manage" class="conteiner">
		<h2>問い合わせ管理</h2>
			<aside class="col-md-3">

			</aside>

			<article class="col-md-9">
<?php if($query->count() != 0){ ?>
				<table>
<?php foreach($query as $q){ ?>
					<tr>
						<td>
<?php switch ($q->state) {
	case 0:
		echo '未対応';
		break;
	case 1:
		echo '対応中';
		break;
	case 2:
		echo '完了';
		break;
}
?>
						</td>
						<td><a href="#" class="btn"><?php echo h($q->title); ?></a></td>
						<td><a href="#" class="btn"><?php echo h($q->user->name); ?></a></td>
						<td><?php $date = new DateTime($q->datetime); echo $date->format('Y-m-d'); ?></td>
					</tr>
<?php } ?>
<?php } //if (count() != 0) ?>
				</table>
		</div>
	</div>
</main>
