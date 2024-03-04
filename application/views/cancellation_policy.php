<section class="inner-banner services-banner">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-white">Cancellation Policy</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="about-home py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="">
              <div class="fw-bolder mb-3 text-theme-dark2 h2">Service Title</div>
              <div class="text-left">
               <?php if(!empty($cancellation_policy)){
               
                echo $cancellation_policy[0]['description'];
       

               }else
               {

               }
                
              ?></div>
            </div>
          </div>
         
        </div>
      </div>
    </section>
   