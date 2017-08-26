<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TempSkKepwakilGub */

$this->title = 'Update Temp Sk Kepwakil Gub: ' . $model->id_temp_sk_kep_wakil_gub;
$this->params['breadcrumbs'][] = ['label' => 'Temp Sk Kepwakil Gubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_temp_sk_kep_wakil_gub, 'url' => ['view', 'id' => $model->id_temp_sk_kep_wakil_gub]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temp-sk-kepwakil-gub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
