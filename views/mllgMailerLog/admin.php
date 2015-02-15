<?php
$this->setPageTitle(
    Yii::t('D2mailerModule.model', 'Mllg Mailer Logs')
    . ' - '
    . Yii::t('D2mailerModule.crud', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2mailerModule.model', 'Mllg Mailer Logs');

?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
             'label'=>Yii::t('D2mailerModule.crud','Create'),
             'icon'=>'icon-plus',
             'size'=>'large',
             'type'=>'success',
             'url'=>array('create'),
             'visible'=>(Yii::app()->user->checkAccess('D2mailer.MllgMailerLog.*') || Yii::app()->user->checkAccess('D2mailer.MllgMailerLog.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2mailerModule.model', 'Mllg Mailer Logs');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('MllgMailerLog.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'mllg-mailer-log-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        #'responsiveTable' => true,
        'template' => '{summary}{pager}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                //varchar(50)
                'name' => 'mllg_model_name',
            ),
            array(
                'name' => 'mllg_model_id',
                'htmlOptions' => array(
                    'class' => 'numeric-column',
                ),
            ),
            array(
                'name' => 'user_full_name',
            ),
            array(
                'name' => 'mllg_datetime',
            ),
            array(
                //varchar(256)
                'name' => 'mllg_to',
            ),
            array(
                'name' => 'mllg_subject',
            ),
            array(
                'type' => 'html',
                'name' => 'mllg_text',
            ),
            /*
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'mllg_text_format',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('/d2mailer/mllgMailerLog/editableSaver'),
                        'source' => $model->getEnumFieldLabels('mllg_text_format'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('mllg_text_format'),
                ),
             * 
             */
            array(
                    'name' => 'mllg_status',
                   'filter' => $model->getEnumFieldLabels('mllg_status'),
                ),


            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2mailer.MllgMailerLog.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("mllg_id" => $data->mllg_id))',
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   

            ),
        )
    )
);
?>
<?php Yii::endProfile('MllgMailerLog.view.grid'); ?>