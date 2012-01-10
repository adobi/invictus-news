<fieldset class="round">
    <legend></legend>
    <p>
        <a class="btn primary" href="<?= base_url(); ?>%%CONTROLLER%%/edit">Create new</a>
    </p>
</fieldset>

<?php if ($items): ?>
    <?php foreach ($items as $item): ?>
        <div class="span16">
            <p class="items-nav">
                
                <a href="<?php echo base_url() ?>%%CONTROLLER%%/edit/<?php echo $item->id ?>" class="btn primary">edit</a>
                <a href="<?php echo base_url() ?>%%CONTROLLER%%/delete/<?php echo $item->id ?>" class="btn danger">delete</a>
            </p>
        </div>
    <?php endforeach ?>
<?php endif ?>