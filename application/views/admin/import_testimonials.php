<div class="row">
    <div class="large-12 columns">
      <!-- content -->
      <h3>Importing TestimonialS...</h3>
      <hr>
      <?php
      $that=&get_instance();
      $that->load->library('upload');
      $that->load->model('testimonial_model');
      $config['upload_path'] = FCPATH.'csv/'; 
      $config['allowed_types'] = 'csv';
      $config['max_size']=0;
      $that->upload->initialize($config);

      if($that->upload->do_upload('file')){
          $data = $that->upload->data();
        $success_ctr=0;$duplicate_ctr=0;$failed_ctr=0;
        $row = 1;
        if (($handle = fopen($data['full_path'], "r")) !== FALSE) {
            while (($data = fgetcsv($handle,0, ",")) !== FALSE) {
              $cdata['id']=$data[0];
              $cdata['name']=$data[1];
              $cdata['state']=$data[2];
              $cdata['description']=$data[3];
              $cdata['phone']=$data[4];
              $cdata['area_code']=$data[5];
              $cdata['zip_code']=$data[6];
              //New Slug (NewYork)
              $newSlug = str_replace(' ', '', $data[1]);
              $cdata['slug']= ucwords($newSlug);
              //original(new-york)
              //$cdata['slug']=slugify($data[1]);
            if(!$that->testimonial_model->is_exists($cdata['id'])){
              if($that->testimonial_model->insert($cdata)){
                  echo "<strong>(Row: $row) </strong><span  style='color: green'>Success importing: </span>{$cdata['name']}. Slug set to `{$cdata['slug']}`.<br><hr style='margin: 2px'>";
                  $success_ctr++;
              }else{
                  echo "<strong>(Row: $row) </strong><span style='color: #99000'>failed  importing: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
                  $failed_ctr++;
              }
            }else{
              echo "<strong>(Row: $row) </strong><span style='color: blue'>Duplicate Key: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
              $duplicate_ctr++;
            }
              $row++;
            }
            fclose($handle);
          echo "<hr>";
          echo "<strong> ".$success_ctr."</strong> successfull imported records.<br>";
          echo "<strong> ".$duplicate_ctr."</strong> duplicated records.<br>";
          echo "<strong> ".$failed_ctr."</strong> failed importing records.<br>";
        }
      ?>
      <div class="panel">
        Cleaning table records...Removing record with no name... Removing unwanted name like `testimonial`...<br>
        <?php 
          $r = $that->testimonial_model->clean();
          echo "Current Record Count: ".$that->testimonial_model->count();
        ?>
      </div>
      <div class="panel">
        Validating Zipcodes... Concatenating '0' to zip codes with 4 digits...<br>
        <?php 
          $res = $that->testimonial_model->fix();
        ?>
      </div>
      <?php
      } else {
        //error..
        $data = array('error' => $that->upload->display_errors());
        d($data['error']);
      }
      ?>
      </br>