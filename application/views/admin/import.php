<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
<body>
	<?php $this->admin_template->phtml('header'); ?>
	<div class="row">
		<div class="large-12 columns">
			<!-- content -->
			
			<div class="section-container vertical-tabs" data-section="vertical-tabs">
			  <section>
			    <p class="title" data-section-title><a href="#">States</a></p>
			    <div class="content" data-section-content>
					<h5>Import CSV Data for States</h5>
					<form action="<?php echo base_url('admin/import/states') ?>" method="post" id="upload-states"  enctype="multipart/form-data">
						<label for="file">Filename:</label>
						<input type="file" name="file" id="file"><br>
						<input type="submit" name="submit" value="Import" class="button tiny">
						<br>
						<div class="progress-bar">
							<label>Uploading...<span class="percentage"></span></label>
							<div class="progress"><span class="meter" style="width: 0%"></span></div>
						</div>
						<div id="status"></div>
					</form>
					<strong>CSV Field Format: </strong>(name, abbr, content)
					<br><br>
					<table width="100%">
						<tr>
							<td><strong>name</strong></td>
							<td>Name of the state</td>
						</tr>
						<tr>
							<td><strong>abbr</strong></td>
							<td>abbreviation of state</td>
						</tr>
						<tr>
							<td><strong>content</strong></td>
							<td>Content of state</td>
						</tr>
						
					</table>
			    </div>
			  </section>
			  <section>
			    <p class="title" data-section-title><a href="#">Cities</a></p>
			    <div class="content" data-section-content>
			      <h5>Import CSV Data for Cities</h5>
			      <form action="<?php echo base_url('admin/import/cities') ?>" id="upload-cities" method="post" enctype="multipart/form-data">
						<label for="file">Filename:</label>
						<input type="file" name="file" id="file"><br>
						<input type="submit" name="submit" value="Import" class="button tiny">
						<br>
						<div class="progress-bar">
							<label>Uploading...<span class="percentage"></span></label>
							<div class="progress"><span class="meter" style="width: 0%"></span></div>
						</div>
						<div id="cities-status"></div>
					</form>
					<strong>CSV Field Format: </strong>(id,name,state,description,phone,area_code,zip_code)
					<br><br>
					<table width="100%">
						<tr>
							<td><strong>id</strong></td>
							<td>must be a blank except on the first row</td>
						</tr>
						<tr>
							<td><strong>name</strong></td>
							<td>Name of city<br> Example: Alabama</td>
						</tr>
						<tr>
							<td><strong>state</strong></td>
							<td>State of the city <br>Example: al for alabama</td>
						</tr>
						<tr>
							<td><strong>description</strong></td>
							<td>the content. can be blank provided the first row is not blank</td>
						</tr>
						<tr>
							<td><strong>phone</strong></td>
							<td>Phone number of city. Numbers are different on every area code. Leave it blank if theres no phone yet. First row cannot be blank</td>
						</tr>
						<tr>
							<td><strong>area_code</strong></td>
							<td>City area code</td>
						</tr>
						<tr>
							<td><strong>zip_code</strong></td>
							<td>city zip code(s)</td>
						</tr>
					</table>
			    </div>
			  </section>
			  <section>
			    <p class="title" data-section-title><a href="#">Phone Number</a></p>
			    <div class="content" data-section-content>
			      	<h5>Import CSV Data for Phone Numbers</h5>
			      	<form action="<?php echo base_url('admin/import/phonenumbers') ?>" method="post" id="upload-phonenumber" enctype="multipart/form-data">
						<label for="file">Filename:</label>
						<input type="file" name="file" id="file"><br>
						<input type="submit" name="submit" value="Import" class="button tiny">
						<br>
						<div class="progress-bar">
							<label>Uploading...<span class="percentage"></span></label>
							<div class="progress"><span class="meter" style="width: 0%"></span></div>
						</div>
						<div id="phonenumber-status"></div>
					</form>
					<strong>CSV Field Format: </strong>(area_code,phone)
					<br><br>
					<table width="100%">
						<tr>
							<td><strong>area_code</strong></td>
							<td></td>
						</tr>
						<tr>
							<td><strong>phone</strong></td>
							<td></td>
						</tr>
						
					</table>
			    </div>
			  </section>
			</div>
			
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
