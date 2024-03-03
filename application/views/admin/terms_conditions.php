<?php

?>
<div class="col-md-12">
    <div class="">
    <div class="main-card mb-3 card card-body">
        <h5 class="card-title"></h5>
            <?php
            $url = CONFIG_SERVER_ADMIN_ROOT . "cms/terms_conditions";
            echo form_open($url, array('class' => 'terms_conditions', 'id' => 'terms_conditions')); ?>
    
            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group"><label for="terms_conditions" class="">Add Terms and Conditions Content:</label>
                            <textarea name="description_p"><?= $cms_data[0]['description'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="position-relative form-check">
                    <input type='hidden' name="id" value="<?php echo $cms_data[0]['id'] ?>">
                    <input type="submit" name="edit" class="mt-2 btn btn-primary pull-right" value="Save Terms and Conditions">
            </div>
           
        </form>
    </div>
</div>
</div>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'description_p' );
</script>