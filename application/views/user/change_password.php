
<?php if (validation_errors()): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>
<?php echo form_open('', array('class'=>'horizontal-form')) ?>
        
	    <legend>Change password</legend>
    
        <fieldset class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
			    <input type="password" name="password" id="password" class="password" />
            </div>
        </fieldset>
        <fieldset class="control-group">
            <label class="control-label" for="password_again">Password again</label>
            <div class="controls">
			    <input type="password" name="password_again" id="password_again" class="password" />
            </div>
        </fieldset>
        <fieldset class="form-actions">
            <input type="submit" value="Change" class="btn primary">
        </fieldset> 

<?php echo form_close() ?>