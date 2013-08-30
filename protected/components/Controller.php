<?php

class Controller extends CController{

    public $layout = 'column1';
    public $breadcrumbs;
    public $pageTitle;

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function render($view, $data = null) {
        if (isset($_SERVER['HTTP_X_PJAX'])) {
            echo "<title>{$this->pageTitle}</title>";
            $this->renderPartial($view, $data);
        }
        else
            parent::render($view, $data);
    }

    
    public function filterMineOnly($filterChain){
            if(!Yii::app()->user->checkAccess('mineOnly', array('id' => $_GET['id'])))
                throw new CHttpException(403,'Cant perform this action.');
            $filterChain->run();
    }
    public function filterAllowAnonym($filterChain){
        if(isset($_POST['Question'])){
            $user = User::model()->findByPk($_POST['Question']['to_id']);

            if(empty($user))
                throw new CHttpException(403,'Unexistent user.');

            if($user->anonym_questions == 0 && $_POST['Question']['anonym'] != 0)
               throw new CHttpException(403,'This user doesnt accept anonym questions.');
        }
        $filterChain->run();
    }
    public function filterIAmTheReceiver($filterChain){
        if(!Yii::app()->user->checkAccess('iAmTheReceiver', array('id' => $_GET['id'])))
            throw new CHttpException(403,'Cant perform this action.');
        $filterChain->run();
    }

} 