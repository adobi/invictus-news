
<?php echo form_open('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>

        <legend>
            
            Filter news
            <p class="pull-right" style="position:relative; top:15px;">
                <a href="#" class="news-filter-options"><i class="arrow-<?php echo ($_POST) ? 'up' : 'down' ?>"></i></a>
            </p>
        </legend>
        <fieldset class="control-group" <?php echo ($_POST) ? '' : ' style="display:none"' ?>>
            <label class="control-label" for="games[]">Games</label>
            <div class="controls">
                <?php echo form_multiselect('games[]', $games, $_POST ? @$_POST['games'] : '', 'class="chosen input-xxlarge" data-placeholder="Choose a game..."') ?>
                <p class="item-nav" style="text-align:left;">
                    <a href="#" class="chosen-select-all">Select all</a> 
                    <a href="#" class="chosen-cancel-all">Cancel all</a>
                </p>                
            </div>
        </fieldset>
        <fieldset class="control-group" <?php echo ($_POST) ? '' : ' style="display:none"' ?>>
            <label class="control-label" for="platforms[]">Platforms</label>
            <div class="controls">
                <?php echo form_multiselect('platforms[]', $platforms, $_POST ? @$_POST['platforms'] : '', 'class="chosen input-xxlarge" data-placeholder="Choose a platform..."') ?>
                <p class="item-nav" style="text-align:left;">
                    <a href="#" class="chosen-select-all">Select all</a> 
                    <a href="#" class="chosen-cancel-all">Cancel all</a>
                </p>                
            </div>
        </fieldset> 
        <fieldset class="form-actions" <?php echo ($_POST) ? '' : ' style="display:none"' ?>>
            <input type="submit" value="Filter" class="btn primary"> &nbsp; <a class="btn" href="<?php echo base_url() ?>">Cancel</a>
        </fieldset>      

<?php echo form_close() ?>

<?php if ($items): ?>
    <h1>Recent news</h1>
    <ul class="thumbnails" style="margin-top:20px;">
        <?php foreach ($items as $item): ?>
            
            <li class="span4">
                <div class="thumbnail">
                    <img class="rumor-image" src="<?php echo base_url() ?>uploads/original/<?php echo $item->thumbnail ?>" alt="">
                    <div class="caption">
                        <h5><?php echo $item->title ?></h5>
                        <h6><?php echo $item->created ?></h6>
                        <h6 style="margin-top:10px;">
                            <?php if ($item->games || $item->platforms): ?>
                                    
                                games and platforms
                                <?php 
                                    $gp = '';
                                    //$gp = '<div class="row">';
                                    if ($item->games) {
                                        $gp .= "<h5>Games</h5>"
                                                .'<ol><li>' . implode('</li><li>', explode(',', rtrim($item->games, ', '))) . '</li></ol>';
                                    }
                                    if ($item->platforms) {
                                        $gp .= "<h5>Platforms</h5>"
                                                .'<ol><li>' . implode('</li><li>', explode(',', rtrim($item->platforms, ', '))) . '</li></ol>';
                                    }
                                    //$gp .="</div>";
                                ?>
                                <a href="#" rel="popover" data-original-title="Games and Platforms" data-content="<?php echo $gp ?>"><i class="arrow-right"></i></a>
                            <?php else: ?>
                                &nbsp;
                            <?php endif ?>
                        </h6>
                        <p style="height:120px;margin-top:10px;">
                            <?php if (strlen($item->description) >= 250): ?>
                                <?php echo substr($item->description, 0, 250) ?>... <a href="#rumor_<?php echo $item->id ?>" rel="popover" data-title="<?php echo $item->title ?>" data-content="<?php echo $item->description ?>" _data-toggle="modal"><i class="arrow-right"></i></a>
                            <?php else: ?>
                                <?php echo $item->description ?>
                            <?php endif ?>
                            
                        </p>
                        <!-- 
                        <div class="modal fade hide" id = "rumor_<?php echo $item->id ?>">
                            <div class="modal-header">
                                <a href="#" class="close" data-dismiss="modal">×</a>
                                <h3><?php echo $item->title ?> (<?php echo $item->id ?>)</h3>
                            </div>
                            <div class="modal-body">
                                <p><?php echo $item->description ?></p>
                            </div>
    
                        </div>                        
                         -->
                        <p class="item-nav">
                            <a href="<?php echo base_url() ?>rumor/settings/<?php echo $item->id ?>" class="btn primary"><i class="cog"></i>Settings</a>
                            <a href="<?php echo base_url() ?>rumor/edit/<?php echo $item->id ?>" class="btn success"><i class="edit"></i>Edit</a>
                            <a href="<?php echo base_url() ?>rumor/delete/<?php echo $item->id ?>" class="btn"><i class="trash"></i>Delete</a>
                        </p>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>    
<?php endif ?>
