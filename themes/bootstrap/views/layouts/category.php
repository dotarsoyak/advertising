<?php /* @var $this Controller */ 
?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid" id="category-content">
    <div class="fluid-row" style="margin: 10px 0px;">
        <div class="span3">
            <div id="category-filter">
            <?php
                $condition = null;
                Yii::app()->filtro->renderFilter('category', 'view', 'category_id', $this->model->id, $condition);
            ?>
            </div><!-- sidebar -->
        </div>
        <div class="span9">
            <div id="content">
                <?php echo $content; ?>
            </div><!-- content -->
        </div>
    </div>
</div>
<?php $this->endContent(); ?>