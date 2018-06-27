<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
    <script src="/apanel/js/jquery.js"></script>
    <script src="/apanel/js/site.js"></script>
	<!-- blueprint CSS framework -->
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/screen.css" media="screen, projection" />-->
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />-->
<!--	<![endif]-->

<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/main.css" />-->
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/form.css" />-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="container">
        <div id="header">
            <?php
                $this->widget(
                    'booster.widgets.TbNavbar',
                    array(
                        'brand' => 'Anonymizer',
                        'fixed' => false,
                        'fluid' => true,
                        'items' => array(
                            array(
                                'class' => 'booster.widgets.TbMenu',
                                'type' => 'navbar',
                                'items' => array(
                                    array('label'=>'Users', 'url'=>array('/user/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Web Account Categories', 'url'=>array('/WebAccountCategory/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Web Accounts', 'url'=>array('/webAccount/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Proxies', 'url'=>array('/proxy/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Scripts', 'url'=>array('/script/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Blocked and Shortcuts', 'url'=>array('/blockedUrl/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Scheduling', 'url'=>array('/schedule/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Logs', 'url'=>array('/log/index'), 'visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                )
                            )
                        )
                    )
                );
            ?>
        </div>

    </div>
    <div class="container">
        <?php echo $content; ?>
    </div>
</body>
</html>
