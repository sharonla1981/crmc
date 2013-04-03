<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-32">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-12" style="text-align: right;">
	<div id="sidebar">
           
	<?php
		//request type widget menu
		$this->widget('application.components.ButtonFilter', array(
			'items'=>$this->menu2,
			'itemCssClass'=>'selectable',
                        'filterGroupName'=>'requestType',
                        'fkField'=>'type_id',
                        'inline'=>true,
                        'selectionType'=>'radio',
		));
                
                //department widget menu
		$this->widget('application.components.ButtonFilter', array(
			'items'=>$this->menu,
			'itemCssClass'=>'selectable',
                        'filterGroupName'=>'Department',
                        'fkField'=>'dpt_id',
                        'inline'=>true,
                        'selectionType'=>'multi',
		));
		
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
<style>
    li.selected {
        background-color: orange;
    }
    .selectable { list-style-type: none; margin: 0; padding: 0; width: 40%;}
    .selectable { margin: 3px; padding: 0.4em; font-size: 1.0em; height: 14px; border: 1px solid #999999}
    
</style>