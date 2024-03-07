<?php 
if(is_array($productServices) && count($productServices)){
    foreach($productServices as $pservices){
?>
<div class="row row_<?= $pservices['id']; ?>">
    <div class="col-md-4">
        <div class="form-group">
            <label>Select Service<span class="text-danger"> *</span></label>
            <select name="service_id[]" id="service_id" class="form-control">
                <option value="">Select Service</option>
                <?php if(is_array($services) && count($services)>0){ 
                    foreach($services as $service){
                ?>
                    <option value="<?= $service['id'];?>" <?= ($service['id']==$pservices['service_id']) ? 'selected' : ''; ?>><?= $service['service_name'];?></option>
                <?php } } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Enter Price<span class="text-danger"> *</span></label>
            <input type="text" class="form-control Onlynumbers" name="price[]" placeholder="Enter Price" value="<?= $pservices['price']; ?>" maxlenght="5">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mt-4">
            <button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(<?= $pservices['id']; ?>)"><i class="ri-delete-bin-fill"></i></button>
        </div>
    </div>
</div>
<?php } }else{ ?>
<div class="row row_<?= $attr_id; ?>">
    <div class="col-md-4">
        <div class="form-group">
            <label>Select Service<span class="text-danger"> *</span></label>
            <select name="service_id[]" id="service_id" class="form-control">
                <option value="">Select Service</option>
                <?php if(is_array($services) && count($services)>0){ 
                    foreach($services as $service){
                ?>
                    <option value="<?= $service['id'];?>"><?= $service['service_name'];?></option>
                <?php } } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Enter Price<span class="text-danger"> *</span></label>
            <input type="text" class="form-control Onlynumbers" name="price[]" placeholder="Enter Price" maxlenght="5">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mt-4">
            <button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(<?= $attr_id;?>)"><i class="ri-delete-bin-fill"></i></button>
        </div>
    </div>
</div>
<?php } ?>