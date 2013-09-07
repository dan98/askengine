<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error'; ?>
<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">Error <?php echo $code; ?></h3>
</div>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>