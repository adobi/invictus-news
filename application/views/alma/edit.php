
<p><a href="<?php echo base_url() ?><?php echo $this->uri->segment(1) ?>" class="btn primary"><i class="arrow-left"></i>Go back</a></p>

<?php if (validation_errors()): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>

<?php echo form_open('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>    

    <legend>
        <?php if ($item): ?>
            Edit
        <?php else: ?>
            New
        <?php endif ?>
    </legend>    
        <fieldset class="control-group">
            <label for="name">Name</label>
            <div class="controls">
                <input type="text" name = "name" id = "name" class = "input-xxlarge" value = "<?php echo $_POST && isset($_POST['name']) ? $_POST['name'] : ($item ? $item->name : '') ?>"/>
            </div>
        </fieldset>  
        <fieldset class="control-group">
            <label for="email">Email</label>
            <div class="controls">
                <input type="text" name = "email" id = "email" class = "input-xxlarge" value = "<?php echo $_POST && isset($_POST['email']) ? $_POST['email'] : ($item ? $item->email : '') ?>"/>
            </div>
        </fieldset>  
        <fieldset class="control-group">
            <label for="description">Description</label>
            <div class="controls">
                <textarea rows="5" name="description" id = "description" class="input-xxlarge"><?php echo $_POST && isset($_POST['description']) ? $_POST['description'] : ($item ? $item->description : '') ?></textarea>
            </div>
        </fieldset>      <fieldset class="form-actions">
        <button class="btn primary"><i class="ok"></i>Save</button> &nbsp; <a class="btn" href="<?php echo base_url() ?>/<?php echo $this->uri->segment(1) ?>">Cancel</a>
    </fieldset>    
<?php echo form_close() ?>
