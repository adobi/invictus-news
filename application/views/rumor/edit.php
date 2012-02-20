<style type="text/css">
    .label {
        font-size:1.4em
    }
</style>


<?php if (validation_errors() || isset($file_missing)): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
        <?php echo $file_missing; ?>
    </div>
<?php endif ?>

<?php if ($item): ?>
    
    <fieldset class="form-actions right" style="border-bottom:1px solid #ddd;">
        <a href="<?php echo @$_SERVER['HTTP_REFERER'] ?>" class="btn primary" style="float:left;"><i class="arrow-left"></i>Go back</a>

    
        <a class="btn primary" href="<?php echo base_url() ?>rumor/settings/<?php echo $item->id ?>"><i class="cog"></i>Settings</a>
    </fieldset>
<?php endif ?>

<?php echo form_open_multipart('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>
    <fieldset>
        <legend>
            <?php if ($item): ?>
                Edit <?php echo $item->title ?>
            <?php else: ?>
                New rumor
            <?php endif ?>
        </legend>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="title">Title</label>
        <div class="controls">
            <input type="text" name = "title" id = "title" class = "input-xxlarge" value = "<?php echo $_POST ? @$_POST['title'] : ($item ? $item->title : '') ?>" data-countable="1" data-limit="<?php echo TITLE_MAX_LENGTH ?>"/>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="description">Description</label>
        <div class="controls">
            <textarea rows="5" name="description" class="input-xxlarge" data-countable="1" data-limit="<?php echo DESCRIPTION_MAX_LENGTH ?>"><?php echo $_POST ? @$_POST['description'] : ($item ? $item->description : '') ?></textarea>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="available_from">Available from</label>
        <div class="controls">
            <input type="text" name = "available_from" id = "available_from" class = "datepicker input-large" value = "<?php echo $_POST ? @$_POST['available_from'] : ($item ? to_date($item->available_from) : '') ?>"/>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label" for="games[]">Games</label>
        <div class="controls">
            <?php echo form_multiselect('games[]', $games, $_POST ? @$_POST['games'] : ($for_games ? $for_games : ''), 'class="chosen input-xxlarge" data-placeholder="Choose a game..."') ?>
            <p class="item-nav" style="text-align:left;">
                <a href="#" class="chosen-select-all">Select all</a> 
                <a href="#" class="chosen-cancel-all">Cancel all</a>
            </p>                
        </div>
    </fieldset>        
    <fieldset class="control-group">
        <label class="control-label" for="platforms[]">Platforms</label>
        <div class="controls">
            <?php echo form_multiselect('platforms[]', $platforms, $_POST ? @$_POST['platforms'] : ($for_platforms ? $for_platforms : ''), 'class="chosen input-xxlarge" data-placeholder="Choose a platform..."') ?>
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
                            <img src="<?php echo base_url() ?>uploads/original/<?php echo $item->thumbnail ?>" alt=""/>
                        </a>
                    </li>
                </ul>
                <p>
                    <a class="btn" href="<?php echo base_url() ?>rumor/delete_image/<?php echo $item->id ?>"><i class="trash"></i>Delete image</a>
                </p>
            <?php else: ?>
                <input type="file" name = "thumbnail" value = "" />
                <p class="help-block">The size of the image is <span class="label important">50x50</span> for <strong>phones</strong>, <span class="label important">162x162</span> for <strong>tablets</strong>. <span class="label important">We don't resize it!</span></p>

                <p style="margin-top:10px;">
                    <img src="http://placehold.it/50x50" alt="">
                </p>
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
