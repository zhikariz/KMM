<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Petunjuk */

$this->title = 'Update Petunjuk: ' . $model->id_petunjuk;
$this->params['breadcrumbs'][] = ['label' => 'Petunjuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_petunjuk, 'url' => ['view', 'id' => $model->id_petunjuk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="petunjuk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
