
function showFlashMessage(msg,err){
	if(err){$("#flash-message").addClass("errmsg");}
	else {$("#flash-message").removeClass("errmsg");}
	$("#flash-message label").html(msg);
    $("#flash-message").slideDown(function(){
		setTimeout(	'$("#flash-message").slideUp()' ,3000);
	});
}

function showError(elem,errmsg){
	$("#em"+elem.attr('id')).remove();
	elem.parent().append('<span class="frmerr" id="em'+elem.attr('id')+'">'+errmsg+'</span>');	
	elem.addClass('inputalert');
	$('html, body').animate({
         scrollTop: elem.parent().offset().top 
     }, 500);
	 //return false;
	//alert(elem.parent().html());
}

$(document).ready(function(e) {
    $("input,select").each(function(){ 
		$(this).change(function(e) {	 
            if(this.value!=""){
				$("#em"+this.id).remove();
				$(this).removeClass('inputalert');
			}
        });
	});
});
function checkSelects(){
 
 	var checkedRecords=false;	
	$(".elem_ids").each(function(index, element) {
        if(this.checked==true){
			checkedRecords=true;
		}
    });
	
	if(!checkedRecords){
		showFlashMessage("Please select records",1);
		//alert("Please select records");
		return false;	
	}else{
		if(!confirm("Are you sure you want to delete these records")){
			return false;
		}
	}
}

$(document).ready(function(e) {
    $("#chk_all").change(function(e) {
		chkAll=this ;
		$(".elem_ids").each(function(index, element) {
            this.checked=chkAll.checked ;
        });
      
    });
	
	if(window.FileReader){
	
		$(".filefield").css({"width":"0px","height":"0px","opacity":0});
	}
});

function globalStatus(chkAll){
 
   
 
 	if($(chkAll).hasClass("status-1")){
			var status=0
			$(chkAll).addClass("status-0");
			$(chkAll).removeClass("status-1");
	}else{
		var status=1
			$(chkAll).addClass("status-1");
			$(chkAll).removeClass("status-0");
	}
	
	vars=	$(chkAll).attr("id").split("-");
	title=	$(chkAll).attr("title") ;
	
	
	
	
	
	scriptUrl=baseUrl+"/admin/ajax/setstatus/type/"+vars[0]+"/id/"+vars[1]+"/status/"+status;
  //alert(scriptUrl);
  if(title!==undefined && title!=""){usermessage=title+" has been changed";}
  else{usermessage='<b>'+vars[0]+'</b>  status has been changed';}
	$("#flash-message").slideUp();
	$.ajax({
		url: scriptUrl,
		success: function(data) {
		showFlashMessage(usermessage);
  	},
   	error : function(data) {
		
	}
  
});
		
}

function setSearchFilterStyle(chkAll){
	
	if($(chkAll).hasClass("status-1")){
			var status=0
			$(chkAll).addClass("status-0");
			$(chkAll).removeClass("status-1");
	}else{
		var status=1
			$(chkAll).addClass("status-1");
			$(chkAll).removeClass("status-0");
	}
	
	vars=	$(chkAll).attr("id").split("-");
	title=	$(chkAll).attr("title") ;
	
	
	
	
	
	scriptUrl=baseUrl+"/admin/ajax/setstatus/type/"+vars[0]+"/id/"+vars[1]+"/status/"+status;
  //alert(scriptUrl);
  if(title!==undefined && title!=""){usermessage=title+" has been changed";}
  else{usermessage='<b>'+vars[0]+'</b>  status has been changed';}
	$("#flash-message").slideUp();
	$.ajax({
		url: scriptUrl,
		success: function(data) {
		showFlashMessage(usermessage);
  	},
   	error : function(data) {
		
	}
  
});
	
}

function globalFeatured(chkAll){
 
  	if($(chkAll).hasClass("featured-1")){
			var status=0
			$(chkAll).addClass("featured-0");
			$(chkAll).removeClass("featured-1");
	}else{
		var status=1
			$(chkAll).addClass("featured-1");
			$(chkAll).removeClass("featured-0");
	}
	
	vars=	$(chkAll).attr("id").split("-");
	title=	$(chkAll).attr("title") ;
	
	
	
	
	
	scriptUrl=baseUrl+"/admin/ajax/setfeatured/type/"+vars[0]+"/id/"+vars[1]+"/status/"+status;
  //alert(scriptUrl);
  if(title!==undefined && title!=""){usermessage=title+" has been changed";}
  else{usermessage='<b>'+vars[0]+'</b>  status has been changed';}
	$("#flash-message").slideUp();
	$.ajax({
		url: scriptUrl,
		success: function(data) {
		showFlashMessage(usermessage);
  	},
   	error : function(data) {
		
	}
  
});
		
      
	  
	  
    
	
	
 	
}

$(document).ready(function(e) {
    $(".rec-status").click(function(e) {
 		 
  		chkAll=this ;
		if($(this).hasClass("status-1")){
				var status=0
				$(this).addClass("status-0");
				$(this).removeClass("status-1");
		}else{
			var status=1
				$(this).addClass("status-1");
				$(this).removeClass("status-0");
		}
	vars=	$(this).attr("id").split("-");
	title=	$(this).attr("title") ;
	
	
	
	
	
	scriptUrl=baseUrl+"/admin/ajax/setstatus/type/"+vars[0]+"/id/"+vars[1]+"/status/"+status;
  //alert(scriptUrl);
  if(title!==undefined && title!=""){usermessage=title+" has been changed";}
  else{usermessage='<b>'+vars[0]+'</b>  status has been changed';}
	$("#flash-message").slideUp();
	$.ajax({
		url: scriptUrl,
		success: function(data) {
		showFlashMessage(usermessage);
  	},
   	error : function(data) {
		
	}
  
});
		
      
    });
});





function prn(obj){
	str =''; for (var key in obj) {  str+='['+key+']=>'+(obj[key])+'\n';}	alert(str);
}