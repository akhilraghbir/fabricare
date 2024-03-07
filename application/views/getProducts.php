<div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <div class="row">
    <div class="col-md-3 left-nav">
      <nav class="sub-category">
        <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
        <button onclick="showProducts(0)"  class="category_tab_0 category_tabs nav-link">
            All
          </button>
        <?php 
        if(!empty($categories)){ 
            foreach($categories as $category){
        ?>
          <button onclick="showProducts(<?= $category['id'] ?>)" class=" category_tab<?= $category['id']; ?> category_tabs nav-link">
            <?= $category['category'];?>
          </button>
        <?php } } ?>
        </div>
      </nav>
    </div>
    <div class="col-md-9">
        <div class="main-products-list">
        <?php if(!empty($products)){
            foreach($products as $product){
            $productService = $services[$product['id']];
        ?>
        <div class="card product_<?= $product['category_id'];?> product-card">
            <div class="card-body">
            <div class="d-flex">
                <div class="flex-shrink-0">
                <img src="<?= base_url($product['image']); ?>" alt="<?= $product['product_name'] ?>">
                </div>
                <div class="flex-grow-1 ms-3">
                <div class="d-flex justify-content-between">
                    <span class="h3"><?= $product['product_name'] ?></span>
                    <span class="price"><i class="bi bi-currency-rupee"></i> <span class="product_price_<?= $product['id']?>"><?= $productService[0]['price']; ?></span></span>
                </div>
               
                <div class="d-flex align-items-center justify-content-between">
                    <span class="service-type">
                    <select class="form-select product_service_<?= $product['id']?>" onchange="updatePrice(<?= $product['id']?>)" aria-label="Default select example">
                        <?php if(is_array($productService) && count($productService)>0){
                            for($i=0;$i<count($productService);$i++){ ?>
                                <option value="<?= $productService[$i]['id']?>" data-price="<?= $productService[$i]['price']?>"><?= $productService[$i]['service_name']?></option>
                        <?php } } ?>
                    </select>
                    </span>
                    <span class="quantity">
                    <select class="form-select quantity_<?= $product['id']?>" aria-label="Default select example">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    </span>
                    <span class="addcart">
                        <button onclick="addtocart(<?= $product['id']?>)" class="btn btn-theme rounded-circle"><i class="bi bi-bag-plus"></i></button>
                    </span>
                </div>
                </div>
            </div>
            </div>
        </div>
        <?php } } ?>
        </div>
    </div>
  </div>
</div>