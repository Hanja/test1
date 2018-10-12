<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = 'Внесение изменений: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'База книг', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
