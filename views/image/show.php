<div style="overflow: hidden; width: 100%">
	<div class="wrapper">
		<img src="/image/preview/<?=$model->id_image?>" style="max-width: 100%;" usemap="#blocks">
	</div>
</div>

<?php
	if(json_decode($model->blocks)){

		$blocks = json_decode($model->blocks)->blocks;
?>

<map name="blocks">
<?php
		foreach ($blocks as $key => $block) {
			$x1 = $block->x;
			$y1 = $block->y;
			$x2 = $block->x + $block->width;
			$y2 = $block->y + $block->height;
			echo "<area shape=rect coords='$x1, $y1, $x2, $y2' href='javascript:getprompt({$block->id})'>";
		}
?>
</map>
<?php
	}
?>
