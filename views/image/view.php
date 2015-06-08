<div style="overflow: hidden; width: 90%">
	<div class="wrapper">
		<img src="/assets/upload/<?=$model->picture?>"  style="max-width: 100%;"><br>
		<div id="rd3" style="width: 100px; height: 100px; background-color: gray; float: left; position: relative;">3 <a href="javascript:" class="remove">remove</a></div>
		<div id="rd2" style="width: 100px; height: 100px; background-color: gray; float: left; position: relative;">2 <a href="javascript:" class="remove">remove</a></div>
		<div id="rd1" style="width: 100px; height: 100px; background-color: gray; float: left; position: relative;">1 <a href="javascript:" class="remove">remove</a> </div>
	</div>
</div>
<div style="clear: both;"></div>
<button id="saveblocks" style="position: absolute;" data-id="<?=$model->id_image?>">Сохранить</button>