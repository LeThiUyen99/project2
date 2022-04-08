//phương thức thanh toán mua thẻ điện thoại
$('.buyCardPaymentMethod').on('click',function(){
	var radioValue = $(this).val();
	$('#phuong_thuc_muathe').val(radioValue);
});
$('#phuong_thuc_muathe').on('click',function(){
	if ($('#phuong_thuc_muathe').hasClass('open') == false) {
		$('#dropDownList').removeClass('hidden');
		$('#phuong_thuc_muathe').addClass('open');
	}
	else{
		$('#dropDownList').addClass('hidden');
		$('#phuong_thuc_muathe').removeClass('open');
	}
	
});
$('#dropDownList').on('change',function(){
	$('#dropDownList').addClass('hidden');
	$('#phuong_thuc_muathe').removeClass('open');
});


//phương thức thanh toán nạp tiền
$('.topupPaymentMethod').on('click',function(){
	var radioValue2 = $(this).val();
	$('#phuong_thuc_naptien').val(radioValue2);

});
$('#phuong_thuc_naptien').on('click',function(){
	if ($('#phuong_thuc_naptien').hasClass('open') == false) {
		$('#dropDownList2').removeClass('hidden');
		$('#phuong_thuc_naptien').addClass('open');
	}
	else{
		$('#dropDownList2').addClass('hidden');
		$('#phuong_thuc_naptien').removeClass('open');
	}
	
});
$('#dropDownList2').on('change',function(){
	$('#dropDownList2').addClass('hidden');
	$('#phuong_thuc_naptien').removeClass('open');
});
$('#phuong_thuc_naptien').blur(function(){
	$('#dropDownList2').addClass('hidden');
	$('#phuong_thuc_naptien').removeClass('open');
});
//phương thức thanh toán nạp thẻ game
$('.buyCardGamePaymentMethod').on('click',function(){
	var radioValue3 = $(this).val();
	$('#phuong_thuc_napgame').val(radioValue3);

});
$('#phuong_thuc_napgame').on('click',function(){
	if ($('#phuong_thuc_napgame').hasClass('open') == false) {
		$('#dropDownList3').removeClass('hidden');
		$('#phuong_thuc_napgame').addClass('open');
	}
	else{
		$('#dropDownList3').addClass('hidden');
		$('#phuong_thuc_napgame').removeClass('open');
	}
	
});
$('#dropDownList3').on('change',function(){
	$('#dropDownList3').addClass('hidden');
	$('#phuong_thuc_napgame').removeClass('open');
});
$('#phuong_thuc_napgame').blur(function(){
	$('#dropDownList3').addClass('hidden');
	$('#phuong_thuc_napgame').removeClass('open');
});