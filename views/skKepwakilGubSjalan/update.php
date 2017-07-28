<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = 'Update Sk Kepwakil Gub Sjalan: ' . $model->id_sk_kepwakil_gub_sjalan;
$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sk_kepwakil_gub_sjalan, 'url' => ['view', 'id' => $model->id_sk_kepwakil_gub_sjalan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sk-kepwakil-gub-sjalan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
