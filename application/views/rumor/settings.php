<style type="text/css">
    .label {
        font-size:1.4em
    }
</style>


<?php if ($rumor): ?>
        <fieldset class="form-actions right" style="border-bottom:1px solid #ddd;">
            <a href="<?php echo @$_SERVER['HTTP_REFERER'] ?>" class="btn primary" style="float:left;"><i class="arrow-left"></i>Go back</a>
            <?php if (!$items): ?>
               <span class="alert-message block-message error">This rumor is not associated with any game or platform, <strong>Edit</strong> first &rarr;</span>
            <?php endif ?>
            <a class="btn success" href="<?php echo base_url() ?>rumor/edit/<?php echo $rumor->id ?>" style=""><i class="edit"></i>Edit</a>
            <?php if ($rumor->active === '1'): ?>
                <a href="<?php echo base_url() ?>rumor/inactivate/<?php echo $rumor->id ?>" class="btn" rel="twipsy" data-title="Inactivate"><i class="refresh"></i>Inactivate</a>
            <?php else: ?>
                <a href="<?php echo base_url() ?>rumor/activate/<?php echo $rumor->id ?>" class="btn" rel="twipsy" data-title="Activate"><i class="refresh"></i>Activate</a>
            <?php endif ?>
        </fieldset>        
        <?php if ($items): ?>
            <h2 style="margin-bottom:20px">
                <?php echo $rumor->title ?> settings
            </h2>
            <?php foreach ($items as $item): ?>
                <?php echo form_open_multipart(base_url().'game_and_platform/edit/'.$item->id.'/#settings_'.$item->id, array('id'=>'settings_'.$item->id, 'class'=>'horizontal-form ')) ?>
                
                    <legend class="<?php echo (!$item->link_text || !$item->link_url || !$item->image) ? 'active-rumor' : 'inactive-rumor' ?>" style="padding-left:5px"><?php echo $item->game ?> <?php echo $item->platform ?></legend>
                    <fieldset class="control-group">
                        <label class="control-label" for="link_text">Link text</label>
                        <div class="controls">
                            <input type="text" name = "link_text" id = "link_text" class = "input-xxlarge" value = "<?php echo $item ? $item->link_text : '' ?>" data-countable="1" data-limit="<?php echo LINK_TEXT_MAX_LENGTH ?>"/>
                        </div>
                    </fieldset>                
                    <fieldset class="control-group">
                        <label class="control-label" for="link_url">Link url</label>
                        <div class="controls">
                            <input type="text" name = "link_url" id = "link_url" class = "input-xxlarge" value = "<?php echo $item ? ($item->link_url ? $item->link_url : '') : '' ?>" placeholder="http://"/>
                            <a href="<?php echo $item->bitly_link ?>" target="_blank">go to link</a>
                            <pre style="margin-top:5px; width:522px;">
<?php echo $item->bitly_link ?>
                            </pre>
                        </div>
                    </fieldset>  
                    <fieldset class="control-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="controls">
                            <?php if ($item && $item->image): ?>
                                <ul class="thumbnails">
                                    <li>
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo base_url() ?>uploads/original/<?php echo $item->image ?>" alt="" />
                                        </a>
                                    </li>
                                </ul>
                                <p>
                                    <a class="btn" href="<?php echo base_url() ?>game_and_platform/delete_image/<?php echo $item->id ?>"><i class="trash"></i>Delete image</a>
                                </p>
                            <?php else: ?>
                                <input type="file" name = "image" value = "" />
                            <?php endif ?>
                            <p class="help-block">The size of the image is <span class="label important">400x400</span> for <strong>phones</strong>, <span class="label important">400x400</span> for <strong>tablets</strong>. <span class="label important">We don't resize it!</span></p>
            
                            
                        </div>
                    </fieldset> 
                    <fieldset class="form-actions">
                        <button class="btn primary"><i class="ok"></i>Save</button> &nbsp; <a class="btn" href="<?php echo base_url() ?>game_and_platform/delete/<?php echo $item->id ?>"><i class="trash"></i>Delete</a>
                    </fieldset>                                              
                <?php echo form_close() ?>    
            <?php endforeach ?>
        <?php endif ?>
<?php else: ?>
    <div class="alert-message block-message error">
       No rumor with this id
    </div>
<?php endif ?>
