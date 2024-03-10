<section class="addresses-page">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <h4 class="page-title py-4 text-center">Manage Addresses</h4>
            </div>
            
                <div class="col-md-4">
                  <div class="card shadow-sm mb-3 new-address bg-dark-subtle">
                    <div class="card-body d-flex justify-content-center align-items-center">
                       <a href="<?= base_url('add-address'); ?>" class="stretched-link text-theme-dark2 h2"> <i class="bi bi-plus-circle-dotted"></i> </a>
                    </div>
                  </div>
                </div>
             
            <?php if(!empty($addresses)){ 
                foreach($addresses as $address){
            ?>
            <div class="col-md-4">
              <div class="card shadow-sm mb-3">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <img src="<?= base_url(); ?>assets/frontend/images/location.png" width="30px" alt="addresses">
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h6 class="mb-0 font-weight-bold"><?= $address['address_title'];?></h6>
                      <p class="mb-0 address-line"><?= $address['name'];?>, <?= $address['phone_number'];?></p>
                      <p class="mb-0 address-line"><?= $address['email_address'];?></p>
                      <p class="mb-0 address-line"><?= $address['address1'];?> <?= $address['address2'];?></p>
                    </div>
                  </div>
                </div>
                <div class="card-footer ">
                  <a href="<?= base_url('edit-address/'.$address['id']);?>" class="mr-4 btn btn-theme rounded-pill px-3"><i class="bi bi-pencil-square"></i> Edit</a>
                  <a href="<?= base_url('delete-address/'.$address['id']);?>" class="rounded-pill px-3 btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
                </div>
              </div>
            </div>
            <?php } }?>
           
          </div>
        </div>
      </section>
    </main>