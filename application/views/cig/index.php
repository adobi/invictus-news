<fieldset class="round">
    <?= form_open(); ?>
        <div class="clearfix">
            <label for="title">Table name</label>
            <div class="input">
                prefix <input type="text" name="prefix" class="span1"/>
                name <input type="text" name = "table_name" id = "table_name" class = "xxlarge" value = ""/>
            </div>
        </div>        
        <div class="actions">
            <input type="submit" value="Generate" class="btn primary">
        </div>  
    <?= form_close(); ?>
</fieldset>

<script type="text/javascript">
    $(function() {
        $('#sidebar').remove();
        //$('#content').css('margin-top', 0).removeClass('span-20').addClass('span-24')
    })
</script>