<?php

class WebAccountController extends Controller {
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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'error'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'list'),
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
       $model = new WebAccount;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

       if (isset($_POST['WebAccount'])) {
            $blockedUrls = array();    
            if (isset($_POST['WebAccount']['blocked'])) $blockedUrls = array_merge($blockedUrls, $_POST['WebAccount']['blocked']);
            if (isset($_POST['WebAccount']['favourites'])) $blockedUrls = array_merge($blockedUrls, $_POST['WebAccount']['favourites']);
            if (isset($_POST['WebAccount']['clipboard'])) $blockedUrls = array_merge($blockedUrls, $_POST['WebAccount']['clipboard']);
            
            $model->attributes = $_POST['WebAccount'];
            $model->account = User::model()->findByAttributes(array('login'=>Yii::app()->user->id))->account;
            //$model->blockedUrls = isset($_POST['WebAccount']['blockedUrls']) ? $_POST['WebAccount']['blockedUrls'] : '';
             //$model->blockedUrls = array();            
            $model->blockedUrls = $blockedUrls;

            if ($model->saveWithRelated(array('blockedUrls'))) 
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['WebAccount'])) {
            $model->attributes = $_POST['WebAccount'];
        $blockedUrls = array();
	    if (isset($_POST['WebAccount']['blocked'])) $blockedUrls = array_merge($blockedUrls, $_POST['WebAccount']['blocked']);
        if (isset($_POST['WebAccount']['favourites'])) $blockedUrls = array_merge($blockedUrls, $_POST['WebAccount']['favourites']);
        if (isset($_POST['WebAccount']['clipboard'])) $blockedUrls = array_merge($blockedUrls, $_POST['WebAccount']['clipboard']);

	    if (!isset($blockedUrls)) {
		  $c = Yii::app()->db->createCommand("DELETE FROM blocked_urls_for_webaccounts WHERE webaccountID = $model->id");
		  $c->execute();
	    } 
        $model->blockedUrls = $blockedUrls;
        if ($model->saveWithRelated(array('blockedUrls')))
            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
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
        // we only allow deletion via POST request
            $this->loadModel($id)->delete();

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
        
        // $dataProvider = new CActiveDataProvider('WebAccount');
        // $this->render('index', array(
        // 'dataProvider' => $dataProvider,
        // ));
        
        $this->redirect($this->createUrl('webAccount/admin'));
    }

    public function SendMail($username, $password)
    {   
        Yii::import('ext.yii-mail.YiiMailMessage');
        $message = new YiiMailMessage;
        $message->setBody('Message content here with HTML', 'text/html');
        $message->subject = 'Schedule Alarm';
        $message->addTo('liu.yunfei678@gmail.com');
        $message->from = Yii::app()->params['adminEmail'];
       
        Yii::app()->mail->transportOptions['host'] = "smtp.gmail.com";
        Yii::app()->mail->transportOptions['username'] = $username;
        Yii::app()->mail->transportOptions['password'] = $password;
        Yii::app()->mail->transportOptions['port'] = "465";
        Yii::app()->mail->transportOptions['encryption'] = "ssl";
        Yii::app()->mail->send($message);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new WebAccount('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['WebAccount']))
            $model->attributes = $_GET['WebAccount'];

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
        $model = WebAccount::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'web-account-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    // AJAX request
    public function actionList() {

        $out = '<option value="" selected="selected"></option>';
        if (isset($_POST['script'])) {
            $id = (int)$_POST['script'];
            $proxy = Proxy::model()->getNonScriptProxies($id);
            foreach ($proxy as $id => $adr) {
                $out .= '<option value="'.$id.'">'.$adr.'</option>';
            }
        }

        echo $out;
    }


}
