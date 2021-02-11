
/*Album post */
function popup_open(id)
{
	$.ajax({
			  url: "http://gautambook.com/viewalbum/view_album_popup",
			  async: false,
			  type: "POST",
			  data: "albums_id="+id,
			  dataType: "html",
			  success: function(data) {
			  	jQuery('#popup_content').html(data);
				
				jQuery(".demos").fadeIn(1000);  
				jQuery('#backgroundPopup').css("opacity","0.7");
				jQuery('#backgroundPopup').css("display","block");
			  }
			});

}
//all_metrimonial_popup edit()

function all_metrimonial_popup(id) 
{
	 
	$.ajax({
			  url: "http://gautambook.com/adminmatrimonial/get_metrimonial_datas",
			  async: false,
			  type: "POST",
			  data: "metrimonial_id="+id,
			 
			  dataType: "html",
			  success: function(data) {
			  	jQuery('#popup_content').html(data);
				
				jQuery(".demos").fadeIn(1000);  
				jQuery('#backgroundPopup').css("opacity","0.7");
				jQuery('#backgroundPopup').css("display","block");
			  }
			});
	
}

//all_metrimonial_popup edit()

function alls_metrimonial_popup(id) 
{
	 
	$.ajax({
			  url: "http://gautambook.com/matrimoniallist/get_metrimonial_datass",
			  async: false,
			  type: "POST",
			  data: "metrimonial_id="+id,
			 
			  dataType: "html",
			  success: function(data) {
			  	jQuery('#popup_content').html(data);
				
				jQuery(".demos").fadeIn(1000);  
				jQuery('#backgroundPopup').css("opacity","0.7");
				jQuery('#backgroundPopup').css("display","block");
			  }
			});
	
}



/* edit post */

function edit_post_popup_open(id)
{
	$.ajax({
      url: "http://gautambook.com/dashboard/get_post_datas",
      async: false,
      type: "POST",
      data: "edit_post="+id,
      dataType: "html",
      success: function(data) { 
		var post_info = data;
		//alert(payinfo)
		var split = post_info.split("&");
		var post_nm =  split[0];
		var post_content = split[1];
		jQuery('#posted_title').val(post_nm);
		jQuery('.edit_data').val(post_content);
		jQuery('.edit_posted_ids').val(id);
		jQuery('.demos').show();
		jQuery('#backgroundPopup').css("opacity","0.7");
		jQuery('#backgroundPopup').css("display","block");	


      }
    });
				


}

jQuery(document).ready(function(){

 jQuery(".closed").click(function(){
		
		jQuery('.demos').hide();
	 jQuery('#backgroundPopup').hide();
    });
	
jQuery("#backgroundPopup").click(function() {
			jQuery('.demos').hide();
			jQuery('#backgroundPopup').hide();
	});
	
});

function popalbum()
{
	jQuery('.demos.albumpopup').show();
	$(".demos.albumpopup").fadeIn('slow');
	jQuery('#backgroundPopup').css("opacity","0.7");
	jQuery('#backgroundPopup').css("display","block");	
}

///////////   metrimonial_popup login//////////////

function metrimonial_popup()
{
	jQuery('.demos.metrimonialpopup').show();
	$(".demos.metrimonialpopup").fadeIn('slow');
	jQuery('#backgroundPopup').css("opacity","0.7");
	jQuery('#backgroundPopup').css("display","block");	
}


///////////////// Address_link login_form popup/////////////
function Address_link()
{
	jQuery('.demos.Address').show();
	$(".demos.Address").fadeIn('slow');
	jQuery('#backgroundPopup').css("opacity","0.7");
	jQuery('#backgroundPopup').css("display","block");	
}