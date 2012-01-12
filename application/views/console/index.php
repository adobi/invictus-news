<?php if (!$this->session->userdata('logged_in')): ?>
    <style type="text/css">
        .content {
            margin-top:30px!important;
        }
    </style>
    <p style="margin-bottom:20px;">
        <a class="btn primary" href="<?php echo base_url() ?>auth/login"><i class="arrow-left"></i>Go back</a>
    </p>
<?php endif ?>

<?php if (validation_errors()): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>


<?php echo form_open() ?>
    <legend>Test Console</legend>
    <div class="row">
        <fieldset class="control-group span6">
            <label class="control-label" for="game">Game</label>
            <div class="controls">
                <?php echo form_dropdown('game', $games, $_POST ? $_POST['game'] : '', 'class="chosen input-xlarge" data-placeholder="Choose a game..."') ?>
                    
            </div>
        </fieldset>        
        <fieldset class="control-group span6">
            <label class="control-label" for="platform">Platform</label>
            <div class="controls">
                <?php echo form_dropdown('platform', $platforms, $_POST ? $_POST['platform'] : '', 'class="chosen input-xlarge" data-placeholder="Choose a platform..."') ?>
            </div>
        </fieldset>    
    </div>
    <fieldset class="form-actions">
        <button class="btn primary"> <i class="time"></i>Run query</button> &nbsp; <a class="btn" href="<?php echo base_url() ?>/<?php echo $this->uri->segment(1) ?>">Cancel</a>
    </fieldset>      
<?php echo form_close() ?>

<?php if ($result): ?>

<legend>Requested url</legend>
<pre class="prettyprint">
        <?php echo base_url() ?>api/get_news/<?php echo $_POST['game'] ?>/<?php echo $_POST['platform'] ?>
</pre>

<legend>Result</legend>



<pre class="prettyprint linenums">
<?php echo htmlspecialchars($result) ?>
</pre>
<?php endif ?>