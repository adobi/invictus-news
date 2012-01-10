
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
            <label class="control-label" for="name">Name</label>
            <div class="controls">
                <input type="text" name = "name" id = "name" class = "input-xxlarge" value = "<?php echo $item ? $item->name : '' ?>"/>
            </div>
        </fieldset>
        <fieldset class="form-actions">
            <input type="submit" value="Save" class="btn primary"> &nbsp; <a class="btn" href="<?php echo base_url() ?>">Cancel</a>
        </fieldset>             
    <?php echo form_close() ?>
