
    <?php echo form_open('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>    
        <legend>CRUD Generator</legend>
     
        <fieldset class="control-group">
            <label class="control-label" for="username">Table name</label>
            <div class="controls">
                prefix <input type="text" name="prefix" class="span1"/>
                name <input type="text" name = "table_name" id = "table_name" class = "xxlarge" value = ""/>
            </div>
        </fieldset>          
        <fieldset class="form-actions">
            <button class="btn primary"><i class="ok"></i>Save</button> &nbsp; <a class="btn" href="<?php echo base_url() ?>/<?php echo $this->uri->segment(1) ?>">Cancel</a>
        </fieldset> 
    <?php echo form_close(); ?>

<script type="text/javascript">
    $(function() {
        $('#sidebar').remove();
        //$('#content').css('margin-top', 0).removeClass('span-20').addClass('span-24')
    })
</script>