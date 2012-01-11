
<?php if ($items): ?>

<ul class="thumbnails" style="margin-top:20px;">
    <?php foreach ($items as $item): ?>
        
        <li class="span4">
            <div class="thumbnail">
                <div class="caption">
                    <h5><?php echo $item->name ?></h5>
                </div>
            </div>
        </li>
    <?php endforeach ?>
</ul>    
<?php endif ?>