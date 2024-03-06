<div class="col-md-12">
    <?php
    defined('BASEPATH') or exit('No direct script access allowed');
    if (isset($data)) {
        if (!empty($data)) {
            $formData = $data;
        } else {
            $formData = $this->form_validation->get_session_data();
        }
    } else {
        $formData = $this->form_validation->get_session_data();
    }
    ?>
    <?php if (isset($form_action)) { ?>
        <div class="">
            <div class="main-card mb-3 card card-body">
                <h5 class="card-title"></h5>
                <?php

                if (isset($formData['id'])) {
                    $id = $formData['id'];
                    $url = CONFIG_SERVER_ADMIN_ROOT . "zipcodes/edit/$id";
                } else {
                    $url = CONFIG_SERVER_ADMIN_ROOT . "zipcodes/add";
                }
                echo form_open($url, array('class' => 'zipcodesRegistration', 'id' => 'zipcodesRegistration')); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Area name" class="">Area Name</label>
                            <input value="<?php if (isset($formData['area_name'])) { echo $formData['area_name'];} ?>" name="area_name" id="area_name" placeholder="Please Enter Area Name" autocomplete='off' type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Service name" class="">Zip Code</label>
                            <input value="<?php if (isset($formData['zipcode'])) { echo $formData['zipcode'];} ?>" name="zipcode" id="zipcode" placeholder="Please Enter Zip Code" autocomplete='off' type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="service_charge" class="">Service Charge</label>
                            <input value="<?php if (isset($formData['service_charge'])) { echo $formData['service_charge'];} ?>" name="service_charge" id="service_charge" placeholder="Please Enter Service Charge" autocomplete='off' type="text" class="form-control">
                        </div>
                    </div>
                     <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if (isset($formData['status'])) { if($formData['status']=='Active') { echo 'selected';}else{ echo 'selected'; } } ?>>Active</option>
                                        <option value="Inactive" <?php if (isset($formData['status'])) { if($formData['status']=='Inactive') { echo 'selected';}else{  } } ?>>In Active</option>
                                    </select>
                                </div>
                            </div>
                </div>

             
                <div>
                    <?php if (isset($formData['id'])) { ?>
                        <input type='hidden' name="id" value="<?php echo $formData['id'] ?>">
                        <input type="submit" name="edit" class="mt-2 btn btn-primary pull-right" value="Update">
                    <?php } else { ?>
                        <input type="submit" name="add" class="mt-2 btn btn-primary pull-right" value="Submit">
                    <?php } ?>

                </div>
                </form>


                <?php
   }
   else
   {
    ?>
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive tasks dataGridTable">
                            <table id="zipcodes_list" class="table card-table table-vcenter text-nowrap mb-0 border nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Area Name</th>
                                        <th>Zip Code</th>
                                        <th>Service Charge</th>
                                        
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                    </div>
                    </div>


                </div>
            </div>

       

      </div>
        </div>
 
<script type="text/javascript">
    function getdata() {
        var status = $("#status").val();
     
        $('#zipcodes_list').DataTable({
            "destroy": true,
            "responsive": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                "url": "<?php echo CONFIG_SERVER_ADMIN_ROOT ?>zipcodes/ajaxListing",
                "type": 'POST',
                'data': {
                    status: status,
                   
                }
            },
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });
    }
    getdata();

    function statusUpdate(e, uId, sTaTus) {


        $('#page-overlay1').hide();
        var TtMsg = 'Are you sure you want to ' + sTaTus + ' this status';
        $.confirm({
            title: TtMsg,
            buttons: {
                formSubmit: {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function() {
                        $('#page-overlay').show();
                        $.ajax({
                            url: '<?php echo base_url(); ?>administrator/zipcodes/updateStatus',
                            type: 'POST',
                            data: {
                                "statusresult": "1",
                                "area_id": uId,
                                "status": sTaTus
                            },
                            success: function(data) {
                                result = JSON.parse(data);
                                var msg = result.message;
                                if (result.error == '0') {
                                    toastr['success'](msg);
                                    $('#zipcodes_list').DataTable().ajax.reload();
                                } else {
                                    toastr['warning'](msg);
                                    $('#zipcodes_list').DataTable().ajax.reload();
                                }
                            },
                            error: function(e) {
                                toastr['warning'](e.message);
                                $('#zipcodes_list').DataTable().ajax.reload();
                            }
                        });

                    }
                },
                no: function() {
                    $('#page-overlay').hide();
                },
            },
            onContentReady: function() {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function(e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }
</script>

<?php } ?>