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
                    $url = CONFIG_SERVER_ADMIN_ROOT . "products/edit/$id";
                } else {
                    $url = CONFIG_SERVER_ADMIN_ROOT . "products/add";
                }
                echo form_open($url, array('class' => 'products', 'id' => 'products')); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first name" class="">Product Name <span class="text-danger">*</span></label>
                            <input value="<?php if (isset($formData['product_name'])) {
                                                echo $formData['product_name'];
                                            } ?>" name="product_name" id="product_name" placeholder="Please Enter Product Name" autocomplete='off' type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="mb-3">
                            <label for="last name" class="">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach($categories as $category){ ?>
                                    <option value="<?= $category['id'];?>" <?php if(isset($formData) && ($formData['category_id']==$category['id'])){ echo "selected"; } ?>><?= $category['category'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleEmail11" class="">Image</label>
                            <input type="file" class="image_element form-control border" >
                            <input type="hidden" id="image"  class="main_image" value="<?php if(isset($formData)){ echo $formData['image']; } ?>" name="image">
                            <ul id="imageUploadedDoc">
                            <?php if(isset($formData) && $formData['image']!=''){ ?>
                                <a href='javascript:void(0)' onclick="openimage('<?= base_url($formData['image']); ?>')" >View</a>
                            <?php } ?>
                            </ul>
                            <div style="display:none" class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-primary" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Status<span class="text-danger"> *</span></label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="Active" <?php if (isset($formData['status'])) { if($formData['status']=='Active') { echo 'selected';}else{ echo 'selected'; } } ?>>Active</option>
                                <option value="Inactive" <?php if (isset($formData['status'])) { if($formData['status']=='Inactive') { echo 'selected';}else{  } } ?>>In Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="services">

                </div>
                <div class="row mt-2">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-sm btn-info" onclick="addNewService()"><i class="ri-add-circle-fill"></i></button>
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
            </div>
        </div>
<script>
    $('.image_element').change(function() {
        formdata = new FormData();
        var path = "uploads/products/";
        if ($(this).prop('files').length > 0) {
            file = $(this).prop('files')[0];
            formdata.append("file", file);
            formdata.append("path", path);
            $(".image_element").val('');
            uploadDocs(formdata, 'imageUploadedDoc', 'main_image');
        }
    });
    function addNewService(id=''){
        $.ajax({
           type:'post',
           url:base_url+'administrator/products/addService',
           data:{id:id},
           beforeSend:function(){

           },
           success:function(res){
            var res = JSON.parse(res);
            if(res.error ==0){
                $(".services").append(res.html);
            }
           }
        });
    }
    
    function deleteRow(id){
        $(".row_"+id).remove();
    }
    <?php if (isset($formData['id'])) { ?>
        addNewService(<?= $formData['id']?>);
    <?php } ?>
</script>
    <?php } else { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="All">All</option>
                                        <option value="Active" selected>Active</option>
                                        <option value="Inactive">In Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="button" style="margin-top:28px" onclick="getdata()" name="submit" class="btn btn-primary" value="Search">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive tasks dataGridTable">
                            <table id="productsList" class="table card-table table-vcenter text-nowrap mb-0 border nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>

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
        var clist = $('#productsList').DataTable({
            "destroy": true,
            "responsive": false,
            "processing": true,
            "serverSide": true,
            "order": [
                [6, "asc"]
            ],
            "ajax": {
                "url": "<?php echo CONFIG_SERVER_ADMIN_ROOT ?>products/ajaxListing",
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
                            url: '<?php echo base_url(); ?>administrator/products/updateStatus',
                            type: 'POST',
                            data: {
                                "statusresult": "1",
                                "status": sTaTus,
                                "pid":uId
                            },
                            success: function(data) {
                                result = JSON.parse(data);
                                var msg = result.message;
                                if (result.error == '0') {
                                    toastr['success'](msg);
                                    $('#productsList').DataTable().ajax.reload();
                                } else {
                                    toastr['warning'](msg);
                                    $('#productsList').DataTable().ajax.reload();
                                }
                            },
                            error: function(e) {
                                toastr['danger'](msg);
                                $('#productsList').DataTable().ajax.reload();
                            }
                        });
                    }
                },
                no: function() {
                    //close
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

