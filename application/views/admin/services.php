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
                    $url = CONFIG_SERVER_ADMIN_ROOT . "services/edit/$id";
                } else {
                    $url = CONFIG_SERVER_ADMIN_ROOT . "services/add";
                }
                echo form_open($url, array('class' => 'servicesRegistration', 'id' => 'servicesRegistration')); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Service name" class="">Service Name</label>
                            <input value="<?php if (isset($formData['service_name'])) { echo $formData['service_name'];} ?>" name="service_name" id="service_name" placeholder="Please Enter Service Name" autocomplete='off' type="text" class="form-control">
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleEmail11" class="">Web Image</label>
                            <input type="file" class="web_image_element form-control border" >
                            <input type="hidden" id="web_image"  class="web_image" value="<?php if(isset($formData)){ echo $formData['web_image']; } ?>" name="web_image">
                            <ul id="web_image_uploaded">
                            <?php if(isset($formData) && $formData['web_image']!=''){ ?>
                                <a href='javascript:void(0)' onclick="openimage('<?= base_url($formData['web_image']); ?>')" >View</a>
                            <?php } ?>
                            </ul>
                            <div style="display:none" class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-primary" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleEmail11" class="">App Image</label>
                            <input type="file" class="app_image_element form-control border" >
                            <input type="hidden" id="app_image"  class="app_image" value="<?php if(isset($formData)){ echo $formData['app_image']; } ?>" name="app_image">
                            <ul id="app_image_Uploaded">
                            <?php if(isset($formData) && $formData['app_image']!=''){ ?>
                                <a href='javascript:void(0)' onclick="openimage('<?= base_url($formData['app_image']); ?>')" >View</a>
                            <?php } ?>
                            </ul>
                            <div style="display:none" class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-primary" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
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

<script>

   

    $('.web_image_element').change(function() {
        formdata = new FormData();
        var path = "uploads/services/";
        if ($(this).prop('files').length > 0) {
            file = $(this).prop('files')[0];
            formdata.append("file", file);
            formdata.append("path", path);
            $(".web_image_element").val('');
            uploadDocs(formdata, 'web_image_uploaded', 'web_image');
        }
    });

    $('.app_image_element').change(function() {
        formdata = new FormData();
        var path = "uploads/services/";
        if ($(this).prop('files').length > 0) {
            file = $(this).prop('files')[0];
            formdata.append("file", file);
            formdata.append("path", path);
            $(".app_image_element").val('');
            uploadDocs(formdata, 'app_image_Uploaded', 'app_image');
        }
    });
</script>
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
                            <table id="services_list" class="table card-table table-vcenter text-nowrap mb-0 border nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Service Name</th>
                                        <th>Web Image</th>
                                        <th>App Image</th>
                                        
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
     
        $('#services_list').DataTable({
            "destroy": true,
            "responsive": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                "url": "<?php echo CONFIG_SERVER_ADMIN_ROOT ?>services/ajaxListing",
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
                            url: '<?php echo base_url(); ?>administrator/services/updateStatus',
                            type: 'POST',
                            data: {
                                "statusresult": "1",
                                "service_id": uId,
                                "status": sTaTus
                            },
                            success: function(data) {
                                result = JSON.parse(data);
                                var msg = result.message;
                                if (result.error == '0') {
                                    toastr['success'](msg);
                                    $('#services_list').DataTable().ajax.reload();
                                } else {
                                    toastr['warning'](msg);
                                    $('#services_list').DataTable().ajax.reload();
                                }
                            },
                            error: function(e) {
                                toastr['warning'](e.message);
                                $('#services_list').DataTable().ajax.reload();
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