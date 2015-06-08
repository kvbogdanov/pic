<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Picture blocks',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            /*
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);*/
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        </div>
    </footer>

<?php $this->endBody() ?>
<script>
    var img_src;
    $(function() {
        img_src = src = $('img').attr('src');

        $( "#rd1, #rd2, #rd3" ).draggable().resizable();
        $(".remove").click(function(){$(this).parent().remove();});
        $("#saveblocks").click(function(){
            var ipos = $('img').position(),
                result = {
                    width: $('img').width(),
                    height: $('img').height(),
                    blocks: []
                };

                if($('#rd1').length > 0)
                    result.blocks.push({
                            id: 1,
                            x: $('#rd1').position().left - ipos.left,
                            y: $('#rd1').position().top - ipos.top,
                            width: $('#rd1').width(),
                            height: $('#rd1').height()
                        });

                if($('#rd2').length > 0)
                    result.blocks.push({
                            id: 2,
                            x: $('#rd2').position().left - ipos.left,
                            y: $('#rd2').position().top - ipos.top,
                            width: $('#rd2').width(),
                            height: $('#rd2').height()
                        });

                if($('#rd3').length > 0)
                    result.blocks.push({
                            id: 3,
                            x: $('#rd3').position().left - ipos.left,
                            y: $('#rd3').position().top - ipos.top,
                            width: $('#rd3').width(),
                            height: $('#rd3').height()
                        });

                console.log(JSON.stringify(result));

                $.ajax({
                    type: "POST",
                    url: "/image/update",
                    data: {id: $('#saveblocks').attr('data-id'), info: JSON.stringify(result)},
                    success: function(data){
                        console.log(data);
                    }
                })

        });
    });


    function getParameterByName(url, name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    var num_blocks = [];

    function getprompt(block){
        var block = prompt("Введите номер блока", "Номер");

        if (block != null) {
            num_blocks.push(block);
            var src = img_src + '?b='+num_blocks.join("_");
            $('img').attr('src',src);
        }
    }
</script>
</body>
</html>
<?php $this->endPage() ?>
