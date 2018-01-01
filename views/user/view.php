<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "Detail User ".$model->id_user;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="user-view">
  <?php foreach (Yii::$app->session->getAllFlashes() as $message) {
      echo SweetAlert::widget([
          'options' => [
              'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
              'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
              'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
              'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
              'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true,
          ]
      ]);
  }?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_user], [
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
            'id_user',
            'username',
            'password',
            'nama_user',
            'authKey',
            'accessToken',
            'id_role',
            [
              'attribute'=>'photo_user',
              'format'=>'html',
              'value'=>function($data,$row) use ($model){
                echo '<img src="uploads/image/'.$model->photo_user.'" height=500px/>';
              }
            ],
        ],
    ]) ?>

</div>
