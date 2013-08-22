<?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
	<div class="flash-error"> <?php echo $message ?> </div>
<?php endforeach; ?>		

	<?php foreach ($providers as $provider => $settings): ?>
		<?php if($settings['enabled'] == true): ?> 
				<a id="hybridauth-<?php echo $provider ?>" class="hybridauth-provider" href="<?php echo $baseUrl?>/default/login/?provider=<?php echo $provider ?>" >
					<?php echo $provider ?>
				</a>
		<?php endif; ?>
	<?php endforeach; ?>