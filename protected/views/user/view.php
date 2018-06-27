<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);


$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type'  =>  'pills',
        'items' =>  array(
            array('label'=>'Manage Users','url'=>array('index')),
            array('label'=>'Create User','url'=>array('create')),
            array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
            array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

        )
    )
);
?>

<h1>User <?php echo $model->login ?> </h1>

<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                       View User Details
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <?php $this->widget('booster.widgets.TbDetailView',array(
                        'data'=>$model,
                        'attributes'=>array(
                            'login',
                            'email',
                            array(
                                'name'  =>  'isAdmin',
                                'label' =>  'Is Admin',
                                'value' =>  $model->isAdmin ? 'Yes' : 'No'
                            ),
                            array(
                                'name'  =>  'enabled',
                                'label' =>  'Account enabled',
                                'value' =>  $model->enabled ? 'Yes' : 'No'
                            )
                        ),
                    )); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Assigned Web Accounts
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                <?php
                    $this->widget('booster.widgets.TbGridView', array(
                        'dataProvider'  =>  new CArrayDataProvider($model->webAccounts),
                        'summaryText'   =>  '',
                        'columns'       =>  array(
                            'title',
                            array(
                                'class' =>  'booster.widgets.TbButtonColumn',
                                'viewButtonUrl'=>'Yii::app()->createUrl("/webAccount/view", array("id" => $data["id"]))',
                                'deleteButtonUrl'=>'Yii::app()->createUrl("/webAccount/delete", array("id" =>  $data["id"]))',
                                'updateButtonUrl'=>'Yii::app()->createUrl("/webAccount/update", array("id" =>  $data["id"]))',
                            )
                        )
                    ));
                ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Assigned Proxy servers
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                <?php
                    $this->widget('booster.widgets.TbGridView', array(
                        'dataProvider'  => new CArrayDataProvider($model->proxies),
                        'summaryText'   => '',
                        'columns'       =>  array(
                            'ip',
                            array(
                                'class' =>  'booster.widgets.TbButtonColumn',
                                'viewButtonUrl'=>'Yii::app()->createUrl("/proxy/view", array("id" => $data["id"]))',
                                'deleteButtonUrl'=>'Yii::app()->createUrl("/proxy/delete", array("id" =>  $data["id"]))',
                                'updateButtonUrl'=>'Yii::app()->createUrl("/proxy/update", array("id" =>  $data["id"]))',
                            )
                        )
                    ));
                ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>

