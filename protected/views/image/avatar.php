<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.Jcrop.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.Jcrop.min.js');
  $cs->registerScriptFile($baseUrl.'/js/avatar.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.Jcrop.min.css');
  Yii::app()->clientScript->registerCoreScript('jquery');
?>
<form id="image-form" enctype="multipart/form-data" method="post" action="<?php $this->createAbsoluteUrl('image/avatar') ?>" onsubmit="return checkForm()">
       <!-- hidden crop params -->
       <input type="hidden" id="x1" name="Image[x1]" />
       <input type="hidden" id="y1" name="Image[y1]" />
       <input type="hidden" id="x2" name="Image[x2]" />
       <input type="hidden" id="y2" name="Image[y2]" />
       <div><?php echo CHtml::activeFileField($model, 'image', array('id'=>"image_file", 'onchange'=>"fileSelectHandler()"))?></div>

       <div class="error"></div>
           <img id="preview" />
               <input type="hidden" id="filesize" name="Image[filesize]" />
               <input type="hidden" id="filetype" name="Image[filetype]" />
               <input type="hidden" id="filedim" name="Image[filedim]" />
               <input type="hidden" id="w" name="Image[w]" />
               <input type="hidden" id="h" name="Image[h]" />
           <input type="submit" value="Upload"  />
</form>