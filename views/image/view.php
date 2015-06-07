<div style="overflow: hidden; position: absolute; width: 90%">
	<div class="wrapper">
		<div id="rd1" style="width: 100px; height: 100px; background-color: gray; position: absolute;">1</div>
		<div id="rd2" style="width: 100px; height: 100px; background-color: gray; position: absolute;">2</div>
		<div id="rd3" style="width: 100px; height: 100px; background-color: gray; position: absolute;">3</div>
		<img src="/assets/upload/<?=$model->picture?>"  style="width: 100%;">
	</div>
</div>
<?php
unset($this->assetBundles['yii\web\JqueryAsset']);

