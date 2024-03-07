<section class="addresses-page">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <h4 class="page-title py-4 text-center">Manage Addresses</h4>
            </div>
            
                <div class="col-md-4">
                  <div class="card shadow-sm">
                    <div class="card-body add_address">
                       <a href="<?= base_url('add-address'); ?>"> <i class="fa fa-plus"></i> </a>
                    </div>
                  </div>
                </div>
             
            <?php if(!empty($addresses)){ 
                foreach($addresses as $address){
            ?>
            <div class="col-md-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="media">
                    <img src="<?= base_url(); ?>assets/frontend/images/location.png" class="mr-3" alt="addresses">
                    <div class="media-body">
                      <h6 class="mb-0 font-weight-bold"><?= $address['address_title'];?></h6>
                      <p class="mb-0 address-line"><?= $address['name'];?>, <?= $address['phone_number'];?></p>
                      <p class="mb-0 address-line"><?= $address['email_address'];?></p>
                      <p class="mb-0 address-line"><?= $address['address1'];?> <?= $address['address2'];?></p>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?= base_url('edit-address/'.$address['id']);?>" class="mr-4"><i class="bi bi-pencil-square"></i> Edit</a>
                  <a href="<?= base_url('delete-address/'.$address['id']);?>"><i class="bi bi-trash"></i> Delete</a>
                </div>
              </div>
            </div>
            <?php } }?>
           
          </div>
        </div>
      </section>
    </main>