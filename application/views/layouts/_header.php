<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" style="overflow: hidden_">
    <head>
    	<title>Invictus News</title>
        <meta charset="utf-8">
        
        <link rel = "stylesheet" href="<?= base_url() ?>css/bootstrap2.min.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>css/aristo.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>css/page.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/file-upload/jquery.fileupload-ui.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/colorpicker/farbtastic.css" media="all" />
        
        <script src = "http://code.jquery.com/jquery-1.7.min.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-dropdown.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-tab.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-transition.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-alert.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-modal.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-twipsy.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-popover.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-alert.js"></script>
        
    	<script src="<?php echo base_url() ?>scripts/plugins/redactor/js/redactor/redactor.js"></script>
    	<link rel="stylesheet" href="<?php echo base_url() ?>scripts/plugins/redactor/js/redactor/css/redactor.css" />        
    
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/fancybox/jquery.fancybox.css" media="all" />
    	<script src="<?php echo base_url() ?>scripts/plugins/fancybox/jquery.fancybox.pack.js"></script>
    	
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/chosen/chosen.css" media="all" />
    	<script src="<?php echo base_url() ?>scripts/plugins/chosen/chosen.jquery.min.js"></script>
    	
    	
    </head>
    
    <body>    
        
    <div id="fb-root"></div>	
    
    <?php if ($this->session->userdata('logged_in')): ?>
        <div class="navbar navbar-fixed">
          <div class="navbar-inner">
            <div class="container">
              <a href="<?php echo  base_url() ?>" class="brand">Invictus News</a>
              <ul class="nav">
                  <li <?php echo $this->uri->segment(1) === 'rumor' && $this->uri->segment(2) === 'edit' ? 'class="active"' : '' ?>><a href="<?php echo base_url() ?>rumor/edit"><i class=" w new-rumor"></i>Create rumor</a></li>
                  <li <?php echo $this->uri->segment(1) === 'platform' ? 'class="active"' : '' ?>><a href="<?php echo base_url() ?>platform">Platforms</a></li>
                  <li <?php echo $this->uri->segment(1) === 'game' ? 'class="active"' : '' ?>><a href="<?php echo base_url() ?>game">Games</a></li>
                  <li <?php echo $this->uri->segment(1) === 'user' ? 'class="active"' : '' ?>><a href="<?php echo base_url() ?>user">Users</a></li>
              </ul>
              <div class="pull-right">
                  <ul class="nav">
                      <li><a href="<?php echo base_url() ?>user/change_password"><i class="w cog-w"></i>Settings</a></li>
                      <li><a href="<?php echo base_url() ?>auth/logout" style="font-weight:bold"><i class="w off-w"></i>Logout</a></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>    
    <?php endif ?>    
    <div class="container" id="top">
    	<div class="content" style="margin-top:70px;">

                
