<?php /* @var $this Controller */ 
?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid" id="category-content">
    <div class="fluid-row" style="margin: 10px 10px;">
        <div class="span3">
            <div id="category-filter">
            <?php
                $this->model->renderFilter($this->model->id);
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