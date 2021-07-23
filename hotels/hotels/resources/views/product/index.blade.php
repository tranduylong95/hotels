@extends('layout')
@section('content')
    <div class="header" style=>
    	  <div class="form-group row">
                <div class="col-md-auto">
				    <select class="form-control">
				      <option>Đang kinh doanh</option>
				      <option>Ngừng kinh doanh</option>
				      <option>Đã xóa</option>
				      <option>Còn Hàng</option>
				      <option>Hết Hàng</option>
				    </select>
                </div>
                <div class="col-md-auto">
				    <select class="form-control">
				      <option>Danh Mục</option>
				      <optgroup label="Chọn danh mục">
				      	  <option>Thức uống</option>
				      </optgroup>
				    </select>
                </div>
                <div class="col-md-auto">
				   <input type="text" name="" class="form-control" placeholder="Tìm kiếm tên hàng hóa..">
                </div>
                <div class="col-md-auto">
                   <button type="button" class="btn" id="search">Tìm kiếm </button>
                   <button type="button" class="btn btn-primary" style="background-color:#337AB7;">Thêm mới </button>
                </div>
                <div class="col-md-3 row" style="padding-right: 3px;">
                	<input type="file" name="" class="form-control filestyle">
                	<button type="button" class="btn btn-primary" style="background-color:#337AB7;">Import
                	</button>
                </div>
                 <div class="col-md-auto" style="padding-left: 0px;">
                	<button type="button" class="btn btn-primary" style="background-color:#337AB7;">File mẫu
                	</button>
                	<button type="button" class="btn btn-primary" style="background-color:#337AB7;">
                		Xuất Excel
                	</button>
                </div>
		</div>
    </div>
    <nav aria-label="breadcrumb" style="display: none;">
	      <ol class="breadcrumb">
	        <a class="btn-back btn-default">Hàng Hóa</a>
	        <li class="breadcrumb-item active" aria-current="page" style="color: #337ab7; font-weight: bold;">Thêm mới</li>
	      </ol>
	  </nav>
    <div class="content">
    	<div class="table_s1">
	    	<table class="table table-striped s1">
	                  <thead>
	                    <tr>
	                      <th>Hình Ảnh</th>
	                      <th class="text-center">Tên Hàng Hóa</th>
	                      <th class="text-center">Danh Mục</th>
	                      <th class="text-center">Có Thể Bán</th>
	                      <th class="text-center">Trạng Thái</th>
	                      <th class="text-center">Ngày Khởi Tạo</th>
	                      <th>Thao Tác</th>
	                    </tr>
	                  </thead>
	                  <tbody>
                      @foreach($product as $data)
	                    <tr>
	                      <td style="padding-top: 10px;">
                         <img onmouseenter="zoom_image(this,1)" src="{{$data->photo}}" style="width: 40px; padding-top: 10px;height: 60px;" onmouseleave="zoom_image(this,0)"> 
                        </td>
	                      <td class="text-center" style="padding: 20px; margin: 0px;"><p class="href" onclick="cms_detail_product(<?php echo $data['id'].','.$product->currentPage();?>)">{{$data->name_product}}</p></td>
	                      <td class="text-center">
                        <?php
                        foreach ($category as $value) {
                          if($data['id_category']==$value['id'])
                            echo '<p>'.$value['name_category'].'</p>';
                        }
                        ?>
                        <span style="background-color: teal;color: white;border-radius: 6px;padding: 5px;">{{$data->code_product}}</span>
                        </td>
	                      <td class="text-center">
                        <p>{{$data->number_product}}</p>
                        <?php
                        foreach ($price_after as $value) {
                          if($data['id']==$value['id_product'])
                            echo '<p>Giá nhập:  '.number_format($value['price_buy']).'đ</p>';
                        }
                        ?> 
                        </td>
	                      <td class="text-center">
                         <?php
                          if($data['active']==1){
                            echo "Đang giao dịch";
                          }
                          else {
                            echo "Ngừng giao dịch";
                          }
                         ?> 
                        </td>
	                      <td class="text-center">{{$data->created_at}}</td>
	                      <td></td>
	                    </tr>
                      @endforeach
	                  </tbody>
	      </table>
        <nav>
          <ul class="pagination justify-content-end">
            <?php if($product->currentPage()>1){
              ?>
            <li class="page-item">
              <a class="page-link href" onclick="cms_pagetion_product(<?php echo $product->currentPage()-1;?>)">Previous</a>
            </li>
            <?php }?>
            <?php $a=1;for($i=$product->currentPage();$i<=$product->total()&&$a<=2;$i++){?>
            <li class="page-item"><a class='page-link href <?php if($i==$product->currentPage()) echo "active"?>'  onclick="cms_pagetion_product(<?php echo $i;?>)"><?php echo $i?></a></li>
            <?php $a++; }?>
            <?php if($product->currentPage()<$product->total()){?>
            <li class="page-item">
              <a class="page-link href"  onclick="cms_pagetion_product(<?php echo $product->currentPage()+1;?>)">Next</a>
            </li>
            <?php }?>
          </ul>
        </nav>
      </div>
      <div class="form_s1" style="display: none;">
         	<div class="row">
         		<div class="col-sm-12 row" style="padding: 20px; border-bottom:1px solid #EEEEEE; ">
         			<div class="col-sm-6">
         				<h6 style="margin-top: 10px;margin-bottom: 0px;">Thông tin sản phẩm Các thông tin chi tiết của sản phẩm</h6></div>
         			<div class="col-sm-6 text-right	"><button class="btn btn-primary add_button" onclick="cms_add_product()">Lưu sản phẩm</button></div>
         		</div>
         		<div class="col-sm-6">
         				<div class="row" style="padding: 20px;padding-bottom: 0px;">
         					<div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Tên sản phẩm <span class="required">*</span>
                                </label>
                  </div>
                            <div class="col-md-9">
                            	<input type="text" name="name_product" class="form-control">
                              <div class="error"></div>
                            </div>

                </div>
                        <div class="row" style="padding: 20px; padding-bottom: 0px;">
                            <div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Danh Mục <span class="required"></span>
                                </label>
                            </div>
                            <div class="col-md-9 row">
                            	<div class="col-sm-11">
                            		<select class="form-control" id="option_list_category">
                                  <option value=""><--! Mời Bạn Chọn Danh Mục !--></option>
                                  
                                  @foreach($category as $value)
                                  <option value="{{ $value->id  }}">{{ $value->name_category  }}</option>
                                  @endforeach
                               
            								    </select>
                            	</div>
                            	<div class="col-sm-1">
                            		<button class="btn btn-primary"class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" onclick="cms_list_category()">...</button>
                            	</div>
                              <div class="error"></div>
                            </div>
         				</div>
         				<div class="row" style="padding: 20px; padding-bottom: 0px;">
         					<div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Giá Bán Lẻ<span class="required">*</span>
                                </label>
                            </div>
                            <div class="col-md-9">
                            	<input type="text" name="" class="form-control text-right" placeholder="0" id="price_sell">
                              <div class="error"></div>
                            </div>
         				</div>
         				<div class="row" style="padding: 20px; padding-bottom: 0px;">
         					<div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Giá nhập<span class="required">*</span>
                                </label>
                            </div>
                            <div class="col-md-9">
                            	<input type="text" name="" class="form-control text-right" placeholder="0" id="price_buy">
                              <div class="error"></div>
                            </div>
         				</div>
                <div class="row" style="padding: 20px; padding-bottom: 0px;">
                  <div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Tồn Kho Ban Đầu <span class="required"></span>
                                </label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="tonkho" class="form-control text-right" placeholder="0" id="tonkho">
                              <div class="error"></div>
                            </div>
                </div>
         		</div>
         		<div class="col-sm-6">
         			<div class="row" style="padding: 20px;padding-bottom: 0px;">
         					<div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Mã sản phẩm <span class="required"></span>
                                </label>
                  </div>
                            <div class="col-md-9">
                            	<input type="" name="code_product" class="form-control">
                              <div class="error"></div>
                            </div>
              </div>
              <div class="row" style="padding: 20px; padding-bottom: 0px;">
                            <div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Đơn vị tính <span class="required">*</span>
                                </label>
                            </div>
                            <div class="col-md-9 row">
                            	<div class="col-sm-11">
                            		<select class="form-control" id="option_list_dvt">
            								      <option value=""><--! Mời Bạn Chọn Đơn Vị Tính !--></option>
                                  @foreach($dvt as $value)
                                  <option value="{{ $value->id  }}">{{ $value->name_dvt  }}</option>
                                  @endforeach
            								    </select>
                            	</div>
                            	<div class="col-sm-1">
                            		<button class="btn btn-primary" data-toggle="modal" data-target="#dvt" onmousemove="cms_list_dvt()">...</button>
                            	</div>
                              <div class="error"></div>
                            </div>
         		  </div>
              <div class="row" style="padding: 20px; padding-bottom: 0px;" id="list_dvt_big">
                <div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Cấu Trúc Sản Phẩm<span class="required"></span>
                                </label>
                </div>
                <div class="col-md-9" >
                                <select class="form-control" onmouseup="list_dvt_big(this)" id="option_dvt_big">
                                  <option value="0">-Chọn Cấu Trúc Sản Phẩm-</option>
                                  <option  value="1">Sản Phẩm Có Đơn Vị Tính Lớn</option>
                                </select>
                </div>
              </div>
              <div class="row" style="padding: 20px; padding-bottom: 0px; display: none;">
                            <div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Tên Đơn Vị Tính Lớn<span class="required">*</span>
                                </label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="name_dvt_big" class="form-control text-right" >
                              <div class="error"></div>
                            </div>
                    </div>
              <div class="row" style="padding: 20px; padding-bottom: 0px; display: none;">
                            <div class="col-md-3 text-left">
                                <label for="name" class="control-label" style="margin-top: 8px;">Giá Trị Quy Đổi<span class="required">*</span>
                                </label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" name="exchange_value" class="form-control text-right">
                              <div class="error"></div>
                            </div>
                    </div>
              </div>
              <div class="col-sm-12 text-center" style="justify-content: center;padding-top:20px;display: none;" id="image_product_1">
                <div class="col-md-3">
                <img src="" id="image_product">
                </div>
              </div>      
         		<div class="col-sm-12 text-center" style="justify-content: center;display: flex;padding:20px;">
         			<div class="col-md-3">
         				<a class="btn btn-primary">
         			    <input type="file" name="photo" accept="image/*" onchange="previewFile(this)">
         			    </a>
         		    </div>
         		</div>
         </div>
      </div>
      <div class="alert_ajax" style="display: none;">
         <span>Thông Báo!</span>
         <br>
         <div class="alert_1">Cập nhập thành công</div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới danh mục sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body ">
                <div class="content" style="padding-bottom: 10px;">
                  <div class="tab1" style="padding: 10px; padding-bottom: 0px;">
                    <button class="btn active_s1" onclick="form_category(this)"><strong>Danh Sách Danh Mục</strong></button>
                    <button class="btn" onclick="form_category(this)"><strong>Tạo Mới Danh Mục</strong></button>
                  </div>
                        <div style="border: 1px solid yellow; padding-bottom: 10px; border-top: 0px;">
                      <div class="modals_1" id="list_category">
                        <table class="table table-bordered" style="padding-top: 10px;">
                                <thead>                  
                                    <tr>
                                      <th style="width: 10px">ID</th>
                                      <th>Tên Danh Mục</th>
                                      <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                  <tbody id="list_category_content">
                                  </tbody>
                              </table>
                      </div>
                            <div id="form_category" class="modals_1" style="display:none;">
                                <form >
                                    <div class="form-group row">
                                        <div class="col-md-4 text-right">
                                          <label>Tên Danh Mục</label>
                                        </div>
                                        <div class="col-md-8">
                                          <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-md-8 offset-md-4">
                                          <span class="error" style="display: none;">Mời bạn nhập tên danh mục</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 offset-md-4">
                                           <button type="button" class="btn btn-primary">Lưu</button>
                                           <button type="button" class="btn btn-primary" onclick="cms_add_category(0)">Lưu và tiếp tục</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              </div>
            </div>
         </div>
      </div>
      <div class="modal fade bd-example-modal-lg" id="dvt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Danh mục đơn vị tính</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body ">
              <div class="content" style="padding-bottom: 10px;">
                      <div class="tab1" style="padding: 10px; padding-bottom: 0px;">
                          <button class="btn active_s1" onclick="form_dvt(this)"><strong>Danh Sách Đơn Vị Tính</strong></button>
                          <button class="btn" onclick="form_dvt(this)"><strong>Tạo Mới Đơn Vị Tính</strong></button>
                      </div>
                      <div style="border: 1px solid yellow; padding-bottom: 10px; border-top: 0px;">
                          <div class="modals_1" id="list_dvt">
                              <table class="table table-bordered" style="padding-top: 10px;">
                                  <thead>                  
                                      <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Tên Đơn Vị Tính</th>
                                        <th>Thao Tác</th>
                                      </tr>
                                  </thead>
                                  <tbody id="list_dvt_content">
                                    
                                  </tbody>
                              </table>
                          </div>
                          <div id="form_dvt" class="modals_1" style="display: none;">
                              <form id="form_dvt">
                                  <div class="form-group row">
                                      <div class="col-md-4 text-right">
                                        <label>Tên Danh Mục</label>
                                      </div>
                                      <div class="col-md-8">
                                        <input type="text" class="form-control">
                                      </div>
                                      <div class="col-md-8 offset-md-4">
                                          <span class="error" style="display: none;">Mời bạn nhập tên danh mục</span>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-8 offset-md-4">
                                         <button type="button" class="btn btn-primary">Lưu</button>
                                         <button type="button" class="btn btn-primary" onclick="cms_add_dvt(this)" >Lưu và tiếp tục</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection