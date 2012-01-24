
<?php if (validation_errors()): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>

<?php echo form_open('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>    
    <legend>
        <?php if ($item): ?>
            Edit user
        <?php else: ?>
            New user
        <?php endif ?>
    </legend>
    <fieldset class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls">
            <input type="text" name = "username" id = "username" class = "input-xxlarge" value = "<?php echo $item ? $item->username : '' ?>"/>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="password" name = "password" id = "password" class = "input-xxlarge" value = ""/>
        </div>
    </fieldset> 
    <fieldset class="control-group">
        <label class="control-label" for="role">Role</label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name = "role" value = "1" <?php echo $item && $item->role === '1' ? 'checked="checked"' : '' ?>/> <span>administrator</span>
            </label>
            <label class="radio">
                <input type="radio" name = "role" value = "2" <?php echo $item &&  $item->role === '2' ? 'checked="checked"' : '' ?>/> <span>user</span>
            </label>
        </div>
    </fieldset>  
    <fieldset class="control-group">
        <label class="control-label" for="games[]">Game</label>
        <div class="controls">
            <?php echo form_multiselect('games[]', $games, $usergames ? $usergames : '', 'class="chosen input-xxlarge" data-placeholder="Choose a game..."') ?>
            <p class="item-nav" style="text-align:left;">
                <a href="#" class="chosen-select-all">select all</a> 
                <a href="#" class="chosen-cancel-all">cancel all</a>
            </p> 
            <?php if ($item && !$usergames): ?>
                <div class="alert-message block-message success" style="width:510px;">All games are available for <strong><?php echo $item->username ?></strong></div>
            <?php endif ?>               
        </div>
    </fieldset>                      
    <fieldset class="form-actions">
        <button class="btn primary"><i class="ok"></i>Save</button> &nbsp; <a class="btn" href="<?php echo base_url() ?>/<?php echo $this->uri->segment(1) ?>">Cancel</a>
    </fieldset>    
<?php echo form_close() ?>
