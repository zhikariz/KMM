<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = $model->id_sk_kepwakil_gub_sjalan;
$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sk-kepwakil-gub-sjalan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_sk_kepwakil_gub_sjalan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_sk_kepwakil_gub_sjalan], [
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
            'id_sk_kepwakil_gub_sjalan',
            'kode_tahun',
            'no_dokumen',
            'kode_jenis_dokumen',
            'perihal',
            'id_user',
            'waktu_input',
            'file_dokumen',
        ],
    ]) ?>

</div>
