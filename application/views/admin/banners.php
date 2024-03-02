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
                    $url = CONFIG_SERVER_ADMIN_ROOT . "banners/edit/$id";
                } else {
                    $url = CONFIG_SERVER_ADMIN_ROOT . "banners/add";
                }
                echo form_open($url, array('class' => 'bannersRegistration', 'id' => 'bannersRegistration')); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="banner_title" class="">Banner Ttile</label>
                            <input value="<?php if (isset($formData['banner_title'])) { echo $formData['banner_title'];} ?>" name="banner_title" id="banner_title" placeholder="Please Enter Banner Title" autocomplete='off' type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="banner_sub_title" class="">Banner Sub Ttile</label>
                            <input value="<?php if (isset($formData['banner_sub_title'])) { echo $formData['banner_sub_title'];} ?>" name="banner_sub_title" id="banner_sub_title" placeholder="Please Enter Banner  Sub Title" autocomplete='off' type="text" class="form-control">
                        </div>
                    </div>

                    
                </div>

                <div class="row">
                <div class="col-md-6">
                        <div class="mb-3">
                            <label for="action_link" class="">Banner Action Link</label>
                            <input value="<?php if (isset($formData['action_link'])) { echo $formData['action_link'];} ?>" name="action_link" id="action_link" placeholder="Please Enter Banner  Action Link" autocomplete='off' type="text" class="form-control">
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
              
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="banner_img" class="">Banner Image</label>
                            <input type="file" class="banner_img_element form-control border" >
                            <input type="hidden" id="banner_img"  class="banner_img" value="<?php if(isset($formData)){ echo $formData['banner_img']; } ?>" name="banner_img">
                            <ul id="banner_img_uploaded">
                            <?php if(isset($formData) && $formData['banner_img']!=''){ ?>
                                <a href='javascript:void(0)' onclick="openimage('<?= base_url($formData['banner_img']); ?>')" >View</a>
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

   

    $('.banner_img_element').change(function() {
        formdata = new FormData();
        var path = "uploads/banners/";
        if ($(this).prop('files').length > 0) {
            file = $(this).prop('files')[0];
            formdata.append("file", file);
            formdata.append("path", path);
            $(".banner_img_element").val('');
            uploadDocs(formdata, 'banner_img_uploaded', 'banner_img');
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
                            <table id="banners_list" class="table card-table table-vcenter text-nowrap mb-0 border nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Banner Title</th>
                                        <th> Banner Sub Title</th>
                                        <th>Banner Image</th>
                                        <th>Action Link</th>
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
     
        $('#banners_list').DataTable({
            "destroy": true,
            "responsive": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                "url": "<?php echo CONFIG_SERVER_ADMIN_ROOT ?>banners/ajaxListing",
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
                            url: '<?php echo base_url(); ?>administrator/banners/updateStatus',
                            type: 'POST',
                            data: {
                                "statusresult": "1",
                                "banner_id": uId,
                                "status": sTaTus
                            },
                            success: function(data) {
                                result = JSON.parse(data);
                                var msg = result.message;
                                if (result.error == '0') {
                                    toastr['success'](msg);
                                    $('#banners_list').DataTable().ajax.reload();
                                } else {
                                    toastr['warning'](msg);
                                    $('#banners_list').DataTable().ajax.reload();
                                }
                            },
                            error: function(e) {
                                toastr['warning'](e.message);
                                $('#banners_list').DataTable().ajax.reload();
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