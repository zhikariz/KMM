<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempSkKepwakilGub */

$this->title = 'Create Temp Sk Kepwakil Gub';
$this->params['breadcrumbs'][] = ['label' => 'Temp Sk Kepwakil Gubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-sk-kepwakil-gub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
