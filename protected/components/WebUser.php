<?php 
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    const USER_MODER = 1;
    const USER_SIMPLE = 0;
    public function checkAccess($operation, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getState("role");
        if ($role === self::USER_MODER) {
            return true; // admin role has access to everything
        }
        switch($operation){
            case 'mineOnly':
                if($this->id == $params['id']){
                    return true;
                } 
            break;
            case 'iAmTheReceiver':
                $model = Question::model()->findByPk($params['id']);
                if($this->id == $model->to_id){
                    return true;
                }
            break;
        }
        return false;
    }
}