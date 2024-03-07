<?php 
if(isset($address)){
    $data = $address[0];
    $url = base_url('edit-address/'.$data['id']);
}else{
    $address = [];
    $url = base_url('add-address');
}
?>
<section class="addresses-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title py-4 text-center">Add Addresses</div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="add-edit-address mt-3 mb-5">
                    <?php
                    if ($this->session->flashdata('emsg')) {
                    ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('emsg'); ?>
                        </div>
                    <?php } ?>
                    <form action="<?= $url; ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Address Title:</label>
                                    <input type="text" class="form-control " name="address_title" value="<?= (!empty($data['address_title']))  ? $data['address_title'] : '';?>"  placeholder="Address Title" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Name:</label>
                                    <input type="text" class="form-control " name="name" placeholder="Name"  value="<?= (!empty($data['address_title']))  ? $data['name'] : '';?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Phone Number:</label>
                                    <input type="text" class="form-control numberOnly" maxlength="10" name="phone_number" placeholder="Mobile Number"  value="<?= (!empty($data['address_title']))  ? $data['phone_number'] : '';?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Email Address:</label>
                                    <input type="text" class="form-control email" name="email_address" placeholder="Email Address"  value="<?= (!empty($data['address_title']))  ? $data['email_address'] : '';?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Address Line 1:</label>
                                    <input type="text" class="form-control " name="address1" placeholder="Address Line 1"  value="<?= (!empty($data['address_title']))  ? $data['address1'] : '';?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Address Line 2:</label>
                                    <input type="text" class="form-control " name="address2" placeholder="Address Line 2" value="<?= (!empty($data['address_title']))  ? $data['address2'] : '';?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Pincode:</label>
                                    <select name="pincode" class="form-control">
                                        <option value="">Select Pincode</option>
                                        <?php 
                                        foreach($pincodes as $pincode){
                                        ?>
                                        <option value="<?= $pincode['id'];?>" <?= (!empty($data['pincode']) && $data['pincode']==$pincode['id']) ? 'selected' : ''; ?>><?= $pincode['zipcode'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-theme rounded-pill px-4" name="submit" value="Save Address">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>