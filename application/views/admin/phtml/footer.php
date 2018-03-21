<footer class="" style="font-size: width: 100%; background: #F5F5F5; border-top: 1px solid #DDD; margin: 10px 0 0 0; padding: 10px;" >
	<div class="row">
		<div class="large-6 columns">
		<small>&copy; Copyright 2013.</small>
		</div>
		<div class="large-6 columns">
		</div>
	</div>
</footer>

<?php $this->admin_template->block('footer_scripts') ?>

<script>
$(document).ready(function(){
  $(".del-all-records").click(function(e){
    if (!confirm("Do you want to delete all records?")){
      return false;
      e.preventDefault();
    }
  });
});
</script>
  <script src="<?php echo $this->app->admin_theme_uri('js/jquery.form.js'); ?>"></script>
<script>
	$(function() {
	var progressbar = $("#upload-states .progress-bar");
	var bar = progressbar.find('.meter');
	var percent = progressbar.find('.percentage');
	var status = $('#upload-states #status');
	
	$('#upload-states').ajaxForm({
	    beforeSend: function() {
        	status.empty();
	        var percentVal = '0%';
	        
	        bar.width(percentVal)
	        percent.html(percentVal);
	    },
	    uploadProgress: function(event, position, total, percentComplete) {
	        var percentVal = percentComplete + "%";
	        bar.width(percentVal);
	        percent.html(percentVal);
	    },
	    complete: function(xhr) {
	        status.html(xhr.responseText);
	    }
	}); 
	});
	
	$(function() {
	var progressbar = $("#upload-cities .progress-bar");
	var bar = progressbar.find('.meter');
	var percent = progressbar.find('.percentage');
	var status = $('#cities-status');
	
	$('#upload-cities').ajaxForm({
	    beforeSend: function() {
        	status.empty();
	        var percentVal = '0%';
	        
	        bar.width(percentVal)
	        percent.html(percentVal);
	    },
	    uploadProgress: function(event, position, total, percentComplete) {
	        var percentVal = percentComplete + "%";
	        bar.width(percentVal);
	        percent.html(percentVal);
	    },
	    complete: function(xhr) {
	        status.html(xhr.responseText);
	    }
	}); 
	});
	
	$(function() {
	var progressbar = $("#upload-phonenumber .progress-bar");
	var bar = progressbar.find('.meter');
	var percent = progressbar.find('.percentage');
	var status = $('#phonenumber-status');
	
	$('#upload-phonenumber').ajaxForm({
	    beforeSend: function() {
        	status.empty();
	        var percentVal = '0%';
	        
	        bar.width(percentVal)
	        percent.html(percentVal);
	    },
	    uploadProgress: function(event, position, total, percentComplete) {
	        var percentVal = percentComplete + "%";
	        bar.width(percentVal);
	        percent.html(percentVal);
	    },
	    complete: function(xhr) {
	        status.html(xhr.responseText);
	    }
	}); 
	});
</script>