
<?php if (validation_errors()): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>

<?php if ($item): ?>
    
    <fieldset class="form-actions right" style="border-bottom:1px solid #ddd;">
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn primary" style="float:left;"><i class="arrow-left"></i>Go back</a>
        <?php if ($this->session->userdata('rumor_edited')): ?>
            If you changed the <strong>Games</strong> or <strong>Platforms</strong> values you have to check the &rarr;
            <?php $this->session->unset_userdata('rumor_edited'); ?>
        <?php endif ?>
    
        <a class="btn primary" href="<?php echo base_url() ?>rumor/settings/<?php echo $item->id ?>"><i class="cog"></i>Settings</a>
    </fieldset>
<?php endif ?>

<?php echo form_open_multipart('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>
    <legend>
        <?php if ($item): ?>
            Edit <?php echo $item->title ?>
        <?php else: ?>
            New rumor
        <?php endif ?>
    </legend>
    <fieldset class="control-group">
        <label class="control-label" for="title">Title</label>
        <div class="controls">
            <input type="text" name = "title" id = "title" class = "input-xxlarge" value = "<?php echo $item ? $item->title : '' ?>" data-countable="1" data-limit="<?php echo TITLE_MAX_LENGTH ?>"/>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="description">Description</label>
        <div class="controls">
            <textarea rows="5" name="description" class="input-xxlarge" data-countable="1" data-limit="<?php echo DESCRIPTION_MAX_LENGTH ?>"><?php echo $item ? $item->description : '' ?></textarea>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="games[]">Games</label>
        <div class="controls">
            <?php echo form_multiselect('games[]', $games, $for_games ? $for_games : '', 'class="chosen input-xxlarge" data-placeholder="Choose a game..."') ?>
            <p class="item-nav" style="text-align:left;">
                <a href="#" class="chosen-select-all">Select all</a> 
                <a href="#" class="chosen-cancel-all">Cancel all</a>
            </p>                
        </div>
    </fieldset>        
    <fieldset class="control-group">
        <label class="control-label" for="platforms[]">Platforms</label>
        <div class="controls">
            <?php echo form_multiselect('platforms[]', $platforms, $for_platforms ? $for_platforms : '', 'class="chosen input-xxlarge" data-placeholder="Choose a platform..."') ?>
            <p class="item-nav" style="text-align:left;">
                <a href="#" class="chosen-select-all">Select all</a> 
                <a href="#" class="chosen-cancel-all">Cancel all</a>
            </p>                
        </div>
    </fieldset>        
    <fieldset class="control-group">
        <label class="control-label" for="thumbnail">Thumbnail</label>
        <div class="controls">
            <?php if ($item && $item->thumbnail): ?>
                <ul class="thumbnails">
                    <li>
                        <a href="#" class="thumbnail">
                            <img src="<?php echo base_url() ?>uploads/original/<?php echo $item->thumbnail ?>" alt="" class="thumbnail"/>
                        </a>
                    </li>
                </ul>
                <p>
                    <a class="btn" href="<?php echo base_url() ?>rumor/delete_image/<?php echo $item->id ?>"><i class="trash"></i>Delete image</a>
                </p>
            <?php else: ?>
                <input type="file" name = "thumbnail" value = "" />
            <?php endif ?>
        </div>
    </fieldset>  
    <!-- 
    <fieldset class="control-group">
        <label class="control-label" for="title">Active</label>
        <div class="controls">
            <label class="checkbox inline">
                <input type="radio" value="1" name="active"> Yes
            </label>
            <label class="checkbox inline">
                <input type="radio" value="0" name="active" checked="checked"> No
            </label>
        </div>
    </fieldset>
     -->       
    <fieldset class="form-actions">
        <button class="btn primary"><i class="ok"></i>Save</button> &nbsp; <a class="btn" href="<?php echo base_url() ?>">Cancel</a>
    </fieldset>      
<?php echo form_close() ?>
