
<?php echo form_open() ?>
        
	<fieldset style="margin-top:20px;">
	    <legend>Bejelentkezés</legend>
    
        <?php if (validation_errors()): ?>
            <div class="alert-message block-message error">
                <?php echo validation_errors() ?>
            </div>
        <?php endif ?>
		<div class="clearfix">
			<label>Felhasználónév</label>
			<div class="input">
			  <input type="text" name="username" id="username" class="username" />
			</div>
		</div>		
		<div class="clearfix">
			<label>Jelszó</label>
			<div class="input">
			  <input type="password" name="password" id="password" class="password" />
			</div>
		</div>		
		<div class="actions">
			<input type="submit" value="Belépés" class="btn primary">
		</div>  		
	</fieldset>
<?php echo form_close() ?>