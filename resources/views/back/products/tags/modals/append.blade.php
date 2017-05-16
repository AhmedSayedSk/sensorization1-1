<?php
	/* Translation */
	$TR = "admin_panel.APATM";
?>

<div id="append-new-tag" class="content">
	<div class="alert alert-danger errors-section" role="alert"></div>
	<div class="form-group">
		<label for="tagName">{{ trans("$TR.T1") }}</label>
		<div class="input-group">
	      <input name="tag_name" type="text" class="form-control" id="tagName" placeholder='{{ trans("$TR.T2") }}'>
	      <span class="input-group-btn">
	        <button class="btn btn-success set-tagName" type="button">{{ trans("$TR.T3") }}</button>
	      </span>
	    </div>
	</div>
	<p class="success-message text-success">{{ trans("$TR.T4") }}</p>
	<div class="tags-container"><div>
</div>

<script type="text/javascript">
	var parent = $("#append-new-tag");

	parent.find(".set-tagName").on("click", function(){

		var data = {
			tag_name: $('input[name="tag_name"]').val()
		};

		$.ajax({
			url: '/admin/products/tags',
			type: 'POST',
			data: data,
			success: function(data){
				parent.find('.errors-section').slideUp(250).text("");
				parent.find('.success-message').slideDown(250).delay(2500).slideUp(250);
				parent.find('.tags-container').append("<span>" + data.tag_name + "</span> ");
			},
			error: function(data){
				parent.find('.errors-section').text(data.responseJSON.message).slideDown(250);
			}
		});
	});
</script>