<h1 style="margin-bottom:15px;">Recent news</h1>

<?php echo form_open('', array('id'=>'edit-form', 'class'=>'horizontal-form')) ?>
        <fieldset>
            
        <legend style="background:#f5f5f5; padding:17px 20px 18px; border-top:1px solid #ddd; border-bottom:1px solid #ddd;">
            Filter news
            <p class="pull-left" style="position:relative; top:0px;margin-right:10px;">
                <a href="#" rel = "twipsy" data-title="Toggle options" class="news-filter-options btn"><i style="margin-right:0px;" class="arrow-<?php echo ($_POST) ? 'up' : 'down' ?>"></i></a>
            </p>
        </legend>
        </fieldset>
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
    <ul class="thumbnails" style="margin-top:20px;">
        <?php foreach ($items as $item): ?>
            
            <li class="span4 <?php echo $item->active === '1' ? 'inactive-rumor' : 'active-rumor' ?>">
                <div class="thumbnail">
                    <p class="right">
                        <?php if ($item->active === '1'): ?>
                            <a href="<?php echo base_url() ?>rumor/inactivate/<?php echo $item->id ?>" class="btn" rel="twipsy" data-title="Inactivate"><i class="refresh"></i>Inactivate</a>
                        <?php else: ?>
                            <a href="<?php echo base_url() ?>rumor/activate/<?php echo $item->id ?>" class="btn" rel="twipsy" data-title="Activate"><i class="refresh"></i>Activate</a>
                        <?php endif ?>
                    </p>
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
                                <a style="position:relative;top:-2px;" href="#" rel="popover" data-original-title="Games and Platforms" data-content="<?php echo $gp ?>"><i class="arrow-right"></i></a>
                            <?php else: ?>
                                &nbsp;
                            <?php endif ?>
                        </h6>
                        <p style="height:120px;margin-top:10px;word-wrap:break-word">
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
                        <p class="item-nav">
                            <a href="<?php echo base_url() ?>rumor/settings/<?php echo $item->id ?>" class="btn primary"><i class="cog"></i>Settings</a>
                            <a href="<?php echo base_url() ?>rumor/edit/<?php echo $item->id ?>" class="btn success"><i class="edit"></i>Edit</a>
                            <a href="<?php echo base_url() ?>rumor/delete/<?php echo $item->id ?>" class="btn"><i class="trash"></i>Delete</a>
                        </p>
                         -->
                        <div style="margin: 10px auto 0; width:150px;">
                            <div class="btn-group" style="display:inline-block; margin:0 auto;">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="list"></i>Select something <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() ?>rumor/duplicate/<?php echo $item->id ?>"><i class="share"></i>Duplicate</a></li>
                                    <li><a href="<?php echo base_url() ?>rumor/settings/<?php echo $item->id ?>"><i class="cog"></i>Settings</a></li>
                                    <li><a href="<?php echo base_url() ?>rumor/edit/<?php echo $item->id ?>"><i class="edit"></i>Edit</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo base_url() ?>rumor/delete/<?php echo $item->id ?>"><i class="trash"></i>Delete</a></li>
                                </ul>
                            </div>                            
                        </div>                            

                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>    
    <?php echo $pagination_links ?>
<?php endif ?>
