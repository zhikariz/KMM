<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
$this->title = $name;
$this->params['data2'] = Sifatdokumen::find()->orderBy(['kode_sifat_dokumen'=>SORT_DESC])->all();
?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Halaman Web Tidak Ditemukan !!!
    </p>
    <p>
        Silahkan Kontak Administrator Mengenai Kesalahan Ini !!! <br>Terimakasih
    </p>

</div>
