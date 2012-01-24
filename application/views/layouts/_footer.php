            </div> <!-- /content -->   

        
        </div> <!-- /container -->
            
		<script type="text/javascript" src = "<?php echo base_url() ?>scripts/page.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">
		    var App = App || {};
			App.URL = "<?php echo base_url() ?>";

		</script>     

        <div id="loading-global">Working...</div>		
        
        <?php if ($this->session->flashdata('message')): ?>
            <script type="text/javascript">
                $(function() {
                    App.showNotification("<?php echo $this->session->flashdata("message") ?>")
                });
            </script>
        <?php endif ?>
		  		
    </body>
</html>