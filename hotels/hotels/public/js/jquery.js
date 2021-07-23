$(document).ready(function(){
  $("#price_sell").keyup(function(){
  	if(Number($("#price_sell").val()).toString())
  	{
  	var x=$("#price_sell").val().replace(/[^0-9\.]+/g, "");
  	x=x.replace(/^0+/, '');
  	numberWithCommas(x);
  	$("#price_sell").val(numberWithCommas(x));
    }
    else {
    	$("#price_sell").val($("#price_sell").val().replace(/[^0-9\.]+/g, ""));
    }
  });
});
$(document).ready(function(){
  $("#price_buy").keyup(function(){
  	if(Number($("#price_buy").val()).toString())
  	{
  	var x=$("#price_buy").val().replace(/[^0-9\.]+/g, "");
  	x=x.replace(/^0+/, '');
  	numberWithCommas(x);
  	$("#price_buy").val(numberWithCommas(x));
    }
    else {
    	$("#price_buy").val($("#price_buy").val().replace(/[^0-9\.]+/g, ""));
    }
  });
});
$(document).ready(function(){
  $("#tonkho").keyup(function(){
  	if(Number($("#tonkho").val()).toString())
  	{
  	var x=$("#tonkho").val().replace(/[^0-9\.]+/g, "");
  	x=x.replace(/^0+/, '');
  	numberWithCommas(x);
  	$("#tonkho").val(numberWithCommas(x));
    }
    else {
    	$("#tonkho").val($("#tonkho").val().replace(/[^0-9\.]+/g, ""));
    }
  }); 
});		
$(document).ready(function(){
  $('input[name="exchange_value"]').keyup(function(){
    if(Number($('input[name="exchange_value"]').val()).toString())
    {
    var x=$('input[name="exchange_value"]').val().replace(/[^0-9\.]+/g, "");
    x=x.replace(/^0+/, '');
    numberWithCommas(x);
    $('input[name="exchange_value"]').val(numberWithCommas(x));
    }
    else {
      $('input[name="exchange_value"]').val($('input[name="exchange_value"]').val().replace(/[^0-9\.]+/g, ""));
    }
  }); 
});   
  
