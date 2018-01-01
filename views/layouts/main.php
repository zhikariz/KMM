<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Jenisdokumen;
use yii\helpers\Url;
use app\models\TempAdm;
use app\models\TempSkKepwakilGub;
use app\models\TempSuratJalan;
use app\models\TempNotaDebet;
use app\models\TempDokumenMasuk;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <link rel="stylesheet" href="dist/css/font.css">
  <link href='<?= Yii::$app->request->baseUrl?>/dist/img/bi.ico' rel='SHORTCUT ICON'/>
    <?php $this->head() ?>
    <style media="screen">
    .dropdown-submenu {
position: relative;
}

.dropdown-submenu>.dropdown-menu {
top: 0;
left: 100%;
margin-top: -6px;
margin-left: -1px;
-webkit-border-radius: 0 6px 6px 6px;
-moz-border-radius: 0 6px 6px;
border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
display: block;
}

.dropdown-submenu>a:after {
display: block;
content: " ";
float: right;
width: 0;
height: 0;
border-color: transparent;
border-style: solid;
border-width: 5px 0 5px 5px;
border-left-color: #ccc;
margin-top: 5px;
margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
border-left-color: #fff;
}
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
  <?php $this->beginBody() ?>

<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <?= Html::a('<b>Bank Indonesia</b>', Yii::getAlias('@web'), ['data-pjax'=>0, 'class'=>'navbar-brand', 'title'=>Yii::t('app', 'Home')])?>

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
            if(Yii::$app->user->identity->role->ket_role=='Administrator' || Yii::$app->user->identity->role->ket_role=='Operator' || Yii::$app->user->identity->role->ket_role=='Approval'){
            ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dokumen Masuk <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php foreach($this->params['data2'] as $index2){
                  ?>
                  <li><?=Html::a($index2['ket_sifat_dokumen'], ['dokumenmasuk/index','sifat'=>$index2['kode_sifat_dokumen']], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Satuan Kerja')])?></li>
                  <?php
                }?>
              </ul>
            </li>


              <?php }
              if(Yii::$app->user->identity->role->ket_role=='Administrator'){
              ?>


              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Approval Dokumen Masuk <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <?php foreach($this->params['data2'] as $index2){
                    ?>
                    <li>
                      <?=Html::a($index2['ket_sifat_dokumen'].' <span class="label label-info">'.TempDokumenMasuk::find()
                      ->where(['kode_sifat_dokumen'=>$index2['kode_sifat_dokumen']])->count().'</span>', ['tempdokumenmasuk/index','sifat'=>$index2['kode_sifat_dokumen']], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Satuan Kerja')])?></li>
                    <?php
                  }?>
                </ul>
              </li>
              <?php }?>
          </ul>

        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php if(Yii::$app->user->identity->role->ket_role == 'Administrator'){?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Management <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?=Html::a('Unit Kerja', ['unitkerja/index'], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Unit Kerja')])?></li>
                <li><?=Html::a('Sifat Dokumen', ['sifatdokumen/index'], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Sifat Dokumen')])?></li>
                <li><?=Html::a('Pejabat', ['pejabat/index'], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Pejabat')])?></li>
                <li><?=Html::a('Petunjuk / Disposisi', ['petunjuk/index'], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Petunjuk / Disposisi')])?></li>
                <li><?=Html::a('User', ['user/index'], ['data-pjax'=>0, 'title'=>Yii::t('app', 'User')])?></li>
                <li><?=Html::a('Hari Libur', ['hariliburtahunan/index'], ['data-pjax'=>0, 'title'=>Yii::t('app', 'Hari Libur')])?></li>
              </ul>
            </li>
            <?php }?>




            <!-- Messages: style can be found in dropdown.less-->

            <!-- /.messages-menu -->

            <!-- Notifications Menu -->

            <!-- Tasks Menu -->
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="uploads/image/<?= Yii::$app->user->identity->photo_user?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?=Yii::$app->user->identity->username?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="uploads/image/<?= Yii::$app->user->identity->photo_user?>" class="img-circle" alt="User Image">

                  <p>
                    <?=Yii::$app->user->identity->nama_user?>

                    <small><?=Yii::$app->user->identity->role->ket_role?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <?=Html::a('Reset Password',['site/change'],['class'=>'btn btn-default btn-flat'])?>
                  </div>
                  <div class="pull-right">
                  <?php $a=Yii::$app->user->isGuest;
                    if($a==1){
                      echo Html::a('Login',['site/login'],['class'=>'btn btn-default btn-flat']);
                       }else{
                      echo Html::beginForm(['site/logout'], 'post');
                  echo Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',['class' => 'btn btn-default btn-flat']);
                  echo Html::endForm();
                }?>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">

      <section class="content-header">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
      </section>
      <br>

      <!-- Main content -->
      <section class="content">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><?= $this->title?></h3>
          </div>
          <div class="box-body">
            <?=$content;?>
          </div>
        </div>
      </section>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <div id="clock"></div>
        <p style="font-size: 12px;
	margin-left: 2px;
	margin-right: 2px;">Made with <i class="icon ion-heart"></i></p>
      </div>
                          <img src="<?=Yii::$app->request->baseUrl?>/dist/img/bi.png" width="3%" height="auto">&nbsp;<strong>Copyright &copy; 2017 <a href="https://www.facebook.com/zhikariz">Helmi Adi Prasetyo</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script type="text/javascript">
<!--
function showTime() {
    var a_p = "";
    var today = new Date();
    var curr_hour = today.getHours();
    var curr_minute = today.getMinutes();
    var curr_second = today.getSeconds();
    if (curr_hour < 12) {
        a_p = "AM";
    } else {
        a_p = "PM";
    }
    if (curr_hour == 0) {
        curr_hour = 12;
    }
    if (curr_hour > 12) {
        curr_hour = curr_hour - 12;
    }
    curr_hour = checkTime(curr_hour);
    curr_minute = checkTime(curr_minute);
    curr_second = checkTime(curr_second);
 document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
setInterval(showTime, 500);
//-->
</script>
