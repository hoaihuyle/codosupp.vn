<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->

<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <div class="row">
                    <div class="form-group col-md-5 col-sm-12">
                        <select class="form-control" id="exampleFormControlSelect1">
                        <option value="0">Chọn danh mục sản phẩm </option>
                        <?php foreach($categoryInfos as $category){ ?>
                            <option value="<?php echo $category['id_cate'] ?>"> <?php echo $category['name_cate'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-5 col-sm-12">
                        <select class="form-control" id="exampleFormControlSelect1">
                        <option value="0">Chọn hãng sản phẩm</option>
                        <?php foreach($companyInfos as $company){ ?>
                            <option value="<?php echo $company['id_comp'] ?>"> <?php echo $company['name_comp'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class='col-md-5'>
                        <div class="form-group">
                        <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                                <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-5'>
                        <div class="form-group">
                        <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8"/>
                                <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" id="filterBtnTime">
                            <button class="btn btn-primary"> Lọc </button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        </div>
        <div class="row">
            <!-- ============================================================== -->
            <!-- data table  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Danh sách sản phẩm - Print, Excel, CSV, PDF </h5>
                        <!-- <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Id</th>
                                        <th style="text-align: center;">Tên</th>
                                        <th style="text-align: center;">Ảnh</th>
                                        <th style="text-align: center;">Ngày tạo</th>
                                        <th style="text-align: center;">Người tạo</th>
                                        <th style="text-align: center;">Trạng thái</th>
                                        <th style="text-align: center;">Chỉnh sửa</th>
                                        <th style="text-align: center;">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($productInfos as $product){
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $product['id_prod']; ?></td>
                                            <td align="center"><?php echo $product['name_prod']; ?></td>
                                            <td align="center">Ảnh </td>
                                            <td align="center"><?php echo $product['created']; ?></td>
                                            <td align="center"><?php echo ($product['user_created']!=0)?$product['user_created']:'admin'; ?></td>
                                            <td align="center"><?php echo ($product['flag']==0)?'Hiển thị':'Đã xóa'; ?></td>
                                            <td align="center"><a href="/product/edit/<?php echo $product['id_prod']; ?>"><img src="/lib/admin/images/edit.png" width="25"></a></td>
                                            <td align="center"><a href="/product/delete/<?php echo $product['id_prod']; ?>" onclick="return confirm('Dữ liệu của bạn sẽ bị mất, bạn chắc chắn chứ ?')" ><img src="/lib/admin/images/delete.png" width="25"></a></td>
                                        </tr>
                                    <?php        
                                        } 
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Id</th>
                                        <th style="text-align: center;">Tên</th>
                                        <th style="text-align: center;">Ảnh</th>
                                        <th style="text-align: center;">Ngày tạo</th>
                                        <th style="text-align: center;">Người tạo</th>
                                        <th style="text-align: center;">Trạng thái</th>
                                        <th style="text-align: center;">Chỉnh sửa</th>
                                        <th style="text-align: center;">Xóa</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>

    </div>
