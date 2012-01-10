
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
                    <p style="height:120px;margin-top:10px;">
                        <?php if (strlen($item->description) >= 250): ?>
                            <?php echo substr($item->description, 0, 250) ?>... <a href="#rumor_<?php echo $item->id ?>" data-toggle="modal"><i class="arrow-right"></i></a>
                        <?php else: ?>
                            <?php echo $item->description ?>
                        <?php endif ?>
                        
                    </p>
                    
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
                </div>
            </div>
        </li>
    <?php endforeach ?>
</ul>    
<?php endif ?>
