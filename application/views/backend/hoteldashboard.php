<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="well" style="text-align:center;">
            <p>Welcome
                <?php echo $this->session->userdata('name');?></p>
        </div>

    </div>
    <div class="col-md-4">

    </div>
</div>
<?php
print_r($this->session->all_userdata());
?>