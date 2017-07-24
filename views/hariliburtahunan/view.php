<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Hariliburtahunan */

$this->title = $model->id_hari_libur;
$this->params['breadcrumbs'][] = ['label' => 'Hariliburtahunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hariliburtahunan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_hari_libur], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_hari_libur], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_hari_libur',
            'waktu_hari_libur',
            'ket_hari_libur',
        ],
    ]) ?>

</div>
