<?php if ($rumor): ?>
    
        <?php if ($items): ?>
            <p style="text-align:right;">
                <a class="btn success" href="<?php echo base_url() ?>rumor/edit/<?php echo $rumor->id ?>" style=""><i class="edit"></i>Edit</a>
            </p>
            <h2 style="margin-bottom:20px">
                <?php echo $rumor->title ?> settings
            </h2>
            <?php foreach ($items as $item): ?>
                <?php echo form_open_multipart(base_url().'game_and_platform/edit/'.$item->id.'/#settings_'.$item->id, array('id'=>'settings_'.$item->id, 'class'=>'horizontal-form')) ?>
                    <legend><?php echo $item->game ?> <?php echo $item->platform ?></legend>
                    <fieldset class="control-group">
                        <label class="control-label" for="link_text">Link text</label>
                        <div class="controls">
                            <input type="text" name = "link_text" id = "link_text" class = "input-xxlarge" value = "<?php echo $item ? $item->link_text : '' ?>"/>
                        </div>
                    </fieldset>                
                    <fieldset class="control-group">
                        <label class="control-label" for="link_url">Link url</label>
                        <div class="controls">
                            <input type="text" name = "link_url" id = "link_url" class = "input-xxlarge" value = "<?php echo $item ? ($item->link_url ? $item->link_url : 'http://') : '' ?>"/>
                            <?php if ($item && $item->link_url): ?>
                                <a href="<?php echo $item->link_url ?>" target="_blank">Open link &rarr;</a>
                            <?php endif ?>
                        </div>
                    </fieldset>  
                    <fieldset class="control-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="controls">
                            <?php if ($item && $item->image): ?>
                                <ul class="thumbnails">
                                    <li>
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo base_url() ?>uploads/original/<?php echo $item->image ?>" alt="" class="thumbnail"/>
                                        </a>
                                    </li>
                                </ul>
                                <p>
                                    <a class="btn" href="<?php echo base_url() ?>game_and_platform/delete_image/<?php echo $item->id ?>"><i class="trash"></i>Delete image</a>
                                </p>
                            <?php else: ?>
                                <input type="file" name = "image" value = "" />
                            <?php endif ?>
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
