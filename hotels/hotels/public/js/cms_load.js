function cms_add_category(e) {
	var x= document.getElementById("form_category");
	x=x.getElementsByTagName("input");
	var s=document.getElementsByClassName("alert_ajax");
	var y=document.getElementById("form_category");
    y=y.getElementsByClassName("error");
	var name_category=x[0].value;
	if(!name_category){
		y[0].style.display="block";
	}
	else 
	{   var token=$('meta[name="csrf-token"]').attr('content');
        y[0].style.display="none";
		  $.ajax({
                    type: "POST",
                    url: "addcategory",
                    dataType:"json",
                    data:{
                        'name':name_category,
                        '_token': token,
                    },
                    success: function(data) {
                     fadeOutEffect(s[0]);
                     x[0].value="";
                     cms_list_category();
                     cms_select_list_category();
                    },
                    error:function(){ 
                        alert("error!!!!");
                    }
                });
	}
}
function cms_list_category(){

    $.ajax({
                    url : "listcategory", 
                    type : "get", 
                    success : function (string){
                        $('#list_category_content').html(string);
                    }
            });
}
function cms_select_list_category(){
   
    $.ajax({
                    url : "selectcategory", 
                    type : "get", 
                    success : function (string){
                        $('#option_list_category').html(string);
                    }
            });
}
function cms_add_dvt(e) {
	var x= document.getElementById("form_dvt");
	x=x.getElementsByTagName("input");
	var s=document.getElementsByClassName("alert_ajax");
	var y=document.getElementById("form_dvt");
    y=y.getElementsByClassName("error");
	var name_dvt=x[0].value;
	if(!name_dvt){
		y[0].style.display="block";
	}
	else 
	{   var token=$('meta[name="csrf-token"]').attr('content');
        y[0].style.display="none";
		  $.ajax({
                    type: "POST",
                    url: "adddvt",
                    dataType:"json",
                    data:{
                        'name':name_dvt,
                        '_token': token,
                    },
                    success: function(data) {
                     fadeOutEffect(s[0]);
                     x[0].value="";
                     cms_list_dvt();
                      cms_select_list_dvt();
                    },
                    error:function(){ 
                        alert("error!!!!");
                    }
                });
	}
}
function cms_list_dvt(){

    $.ajax({
                    url : "listdvt", 
                    type : "get", 
                    success : function (string){
                        $('#list_dvt_content').html(string);
                    }
            });
}
function cms_select_list_dvt(){
   
    $.ajax({
                    url : "selectdvt", 
                    type : "get", 
                    success : function (string){
                        $('#option_list_dvt').html(string);
                    }
            });
}
function cms_add_product(){ 
    var name_product=document.querySelector('input[name="name_product"]').value;
    var option_list_category=document.getElementById('option_list_category').value;
    var price_sell=document.getElementById('price_sell').value.replace(/[^0-9\.]+/g, "");
    var price_buy= document.getElementById('price_buy').value.replace(/[^0-9\.]+/g, "");
    var tonkho=document.getElementById('tonkho').value.replace(/[^0-9\.]+/g, "");
    var option_list_dvt=document.getElementById('option_list_dvt').value;
    var option_dvt_big=document.getElementById('option_dvt_big').value;
    var photo=document.querySelector('input[name="photo"]').files[0];
    var name_dvt_big=document.querySelector('input[name="name_dvt_big"]').value;
    var exchange_value=document.querySelector('input[name="exchange_value"]').value.replace(/[^0-9\.]+/g, "");
    var code_product=document.querySelector('input[name="code_product"]').value;
    var token=$('meta[name="csrf-token"]').attr('content');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     let form_data = new FormData();
     form_data.append('name_product',name_product);
     form_data.append('photo',photo);
     form_data.append('price_sell',price_sell);
     form_data.append('price_buy',price_buy);
     form_data.append('tonkho',tonkho);
     form_data.append('category',option_list_category);
     form_data.append('dvt',option_list_dvt);
     form_data.append('dvt_big',option_dvt_big);
     form_data.append('name_dvt_big',name_dvt_big);
     form_data.append('exchange_value',exchange_value);
     form_data.append('code_product',code_product);
     $.ajax({
                    type: "POST",
                    url: "addproduct",
                    dataType:"json",
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function(data) {
                        if(data.error)
                        { 
                         var x=document.getElementsByClassName("form_s1");
                          x=x[0].getElementsByClassName("error");
                         if(data.error['name_product'])
                         {
                            x[0].innerHTML=data.error['name_product'];
                         }
                         if(data.error['category'])
                         {
                            x[1].innerHTML=data.error['category'];
                         }  
                          if(data.error['price_buy'])
                         {
                            x[2].innerHTML=data.error['price_buy'];
                         }  
                         if(data.error['price_sell'])
                         {
                            x[3].innerHTML=data.error['price_sell'];
                         }
                         if(data.error['dvt'])
                         {
                            x[6].innerHTML=data.error['dvt'];
                         }
                          if(data.error['exchange_value'])
                         {
                            x[8].innerHTML=data.error['exchange_value'];
                         }
                          if(data.error['name_dvt_big'])
                         {
                            x[7].innerHTML=data.error['name_dvt_big'];
                         }
                         if(data.error['code_product'])
                         x[5].innerHTML=data.error['code_product'];        
                        }
                         if(data.success)
                         {
                          var x=document.getElementsByClassName("form_s1");
                               x=x[0].getElementsByClassName("error");
                           document.querySelector('input[name="name_product"]').value="";
                           document.getElementById('option_list_category').selectedIndex =0;
                           document.getElementById('price_sell').value="";
                           document.getElementById('price_buy').value="";
                           document.getElementById('option_list_dvt').selectedIndex=0;
                           list_dvt_big(0);
                           document.getElementById('option_dvt_big').selectedIndex=0;
                           document.querySelector('input[name="name_dvt_big"]').value="";
                           document.querySelector('input[name="code_product"]').value="";
                           document.querySelector('input[name="name_dvt_big"]').value="";
                           document.querySelector('input[name="exchange_value"]').value="";
                           document.querySelector('input[name="photo"]').value="";
                           document.getElementById('image_product_1').style.display="none";
                           for (var i = 0; i < x.length-1; i++) {
                               if(i==4){
                                i=i+1;
                               }
                               x[i].innerHTML="";
                           }
                           var form=document.getElementsByClassName("form_s1");
                           form[0].style.display="none";
                           var z=document.getElementsByClassName("header");
                           z[0].style.display="block";
                           var table=document.getElementsByClassName("table_s1");
                           table[0].style.display="block";
                           var alert_ajax=document.getElementsByClassName("alert_ajax");
                           alert_ajax[0].style.display="block";
                           alert_ajax[0].classList.add("success");
                           alert_ajax1=alert_ajax[0].getElementsByClassName("alert_1"); 
                           alert_ajax1[0].innerHTML=data.success;
                           fadeOutEffect(alert_ajax[0]);
                        }

                    },
                });
}
function cms_pagetion_product(page){
            $.ajax({
                 type: "GET",
                 url: '?page='+ page,
                 success : function (data){
                        $('body').html(data);
                    },
            });
}
function cms_update_product(id,page){
    var name_product=document.querySelector('input[name="name_product"]').value;
    var option_list_category=document.getElementById('option_list_category').value;
    var price_sell=document.getElementById('price_sell').value.replace(/[^0-9\.]+/g, "");
    var price_buy= document.getElementById('price_buy').value.replace(/[^0-9\.]+/g, "");
    var tonkho=document.getElementById('tonkho').value.replace(/[^0-9\.]+/g, "");
    var option_list_dvt=document.getElementById('option_list_dvt').value;
    var option_dvt_big=document.getElementById('option_dvt_big').value;
    var photo=document.querySelector('input[name="photo"]').files[0];
    var name_dvt_big=document.querySelector('input[name="name_dvt_big"]').value;
    var exchange_value=document.querySelector('input[name="exchange_value"]').value.replace(/[^0-9\.]+/g, "");
    var code_product=document.querySelector('input[name="code_product"]').value;
    var token=$('meta[name="csrf-token"]').attr('content');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let form_data = new FormData();
     form_data.append('name_product',name_product);
     form_data.append('photo',photo);
     form_data.append('price_sell',price_sell);
     form_data.append('price_buy',price_buy);
     form_data.append('tonkho',tonkho);
     form_data.append('category',option_list_category);
     form_data.append('dvt',option_list_dvt);
     form_data.append('dvt_big1',option_dvt_big);
     form_data.append('name_dvt_big',name_dvt_big);
     form_data.append('exchange_value',exchange_value);
     form_data.append('code_product',code_product);
         $.ajax({
                    type: "POST",
                    url: "editproduct/"+id,
                    dataType:"json",
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function(data) {
                        if(data.error)
                        { 
                         var x=document.getElementsByClassName("form_s1");
                          x=x[0].getElementsByClassName("error");
                         if(data.error['name_product'])
                         {
                            x[0].innerHTML=data.error['name_product'];
                         }
                         if(data.error['category'])
                         {
                            x[1].innerHTML=data.error['category'];
                         }  
                          if(data.error['price_buy'])
                         {
                            x[2].innerHTML=data.error['price_buy'];
                         }  
                         if(data.error['price_sell'])
                         {
                            x[3].innerHTML=data.error['price_sell'];
                         }
                         if(data.error['dvt'])
                         {
                            x[6].innerHTML=data.error['dvt'];
                         }
                          if(data.error['exchange_value'])
                         {
                            x[8].innerHTML=data.error['exchange_value'];
                         }
                          if(data.error['name_dvt_big'])
                         {
                            x[7].innerHTML=data.error['name_dvt_big'];
                         }
                         if(data.error['code_product'])
                         x[5].innerHTML=data.error['code_product'];        
                        }
                         if(data.success)
                         {
                          var x=document.getElementsByClassName("form_s1");
                               x=x[0].getElementsByClassName("error");
                           document.querySelector('input[name="name_product"]').value="";
                           document.getElementById('option_list_category').selectedIndex =0;
                           document.getElementById('price_sell').value="";
                           document.getElementById('price_buy').value="";
                           document.getElementById('option_list_dvt').selectedIndex=0;
                           list_dvt_big(0);
                           document.getElementById('option_dvt_big').selectedIndex=0;
                           document.querySelector('input[name="name_dvt_big"]').value="";
                           document.querySelector('input[name="code_product"]').value="";
                           document.querySelector('input[name="name_dvt_big"]').value="";
                           document.querySelector('input[name="exchange_value"]').value="";
                           document.querySelector('input[name="photo"]').value="";
                           document.getElementById('image_product_1').style.display="none";
                           for (var i = 0; i < x.length-1; i++) {
                               if(i==4){
                                i=i+1;
                               }
                               x[i].innerHTML="";
                           }

                           var form=document.getElementsByClassName("form_s1");
                           form[0].style.display="none";
                           var z=document.getElementsByClassName("header");
                           z[0].style.display="block";
                           var table=document.getElementsByClassName("table_s1");
                           table[0].style.display="block";
                           var alert_ajax=document.getElementsByClassName("alert_ajax");
                           alert_ajax[0].style.display="block";
                           alert_ajax[0].classList.add("success");
                           alert_ajax1=alert_ajax[0].getElementsByClassName("alert_1"); 
                           alert_ajax1[0].innerHTML=data.success;
                           fadeOutEffect(alert_ajax[0]);
                           cms_pagetion_product(page);
                        }

                    },
                });
}
function cms_detail_product(id,page){
     $.ajax({
                 type: "GET",
                 url: 'product/'+ id,
                 success : function (data)
                 { 
                  var table=document.getElementsByClassName("table_s1");     
                  table[0].style.display="none";
                  var form=document.getElementsByClassName("form_s1");
                  form[0].style.display="block";
                  document.querySelector('input[name="name_product"]').value=data.product.name_product;
                  document.getElementById('option_list_category').value =data.product.id_category;
                  document.querySelector('input[name="code_product"]').value=data.product.code_product;
                  document.getElementById('price_sell').value=numberWithCommas(data.price[0].price_sell);
                  document.getElementById('price_buy').value=numberWithCommas(data.price[0].price_buy);
                  document.getElementById('option_list_dvt').value=data.product.id_dvt;
                  document.querySelector('input[name="tonkho"]').value=numberWithCommas(data.product.number_product);
                  if(data.product.id_dvt_big==0){
                     list_dvt_big(0);
                  }
                  else {
                    list_dvt_big(1);
                    document.getElementById('option_dvt_big').selectedIndex =1;
                    document.querySelector('input[name="name_dvt_big"]').value=data.dvt_big[0].name_dvt_big;
                    document.querySelector('input[name="exchange_value"]').value=data.dvt_big[0].exchange_value;
                  }
                  if(data.product.photo=="storage/product/default.jpg"){
                     document.getElementById('image_product_1').style.display="none";
                  }
                  else{
                     document.getElementById('image_product_1').style.display="flex";
                     var photo=document.getElementById("image_product");
                      photo.src=data.product.photo;
                  }
                   var button= form[0].getElementsByTagName("button");
                   var cms_update_product=
                   button[0].setAttribute("onclick","cms_update_product("+data.product.id+","+page+")");
                 },
            });
}

