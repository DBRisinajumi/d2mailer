<?php
    $this->setPageTitle(
        Yii::t('D2mailerModule.model', 'Mllg Mailer Log')
        . ' - '
        . Yii::t('D2mailerModule.crud', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('D2mailerModule.model','Mllg Mailer Logs')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2mailerModule.crud', 'View');
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2mailerModule.crud","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2mailer.MllgMailerLog.*") || Yii::app()->user->checkAccess("D2mailer.MllgMailerLog.View")),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2mailerModule.crud","Back"),
                )
 ),true);
    
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2mailerModule.model','Mllg Mailer Log');?>                <small><?php echo$model->itemLabel?></small>
            </h1>
        </div>
        <div class="btn-group">
            <?php
            
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"=>Yii::t("D2mailerModule.crud","Delete"),
                "type"=>"danger",
                "icon"=>"icon-trash icon-white",
                "size"=>"large",
                "htmlOptions"=> array(
                    "submit"=>array("delete","mllg_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                    "confirm"=>Yii::t("D2mailerModule.crud","Do you want to delete this item?")
                ),
                "visible"=> (Yii::app()->request->getParam("mllg_id")) && (Yii::app()->user->checkAccess("D2mailer.MllgMailerLog.*") || Yii::app()->user->checkAccess("D2mailer.MllgMailerLog.Delete"))
            ));
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span12">
        <h2>
            <?php echo Yii::t('D2mailerModule.crud','Data')?>            <small>
                #<?php echo $model->mllg_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                
                array(
                    'name' => 'mllg_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_id',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_model_name',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_model_name',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_model_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_model_id',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_user_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_user_id',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_datetime',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'datetime',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                            'attribute' => 'mllg_datetime',
                            //'placement' => 'right',
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_to',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_to',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_subject',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_subject',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_text',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'mllg_text',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_text_format',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                            'source' => $model->getEnumFieldLabels('mllg_text_format'),
                            'attribute' => 'mllg_text_format',
                            //'placement' => 'right',
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'mllg_status',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                            'source' => $model->getEnumFieldLabels('mllg_status'),
                            'attribute' => 'mllg_status',
                            //'placement' => 'right',
                        ),
                        true
                    )
                ),
           ),
        )); ?>
    </div>

    </div>
    <div class="row">

    <div class="span12">
        <?php $this->renderPartial('_view-relations_grids',array('modelMain' => $model, 'ajax' => false,)); ?>    </div>
</div>

<?php echo $cancel_buton; ?>