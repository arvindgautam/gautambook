jQuery(document).ready(function(){
  jQuery('#sames').click(function() { 
  if(document.getElementById('sames').checked) {
    jQuery("#same_add").show();
	jQuery("#current_vill").attr("required","true");
	jQuery("#current_post").attr("required","true");
	jQuery("#current_dist").attr("required","true");
	jQuery("#current_state").attr("required","true");
	} else {
    jQuery("#same_add").hide();
	jQuery("#current_vill").removeAttr("required");
	jQuery("#current_post").removeAttr("required");
	jQuery("#current_dist").removeAttr("required");
	jQuery("#current_state").removeAttr("required");
	}
});
});


function signup_submit()
{
	var pass = jQuery("#user_pass").val();
	var cun_pass = jQuery("#user_con_pass").val();
	if(pass != cun_pass)
	{
		var msg = '<div class="error"><p>Your password and confirm password do not match!</p></div>';
		document.getElementById("messg").innerHTML=msg;
		return false;
	}
}
// user profile image upload
jQuery(document).ready(function (e) {
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
$('#loading').show();
$.ajax({
url: "/assets/ajax/ajax_image.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$("#message").html(data);
}
});
}));

// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$('#user_photo').hide(); 
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '90px');
$('#previewing').attr('height', '90px');
};
});

// user profile cover image

jQuery(document).ready(function (e) {
$("#uploadcoverimage").on('submit',(function(e) {
e.preventDefault();
$("#messages").empty();
$('#loading').show();
$.ajax({
url: "http://gautambook.isprasoft.com/assets/ajax/ajax_cover_image.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$("#messages").html(data);
}
});
}));

// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#messages").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#cover_previewing').attr('src','noimage.png');
$("#messages").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$('#user_cover_image').hide(); 
$("#file").css("color","green");
$('#cover_image_preview').css("display", "block");
$('#cover_previewing').attr('src', e.target.result);
$('#cover_previewing').attr('width', '90px');
$('#cover_previewing').attr('height', '90px');
};
});

//function add_photo() {
   // document.getElementById("craete_post").css = ("display","none");
//}
function add_photo()
{   
		jQuery('#img_up').show();

}
function add_album()
{
 
		jQuery('#img_up').hide();
		
 }
 
 // edit gotra
 
 function edit_gotra(id)
 {
	 var gotra_data = id;
	 var gotra = gotra_data.split(",");
	 var gotra_ids = gotra[0];
	 var gotra_nm = gotra[1];
	 jQuery('#gotra_id').val(gotra_ids);
	 jQuery('#edit_gotra_nm').val(gotra_nm);
	 jQuery('#add_gotra').hide();
	 jQuery('#edit_gotra').show();
	
 }
  /* edit country
 
 function edit_country(id)
 {
	 var gotra_data = id;
	 var gotra = gotra_data.split(",");
	 var country_ids = gotra[0];
	 var country_nm = gotra[1];
	 jQuery('#gotra_id').val(country_ids);
	 jQuery('#edit_gotra_nm').val(country_nm);
	 jQuery('#add_gotra').hide();
	 jQuery('.country-edit').hide();
	 jQuery('#edit_gotra').show(); 
	
 } */
 
 //edit relation
 function edit_relation(id)
  {
	 var relation_data = id;
	 var gotra = relation_data.split(",");
	 var relation_ids = gotra[0];
	 var relation_nm = gotra[1];
	 jQuery('#relation_id').val(relation_ids);
	 jQuery('#edit_relation_nm').val(relation_nm);
	 jQuery('#add_relation').hide();
	 jQuery('#edit_relation').show();
	
 }
 //edit_member_details

 
 //   delete_relation
 
 function delete_relation(id)
{
	var admin_option = id.value;
	var result = confirm("Are sure want to delete Relation");
	if (result) {
	
$.ajax({
	
      url: "http://gautambook.isprasoft.com/relations/delete_relation",
      async: false,
      type: "POST",
      data: "relation_id="+id,
      dataType: "html",
      success: function(data) {
	  location.reload();
      }
    });
	}
}

 //   delete_upload file
 
 function delete_uploads(id)
{
	var admin_option = id.value;
	var result = confirm("Are sure want to uploaded file");
	if (result) {
	
$.ajax({
	
      url: "http://gautambook.isprasoft.com/upload/delete_upload",
      async: false,
      type: "POST",
      data: "upload_id="+id,
      dataType: "html",
      success: function(data) {
	  location.reload();
      }
    });
	}
}
 // delete gotra 
 
function delete_gotra(id)
{
	var admin_option = id.value;
	var result = confirm("Are suer want to delete Gotra");
	if (result) {
	
$.ajax({
	
      url: "http://gautambook.isprasoft.com/gotra/delete_gotra_process",
      async: false,
      type: "POST",
      data: "id="+id,
      dataType: "html",
      success: function(data) {
		location.reload();  
 
      }
    });
	}
}

 // delete country
 
