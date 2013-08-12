<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">    
        <?php
            if($data->image)
            {
                echo CHtml::image('/avatar-thumb/'.$data->image->image); 
            }
            else
            {
                echo CHtml::image('/avatar-thumb/'.'no_avatar.png', 'title', array('width'=>100, 'height'=>100)); 
            }
        ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('about')); ?>:</b>
	<?php echo CHtml::encode($data->about); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('answers_n')); ?>:</b>
	<?php echo CHtml::encode($data->answers_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('likes_n')); ?>:</b>
	<?php echo CHtml::encode($data->likes_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('followers_n')); ?>:</b>
	<?php echo CHtml::encode($data->followers_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anonym_questions')); ?>:</b>
	<?php echo CHtml::encode($data->anonym_questions); ?>
	<br />

	*/ ?>

</div>