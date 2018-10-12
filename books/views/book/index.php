<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'База книг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'author',
            'year',
            'genre',
            ['attribute' => 'image',
            'label' => 'Изображение',
            'format' => 'html',
            'value' => function ($model)
            {
                return Html::img($model->image,
                    ['width' => '150px', 'style' => 'max->width:100%']);
            }],
            'page',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
