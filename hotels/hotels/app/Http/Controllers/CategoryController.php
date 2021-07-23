<?php

namespace App\Http\Controllers;
use App\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{   public $category;
	public function __construct() {
        $this->category=new CategoryModel;
        
    } 
    public function add(Request $req){

        $this->category->name_category=$req->name;
        $this->category->save();
        return response()->json(['success'=>'Tạo Danh Mục Thành Công']);       
    }
    public function list_category(){
    	$data=$this->category->where('delete_at',0)->get();
    	$string ='';
    	foreach ($data as $data) {
    		 $string.=' <tr>
                            <td>'.$data['id'].'</td>
                            <td>'.$data['name_category'].'</td>
                            <td style="text-align: center;">
                            <img src="'.url('icoin/delete.png').'" style="width: 30px;
                                            height: 30px;">
                            </td>	
                        </tr>';                  
    	}
    	       
            return $string;
    }
    public function option_list_category(){
    	$data=$this->category->where('delete_at',0)->get();
    	$string ='<option><--! Mời Bạn Chọn Danh Mục !--></option>';
    	foreach ($data as $data) {
    		 $string.='<option value="'.$data['id'].'">'.$data['name_category'].'</option>';                  
    	}
    	       
            return $string;
    }
}
