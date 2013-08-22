<?php  
$this->menu=array(
	array('label'=>'Settings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.Jcrop.min.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.Jcrop.min.css');
?>
<form id="image-form" enctype="multipart/form-data" method="post" action="<?php $this->createAbsoluteUrl('image/avatar') ?>" onsubmit="return checkForm()">
       <!-- hidden crop params -->
       <input type="hidden" id="x1" name="Image[x1]" />
       <input type="hidden" id="y1" name="Image[y1]" />
       <input type="hidden" id="x2" name="Image[x2]" />
       <input type="hidden" id="y2" name="Image[y2]" />

       <h2>Step1: Please select image file</h2>
       <div><input type="file" name="Image[file]" id="image_file" onchange="fileSelectHandler()" /></div>

       <div class="error"></div>

       <div class="step2">
           <h2>Step2: Please select a crop region</h2>
           <img id="preview" />

           <div class="info">
               <label>File size</label> <input type="text" id="filesize" name="filesize" />
               <label>Type</label> <input type="text" id="filetype" name="filetype" />
               <label>Image dimension</label> <input type="text" id="filedim" name="filedim" />
               <label>W</label> <input type="text" id="w" name="w" />
               <label>H</label> <input type="text" id="h" name="h" />
           </div>

           <input type="submit" value="Upload" />
       </div>
</form>