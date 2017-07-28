<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkKepwakilGubSjalan */

$this->title = 'Create Sk Kepwakil Gub Sjalan';
$this->params['breadcrumbs'][] = ['label' => 'Sk Kepwakil Gub Sjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sk-kepwakil-gub-sjalan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
