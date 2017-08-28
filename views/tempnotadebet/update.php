<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TempNotaDebet */

$this->title = 'Update Temp Nota Debet: ' . $model->id_temp_nota_debet;
$this->params['breadcrumbs'][] = ['label' => 'Temp Nota Debets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_temp_nota_debet, 'url' => ['view', 'id' => $model->id_temp_nota_debet]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temp-nota-debet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
