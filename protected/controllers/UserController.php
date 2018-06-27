<?php

class UserController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
//            array('allow', // allow all users to perform 'index' and 'view' actions
//                'actions' => array('index', 'view'),
//                'users' => array('*'),
//            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->scenario = "createUser";
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->proxies = isset($_POST["User"]['proxies']) ? $_POST["User"]['proxies'] : '' ;
            $model->webAccounts = isset($_POST["User"]['webAccounts']) ? $_POST["User"]['webAccounts'] : '';

            $model->account = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;

            if ($model->saveWithRelated(array('proxies', 'webAccounts')))
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);        

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

	    $proxies = isset($_POST['User']['proxies']) ? $_POST["User"]['proxies'] : null;
	    $webAccounts = isset($_POST['User']['webAccounts']) ? $_POST["User"]['webAccounts'] : null;
	    if (isset($proxies))
		  $model->proxies = $proxies ;
	    else {
    		$c = Yii::app()->db->createCommand("DELETE FROM proxies_for_users WHERE userID = $model->id");
    		$c->execute();
	    }
	    if (isset($webAccounts))
		  $model->webAccounts = $webAccounts;
	    else {
    		$c = Yii::app()->db->createCommand("DELETE FROM webaccounts_for_users WHERE userID = $model->id");
    		$c->execute();
	    }

	    if (isset($model->password) && strlen($model->password) > 0) {
            $model->createGUID();
            $model->password = "";
	    }

            $model->webAccounts = $webAccounts;

            if ($model->saveWithRelated(array('proxies', 'webAccounts')))
                $this->redirect(array('view', 'id' => $model->id));
        }

        $accountUser = User::model()->findByAttributes(array('login'=>Yii::app()->user->id));
        $users = User::model()->findByPk($id);

         $flag = 2;
        if (($accountUser->id == $users->id) && ($accountUser->isAccount == 1)) {
            $flag = 0;
        } else {
            if (($accountUser->id == $users->id) && ($users->isAdmin == 1)) {
                $flag = 1;
            } elseif ($users->isAccount == 1 && ($accountUser->account == $users->account)) {
                $flag = 0;
            }                
        }

        $this->render('update', array(
            'editable'  => $flag,
            'model' => $model,
        ));                  
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {

            $accountUser = User::model()->findByAttributes(array('login'=>Yii::app()->user->id));
            $users = User::model()->findByPk($id);

            if (($accountUser->id == $users->id) && ($accountUser->isAccount == 1)) {
                throw new CHttpException(400, 'You cannot remove the their account');
            } else {
                if (($accountUser->id == $users->id) && ($users->isAdmin == 1)) {
                    throw new CHttpException(400, 'You cannot remove the their account');
                } elseif ($users->isAccount == 1 && ($accountUser->account == $users->account)) {
                    throw new CHttpException(400, 'You cannot remove the super account of their group');
                }                
            }

        // we only allow deletion via POST request
            //$this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect($this->createUrl('user/admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];      

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->with('proxies', 'webAccounts')->findByPk($id);
        if (is_null($model->proxies)) {
            $model['proxies'] = array();
        }
        if (is_null($model->webAccounts)) {
            $model['webAccounts'] = array();
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
