<?php

namespace App\Http\Controllers;
use App\DonviTinhModel;
use Illuminate\Http\Request;

class DonViTinhController extends Controller
{
    public $dvt;
	public function __construct() {
        $this->dvt=new DonviTinhModel;    
    } 
    public function add(Request $req){

        $this->dvt->name_dvt=$req->name;
        $this->dvt->save();
        return response()->json(['success'=>'Tạo Danh Mục Thành Công']);       
    }
    public function list_dvt(){
    	$data=$this->dvt->where('delete_at',0)->get();
    	$string ='';
    	foreach ($data as $data) {
    		 $string.=' <tr>
                            <td>'.$data['id'].'</td>
                            <td>'.$data['name_dvt'].'</td>
                            <td style="text-align: center;">
                            <img src="'.url('icoin/delete.png').'" style="width: 30px;
                                            height: 30px;">
                            </td>	
                        </tr>';                  
    	}
    	       
            return $string;
    }
    public function option_list_dvt(){
    	$data=$this->dvt->where('delete_at',0)->get();
    	$string ='<option><--! Mời Bạn Chọn Danh Mục !--></option>';
    	foreach ($data as $data) {
    		 $string.='<option value="'.$data['id'].'">'.$data['name_dvt'].'</option>';                  
    	}
    	       
    return $string;
    }
}
