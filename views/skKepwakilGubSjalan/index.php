<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SkKepwakilGubSjalanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sk Kepwakil Gub Sjalans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sk-kepwakil-gub-sjalan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sk Kepwakil Gub Sjalan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sk_kepwakil_gub_sjalan',
            'kode_tahun',
            'no_dokumen',
            'kode_jenis_dokumen',
            'perihal',
            // 'id_user',
            // 'waktu_input',
            // 'file_dokumen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