function delete_country(id)
{
	var admin_option = id.value;
	
	var result = confirm("Are suer want to delete country");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/addcountry/delete_country",
      async: false,
      type: "POST",
      data: "country_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}

 // delete new
 
function delete_new(id)
{
	var admin_option = id.value;
	
	var result = confirm("Are suer want to delete country");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/latestnews/delete_news",
      async: false,
      type: "POST",
      data: "new_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}

///////////////delete_state/////////////////////

function delete_states(id)
{
	var admin_option = id.value;
	
	var result = confirm("Are suer want to delete country");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/addstate/delete_state",
      async: false,
      type: "POST",
      data: "state_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}

///////////////delete_district/////////////////////

function delete_district(id)
{
	var admin_option = id.value;
	
	var result = confirm("Are suer want to delete country");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/adddistrict/delete_districts",
      async: false,
      type: "POST",
      data: "district_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}

///////////////////delete_villages//////////////////

function delete_villagess(id)
{
	var admin_option = id.value;
	
	var result = confirm("Are suer want to delete country");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/addvillage/delete_villages",
      async: false,
      type: "POST",
      data: "village_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}

// delete_family_mamber

function delete_family_mamber(id)
{
	var admin_option = id.value;
	var result = confirm("Are suer want to delete family member");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/familylist/delete_family_member",
      async: false,
      type: "POST",
      data: "member_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}
	// delete matrimonial
function delete_matrimonial(id)
{
	var admin_option = id.value;
	var result = confirm("Are you sure you want to delete matrimonial member");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/matrimoniallist/delete_matrimonial",
      async: false,
      type: "POST",
      data: "id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}
//delete achievement
function delete_achievement(id)
{
	var admin_option = id.value;
	var result = confirm("Are you sure you want to delete your Achievement");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/listachievement/delete_achievement",
      async: false,
      type: "POST",
      data: "id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}
// delete albums 

function delete_album(id)
{
	var admin_option = id.value;
	
	var result = confirm("Are suer want to delete album");
	if (result) {

$.ajax({
	
      url: "http://gautambook.isprasoft.com/allalbums/delete_album",
      async: false,
      type: "POST",
      data: "album_id="+id,
      dataType: "html",
      success: function(data) { 
	 location.reload();
      } 
	 
    });
	}
}
 
// post like
function posts_like(id){
//alert(id);

$.ajax({
      url: "http://gautambook.isprasoft.com/dashboard/post_like",
      async: false,
      type: "POST",
      data: "post_id="+id,
      dataType: "html",
      success: function(data) {
			
			jQuery('#user_liked'+id).html(data);
			jQuery('#like_this'+id).html('You and ');
			jQuery('.like-btn'+id).html('<button id="'+id+'" class="btn-default btn-xs active" type="button" onclick="posts_unlike(this.id)"><i class="fa fa-thumbs-o-down"></i>Like</button>');
      }
    });
	return false;
}
function posts_unlike(id){
//alert(id);
$.ajax({
      url: "http://gautambook.isprasoft.com/dashboard/post_like",
      async: false,
      type: "POST",
      data: "post_id="+id,
      dataType: "html",
      success: function(data) {
		  
          jQuery('#user_liked'+id).html(data);
		  jQuery('#like_this'+id).html('');
		  jQuery('.like-btn'+id).html('<button id="'+id+'" class="btn-default btn-xs" type="button" onclick="posts_like(this.id)"><i class="fa fa-thumbs-o-up"></i>Like</button>');
      }
    });
	return false;
}


// comment submit

function cmt_post_id(id)
{
jQuery("#comment_submit"+id).on('submit', function (e) {
var comment = jQuery('.post_comments'+id).val();

var comment_data = comment+','+id;
if(comment!='')
{
$.ajax({
      url: "http://gautambook.isprasoft.com/dashboard/post_comment",
      async: false,
      type: "POST",
      data: "postid="+comment_data,
      dataType: "html",
      success: function(data) {
          jQuery('.demo'+id).append(data);
		  jQuery('.post_comments'+id).val("");
      }
	  
    });
	return false;
}
});
}

// active deactive user

function active_user(id)
{
	
	var admin_option = id.value;
	
	//alert(admin_option)
$.ajax({
	
      url: "http://gautambook.isprasoft.com/registeruser/active_user",
      async: false,
      type: "POST",
      data: "user_id="+admin_option,
      dataType: "html",
      success: function(data) {
         alert(data);
		 
      }
    });
} 

// delete user 
function deletes_user(id)
{
	var admin_option = id.value;
	var result = confirm("Are you sure! you want to delete user");
	if (result) {
$.ajax({
	
      url: "http://gautambook.isprasoft.com/registeruser/deletes_user",
      async: false,
      type: "POST",
      data: "user_id="+id,
      dataType: "html",
      success: function(data) {
         
		  
      }
    });
	}
}


function approved_user(id)
{
	
$.ajax({
      url: "http://gautambook.isprasoft.com/viewprofile/approved_user",
      async: false,
      type: "POST",
      data: "ids="+id,
      dataType: "html",
      success: function(data) {
      alert(data);
		 
      }
    });
	
} 



jQuery(document).ready(function(){
jQuery("#selectall").change(function(){
			
			jQuery("#selected tbody input[type=checkbox]").prop('checked',this.checked);
			
			callback_set_stud_ids();
			
		});

});

	function callback_set_stud_ids()
	{
		var array_stud_ids = [];
		jQuery("#selected tbody input[type=checkbox]:checked").each(function(){
           
		   array_stud_ids.push(this.id);
		   
        });
		
		jQuery("#show_mail_id").val(array_stud_ids);
	}
	
	
function delete_mail_inbox()
{
	var delete_row = jQuery('#show_mail_id').val();
	//alert(delete_row);
	var result = confirm("Are you sure! you want to delete Message");
	if (result) {
		$.ajax({
		  url: "http://gautambook.isprasoft.com/inbox/mail_inbox_delete",
		  async: false,
		  type: "POST",
		  data: "mail_ids="+delete_row,
		  dataType: "html",
		  success: function(data) { 
			alert(data);
			location.reload(); 
		  }
		});
	}
}

function ajaxSearch() {
		var input_data = $('#search_data').val();
		if (input_data.length === 0) {
			$('#suggestions').hide();
		} else {

			var post_data = {
				'search_data': input_data,
			};

			$.ajax({
				type: "POST",
				url: "http://gautambook.isprasoft.com/login/search_profile",
				data: post_data,
				success: function(data) {
					// return success
					if (data.length > 0) {
						$('#suggestions').show();
						$('#autoSuggestionsList').addClass('auto_list');
						$('#autoSuggestionsList').html(data);
					}
				}
			});

		}
	}
	
jQuery(document).ready(function(){
    jQuery("#f-names").keyup(function(){
	var names = jQuery('#f-names').val();
	if(names==' ')
	{
		var user_nm = names.trim();
		jQuery('#f-names').val(user_nm);
	}
    });
	
	jQuery("#l-names").keyup(function(){
	var names = jQuery('#l-names').val();
	if(names==' ')
	{
		var user_nm = names.trim();
		jQuery('#l-names').val(user_nm);
	}
    });
	
	jQuery("#phones").keyup(function(){
	var names = jQuery('#phones').val();
	if(names==' ')
	{
		var user_nm = names.trim();
		jQuery('#phones').val(user_nm);
	}
    });
	
	jQuery("#fat-names").keyup(function(){
	var names = jQuery('#fat-names').val();
	if(names==' ')
	{
		var user_nm = names.trim();
		jQuery('#fat-names').val(user_nm); 
	}
    });

});


// send friend request
function send_friend_req(id)
{
jQuery('#imgs_load').show();
$.ajax({
      url: "http://gautambook.isprasoft.com/userprofile/add_friends",
      async: false,
      type: "POST",
      data: "users_id="+id,
      dataType: "html",
      success: function(data) { 
      jQuery('#request_sent').html(data);
		jQuery('#imgs_load').hide();
      }
    });
	
}

// accept friend request
function accept_friend_req(id)
{
jQuery('#request_action').hide();
jQuery('#imgs_load').show();
$.ajax({
      url: "http://gautambook.isprasoft.com/userprofile/friend_request_accept",
      async: false,
      type: "POST",
      data: "users_id="+id,
      dataType: "html",
      success: function(data) { 
      jQuery('#request_sent').html(data);
		jQuery('#imgs_load').hide();
		jQuery('#'+id).hide();
      }
    });
	
} 

// unfriend 
function send_friend_req_cancel(id)
{
jQuery('#request_action').hide();
jQuery('#imgs_load').show();
$.ajax({
      url: "http://gautambook.isprasoft.com/userprofile/user_unfriend",
      async: false,
      type: "POST",
      data: "users_id="+id,
      dataType: "html",
      success: function(data) { 
      jQuery('#unfriend_req').html(data);
		jQuery('#imgs_load').hide();
		
      }
    });
	
} 

// do'nt accept cancel request
function friend_cancel(id)
{
jQuery('#request_action').hide();
jQuery('#imgs_load').show();
$.ajax({
      url: "http://gautambook.isprasoft.com/userprofile/user_unfriend",
      async: false,
      type: "POST",
      data: "users_id="+id,
      dataType: "html",
      success: function(data) { 
      jQuery('#request_sent').html(data);
	  jQuery('#'+id).hide();
		jQuery('#imgs_load').hide();
		
      }
    });
	
}

function message_replay()
{
	jQuery('#replay').show();
	jQuery('#read_msgs').hide();
	
}

function inbox_mail_search()
{
	var search_val = jQuery('#seach_mail').val();
	//alert(search_val);
	$.ajax({
      url: "http://gautambook.isprasoft.com/inbox/mails_search",
      async: false,
      type: "POST",
      data: "search_mail="+search_val,
      dataType: "html",
      success: function(data) { 
      jQuery('#searched_data').html(data);
      }
    });
}

function read_more(post_id)
{
	jQuery('.pst_content'+post_id).hide();
	jQuery('.post_contented'+post_id).show();
	jQuery('.count_read'+post_id).hide();
}

function edit_post()
{
	
	var edit_text_post = jQuery('.edit_data').val();
	
	var post_cont = edit_text_post.replace(/\n/g, "<br>");

	var edit_post_title = jQuery('#posted_title').val();
	var id = jQuery('.edit_posted_ids').val();
	var edit_post_data = id+'%/%'+edit_post_title+'%/%'+edit_text_post;
	//alert(edit_post_data);
	$.ajax({
      url: "http://gautambook.isprasoft.com/dashboard/edit_user_post",
      async: false,
      type: "POST",
      data: "edit_post_cont="+edit_post_data,
      dataType: "html",
      success: function(data) { 
	  //alert(data);	
      jQuery('#ajax_post'+id).html(edit_post_title);
	  jQuery('.pst_content'+id).html(post_cont);
		jQuery('.demos').hide();
		jQuery('#backgroundPopup').hide();
      }
    });

}

 function delete_Post(id)
{ 
	
	var admin_option = id.value;
	var result = confirm("Are you sure! you want to delete post");
	if (result) {
$.ajax({
	
      url: "http://gautambook.isprasoft.com/dashboard/delete_post",
      async: false,
      type: "POST",
      data: "post_id="+id,
      dataType: "html",
      success: function(data) {
	  window.location.reload(true); 
      }
    });
	}
}

function next_inbox_msg()
{
	 var ID = jQuery(".all_mail_ids:last").attr("id");
	  jQuery(".all_mail_remove").removeClass("all_mail_ids");
	  alert(ID);

}

////////////metrimonial form/////////////////
jQuery(document).ready(function (e) {
jQuery("#metri-form").on('submit',(function(e) {
 var dd = jQuery("#name").val();
 if(dd=='')
 {
    jQuery("#name").attr("required","true");
	return false;
 }
	
 var dd1 = jQuery("#father-name").val();
 if(dd1=='')
 {
 

    jQuery("#father-name").attr("required","true");
	return false;
 }
	 var dd2 = jQuery("#father-name").val();
 if(dd2=='')
 {
 
 
    jQuery("#matri-gender").attr("required","true");
	return false;
 }
 
 	 var dd3 = jQuery("#phone_no").val();
 if(dd3=='')
 {
 
 
    jQuery("#phone_no").attr("required","true");
	return false;
 }
 
	 var dd4 = jQuery("#current_address").val();
 if(dd4=='')
 {
 
    jQuery("#current_address").attr("required","true");
	return false;
 }

	 var dd5 = jQuery("#metri_dob").val();
 if(dd5=='')
 {
 
 
    jQuery("#metri_dob").attr("required","true");
	return false;
 } 
 	 var dd6 = jQuery("#metri_dob_day").val();
 if(dd6=='')
 {
 

    jQuery("#metri_dob_day").attr("required","true");
	return false;
 } 
 	 
	var dd7 = jQuery("#metri_dob_month").val();
 if(dd7=='')
 {
 
 
    jQuery("#metri_dob_month").attr("required","true");
	return false;
 } 
 
 	var dd8 = jQuery("#metri_dob_year").val();
 if(dd8=='')
 {
 
 
    jQuery("#metri_dob_year").attr("required","true"); 
	return false;
 } 
  	var dd9 = jQuery("#metri_mother_gotra").val();
 if(dd9=='')
 {
 
 
    jQuery("#metri_mother_gotra").attr("required","true"); 
	return false;
 }
	
	  	var dd10 = jQuery("#metri_father_gotra").val();
 if(dd10=='')
 {
 
 
    jQuery("#metri_father_gotra").attr("required","true"); 
	return false;
 }
 
 var dd11 = jQuery("#metri_prof").val();
 if(dd11 =='')
 {

    jQuery("#metri_prof").attr("required","true"); 
	return false;
 }
 
 var dd12 = jQuery("#qualification_metri").val();
 if(dd12 =='')
 {

    jQuery("#qualification_metri").attr("required","true"); 
	return false;
 }
 
 
 }));
}); 
	
	
