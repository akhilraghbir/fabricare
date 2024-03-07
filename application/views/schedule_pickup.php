<section class="inner-banner schedule-banner">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-white">Schdule Pickup</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="price-list py-5 text-dark">
      <div class="container">
        <nav class="category-items">
          <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
            <?php if(!empty($categories)){ 
              foreach($categories as $category){
            ?>
            <button onclick="getProducts(<?= $category['id']; ?>)" class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
              <img src="<?= base_url($category['category_icon']); ?>" class="list-cat-icon">
              <?= $category['category']; ?>
            </button>
            <?php } } ?>
          </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
          
        </div>
      </div>
    </section>