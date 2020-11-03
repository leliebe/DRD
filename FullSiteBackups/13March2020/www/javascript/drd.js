$(function () { //Get authors on page load.
	if($('.content').is('.Author_Search')){
		// alert("Author_Search");
		$.ajax({
		    type: "POST",
		    url: './database/db_query.php',
		    data: {query_name: "Authors"},
		    success: function(data){
					// $('.auth-pl-plays').html(data);
					// for (var i=0;i<data.length;i++){
					//    option += '<option value="'+ data[i] + '">' + data[i] + '</option>';
					// }
					// $('.auth-pl-plays').append(option);
			}
		});
	}
});

// var $dropdown = $(".auth-sel");
// $.each(result, function() {
//     $dropdown.append($("<option />").val(this.ImageFolderID).text(this.Name));
// });

// Get all plays by author last name.
function qry_plays(){
	var author = $.trim($(".auth-sel :selected").text()).split(',');
	var author_lname = $.trim(author[0]);
	var author_fname = $.trim(author[1]);
	var author_name = author[1] + " " + author[0];
	$('.aplaname').html(author_name);
	$('.aplheading').html('List of Plays:');
	$.ajax({
	    type: "POST",
	    url: './database/db_query.php',
		data: {function_name: 'get_plays',
			   field1: author_fname,
			   field2: author_lname
		   	  },
	    success: function(data){
			$('.auth-pl-plays').html(data);
	    }
	});
}

// function qry_play_text(){
// 	var author = $.trim($(".auth-sel :selected").text()).split(',');
// 	var author_lname = $.trim(author[0]);
// 	var author_fname = $.trim(author[1]);
// 	var author_name = author[1] + " " + author[0];
// 	$('.aplaname').html(author_name);
// 	$('.aplheading').html('List of Plays:');
// 	$.ajax({
// 	    type: "POST",
// 	    url: './database/db_query.php',
// 		data: {function_name: 'get_play_text',
// 			   field1: author_fname,
// 			   field2: author_lname
// 		   	  },
// 	    success: function(data){
// 			$('.auth-pl-plays').html(data);
// 	    }
// 	});
// }

$(function () {
	$('.auth-pl-plays').on('click', 'a', function () {
		var play_title = $(this).text();
		// $('.apltitle').html(play_title);
		$.ajax({
		    type: "POST",
		    url: './database/db_query.php',
			data: {function_name: 'get_play_text',
				   field1: play_title
			   	  },
		    success: function(data){
				// alert(data);

				$('.auth-play').html(data);
		    }
		});
	});
});

// function qry_title(){
// 	$.ajax({
// 		type: "POST",
// 		url: './database/db_query.php',
// 		data: {query_name: "Titles"},
// 		success: function(data){
// 				$('.results').html(data);
// 	    }
// 	});
// }
