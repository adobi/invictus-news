<fieldset class="round">
    <p>
        <a class="btn primary" href="<?= base_url(); ?>user/edit"><i class="plus"></i>Create new</a>
    </p>
</fieldset>

<?php if ($items): ?>
    <table class="bordered-table striped-table">
        <thead>
            <tr>
                <th class="center">#</th>
                <th>Username</th>
                <th>Role</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($items as $item): ?>
                <tr>
                    <td class="span1 center"><strong><?php echo $i++; ?></strong></td>
                    <td><?php echo $item->username ?></td>
                    <td><?php echo $item->role === '1' ? 'admin' : 'other user' ?></td>
                    <td class="span3 center">
                        <a href="<?php echo base_url() ?>user/edit/<?php echo $item->id ?>" class="btn success"><i class="edit"></i>Edit</a>
                        <a href="<?php echo base_url() ?>user/delete/<?php echo $item->id ?>" class="btn"><i class="trash"></i>Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>