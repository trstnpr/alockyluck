<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<?php 

	$items= $this->config_model->get_all(); 
	$dir = directory_map(FCPATH."/application/views/themes/");
	$current_theme = $this->config_model->get('theme');
	foreach($dir as $directory=>$files){
		$themes[$directory]=$directory;
	}
	
?>
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
<body>
	<?php $this->admin_template->phtml('header'); ?>
	
	<div class="row">
		
		<div class="large-12 columns">
			<!-- content -->
			<h4>Configuration Options</h4>
			
			<form action="<?php echo base_url('admin/config') ?>" method="POST" >
				<input type="hidden" name="callback_url" value="<?php echo base_url('admin/config') ?>" />
			 <table style="width: 100%">
			 	<thead>
			 		<tr>
			 			<td>Label</td>
			 			<td>Key</td>
			 			<td>Value</td>
			 		</tr>
			 	</thead>
				<tbody>
					 <?php foreach($items as $key=>$item): ?>
						 	<tr>
					 		<td ><strong><?php echo $item->label ?></strong></td>
					 		<td ><?php echo $item->key ?></td>
					 		<td ><?php
					 			switch($item->input_type){
									case 'text':
										echo form_input('options['.$item->key.'][]',$item->value);
										break;
									case 'textarea':
										echo form_textarea('options['.$item->key.'][]',$item->value);
										break;
									case 'select':
										echo form_dropdown($item->key, $themes, $item->value);
										break;
									
					 			}?></td>
					 	</tr>
					 <?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			 </table>
			 <input type="submit" name="submit" class="button small" value="Save Changes" />
			 </form>
			 
			 <div id="alert-box" style="text-align: center">
				<?php
					
					if($this->session->flashdata('message')){
						echo '<div data-alert class="alert-box">'.$this->session->flashdata('message').'</div>';	
					}
				
				 ?>
			</div>
			
			
			<div class="section-container vertical-tabs" data-section="vertical-tabs" style="display: none">
  <section>
    <p class="title" data-section-title><a href="#">General</a></p>
    <div class="content" data-section-content>
      <p>Content of section 1.</p>
    </div>
  </section>
  <section>
    <p class="title" data-section-title><a href="#">Layout</a></p>
    <div class="content" data-section-content>
      <p>Content of section 2.</p>
    </div>
  </section>
  <section>
    <p class="title" data-section-title><a href="#">SEO Optimization</a></p>
    <div class="content" data-section-content>
      <p>Content of section 3.</p>
    </div>
  </section>
</div>
			<!-- /content-->
		</div>
		
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
