<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<h1>Добро пожаловать на <?php echo $domain; ?></h1>


<form method="post" action="?r=site/index" >
    <br><input type="text" name="login"> <br>
    <br><input type="text" name="email"><br>
    <br><input type="submit" value="test">
</form>
<?php
var_dump(Yii::$app->request->post());
?>