<?php

namespace App\Http\Controllers;
use App\CategoryModel;
use App\DonViTinhModel;
use App\ProductModel;
use App\PriceAfterModel;
use App\DonViTinhBigModel;
use Illuminate\Support\Facades\Storage;
use App;
use Validator;
use Illuminate\Http\Request;
use App\function1\function1;

class ProductController extends Controller
{
	public $category;
	public $dvt;
    public $product;
	public function __construct() {
        $this->category=new CategoryModel;
        $this->dvt=new DonViTinhModel;
        $this->product=new ProductModel;
        $this->price_after=new PriceAfterModel;
        $this->dvt_big=new DonViTinhBigModel;
        $this->function= new function1;
    } 
    public function index(){
        $category=$this->category->where('delete_at',0)->get();
        $dvt=$this->dvt->where('delete_at',0)->get();
        $product=$this->product->where('delete_at',0)->paginate(1);
        $price_after=$this->price_after->where('active',1)->get();
    	return view('product.index')->with('category',$category)->with('dvt',$dvt)->with('product',$product)->with('price_after',$price_after);  

    }
    public function add(Request $req){
        App::setLocale('vi');
        if($req->dvt_big==0){
        $validator = Validator::make($req->all(), [
            'name_product' => 'required',
            'category'=>'required',
            'price_sell' =>'required',
            'price_buy'=>'required',
            'dvt'=>'required',
            'code_product'=>'unique:product,code_product',
        ]);
        }
        else{
             $validator = Validator::make($req->all(), [
            'name_product' => 'required',
            'category'=>'required',
            'price_sell' =>'required',
            'price_buy'=>'required',
            'dvt'=>'required',
            'name_dvt_big'=>'required',
            'exchange_value'=>'required',
            'code_product'=>'unique:product,code_product',
        ]);
        }
        if ($validator->passes()) {
             $data=$this->product->where('code_product','like','%SP%')->get();
            if($req->dvt_big==1){
                 $this->dvt_big->name_dvt_big=$req->dvt_big;
                 $this->dvt_big->exchange_value=$req->exchange_value;
                 $this->dvt_big->save();
                 $this->product->id_dvt_big=$this->dvt_big->id;
            }
            $this->product->name_product=$req->name_product;
            $this->product->number_product=$req->tonkho;
            $this->product->id_category=$req->category;
            $this->product->id_dvt=$req->dvt;
             if($req->hasFile('photo')){
             $name=md5(md5(rand(999,99999)).time().rand(999,999999).md5(time())).'.'.$req->file('photo')->getClientOriginalExtension();
             $path = Storage::putFileas('public/product/',$req->file('photo'),$name);
                 $this->product->photo='storage/product/'.$name;
                }
                else{
                $this->product->photo='storage/product/default.jpg';    
                }
            if($req->code_product){
                $this->product->code_product=$req->code_product;
            }
            else {
                $array = [];
                foreach ($data as  $value) {
                    array_push($array,$value['code_product']);
                }
                $this->product->code_product=$this->function->Code('SP',$array);
            }
            $this->product->save();
            $this->price_after->price_buy=$req->price_buy;
            $this->price_after->price_sell=$req->price_sell;
            $this->price_after->id_product=$this->product->id;
            $this->price_after->save();
            return response()->json(['success'=>'Thêm mới sản phẩm thành công']);
        }
         return response()->json(['error'=>$validator->errors()]);
    }
    public function detail_product($id){
         $detail_product=$this->product->find($id);
         $price=$this->price_after->where("id_product",$detail_product['id'])->where("active",1)->get();
         $dvt_big=$this->dvt_big->where("id",$detail_product['id_dvt_big'])->get();
         return response()->json(['product'=>$detail_product,'price'=>$price,'dvt_big'=>$dvt_big]);
    }
    public function update($id,Request $req){
        App::setLocale('vi');
        if($req->dvt_big==0){
        $validator = Validator::make($req->all(), [
            'name_product' => 'required',
            'category'=>'required',
            'price_sell' =>'required',
            'price_buy'=>'required',
            'dvt'=>'required',
            'code_product'=>'unique:product,code_product,'.$id,
        ]);
        }
        else{
             $validator = Validator::make($req->all(), [
            'name_product' => 'required',
            'category'=>'required',
            'price_sell' =>'required',
            'price_buy'=>'required',
            'dvt'=>'required',
            'name_dvt_big'=>'required',
            'exchange_value'=>'required',
            'code_product'=>'unique:product,code_product,'.$id,
        ]);
        }
        if ($validator->passes())
        {
              $product=$this->product->find($id);
              $product->name_product=$req->name_product;
              $product->number_product=$req->tonkho;
              $product->id_dvt=$req->dvt;
              $product->id_category=$req->category;
              if($req->code_product!=''){
                $product->code_product=$req->code_product;
              }
            $data=$this->price_after->where('id_product',$id)->where('active',1)->first();
            $data->active=0;
            $data->update(); 
            $this->price_after->price_buy=$req->price_buy;
            $this->price_after->price_sell=$req->price_sell;
            $this->price_after->id_product=$id;
            $this->price_after->save();
            if($req->hasFile('photo')){
            $name=md5(md5(rand(999,99999)).time().rand(999,999999).md5(time())).'.'.$req->file('photo')->getClientOriginalExtension();
            $path = Storage::putFileas('public/product/',$req->file('photo'),$name);
                 $this->product->photo='storage/product/'.$name;
            }
               
                if($req->dvt_big1==1)
                {
                 $this->dvt_big->name_dvt_big=$req->name_dvt_big;
                 $this->dvt_big->exchange_value=$req->exchange_value;
                 $this->dvt_big->save();
                 $product->id_dvt_big=$this->dvt_big->id;
                }
                else {
                    $product->id_dvt_big=$req->dvt_big1;
                } 
            $product->update();
             return response()->json(['success'=>'Cập nhật thành công']);
        }
        return response()->json(['error'=>$validator->errors()]);
    }
}
