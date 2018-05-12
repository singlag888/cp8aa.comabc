window.onresize = function(){
    document.getElementsByTagName('html')[0].style.fontSize = document.documentElement.clientWidth/18.75+'px';
   	document.documentElement.style.fontSize = window.innerWidth/18.75+"px";
}
$(function(){
	//开奖公告
	$('.draw_netice_title>span').eq(0).addClass('active')
	$('.draw_netice_title>span').click(function(){
		var priindex = $(this).index();
		$(this).addClass('active').siblings().removeClass();
		$('.draw_netice_list>div').eq(priindex).show().siblings('.draw_netice_list>div').hide();
	});
	
    	

})

