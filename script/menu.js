$(document).ready(function(){
	isOpened = false;
	$("#arrow").click(function(){
		if (!isOpened){
			$("#menunavigation").css({"left": "-12px"});
			$("#arrow img").css({"transform": "rotateZ(180deg)"});
			isOpened = true;
		}
		else{
			$("#menunavigation").css({"left": "-250px"});
			$("#arrow img").css({"transform": "rotateZ(0deg)"});
			isOpened = false;
		}
	});
});