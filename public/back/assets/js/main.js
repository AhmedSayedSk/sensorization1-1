$.fn.extend({
    treed: function (o) {

      var openedClass = 'glyphicon-chevron-down';
      var closedClass = 'glyphicon-chevron-right';

		if (typeof o != 'undefined'){
			if (typeof o.openedClass != 'undefined'){
				openedClass = o.openedClass;
			}
			if (typeof o.closedClass != 'undefined'){
				closedClass = o.closedClass;
			}
		};

		//initialize each of the top levels
		var tree = $(this);
		tree.addClass("tree");
		tree.find('li').has("ul").each(function () {
		    var branch = $(this); //li with children ul
		    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
		    branch.addClass('branch');
		    branch.on('click', function (e) {
		        if (this == e.target) {
		            var icon = $(this).children('i:first');
		            icon.toggleClass(openedClass + " " + closedClass);
		            $(this).children().children().toggle();
		        }
		        response_footer();
		    })
		    branch.children().children().toggle();
		});

        //fire event from the dynamically added icon
		tree.find('.branch .indicator').each(function(){
			$(this).on('click', function () {
			    $(this).closest('li').click();
			    response_footer();
			});
		});

        // fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch > a:not(.delete)').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                response_footer();
                e.preventDefault();
            });
        });

        // fire event to open branch if the li contains a button instead of text
        tree.find('.branch > button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                response_footer();
                e.preventDefault();
            });
        });
    }
});

function optimizeCategories(){
	$('#categories select.p-cat').on("change", function(){
		if($(this).val() != 0){
			var p_cat_id = $(this).val();
			var table_num = parseInt($(this).attr("data-table-num"));
			var max_categories = parseInt($(this).parents('#categories').attr("data-max-categories"));

			if(table_num < max_categories){
				$.ajax({
					url: "/admin/products/categories/get-data-by-method1",
					type: "POST",
					data: {
						p_cat_id: p_cat_id,
						table_num: table_num
					},
					success: function(data){
						$('select.p-cat:gt('+(table_num-1)+')').text('');
						$("<option value='0'>Choose something...</option>").appendTo('select[data-table-num="'+(table_num+1)+'"]');

						$.each(data.cat_list, function(i, val) {
							var div_data = "<option value="+i+">"+val+"</option>";
							$(div_data).appendTo('select[data-table-num="'+(table_num+1)+'"]');
							$('select[data-table-num="'+(table_num+1)+'"]').show();
						});
					}
				})
			}

			$('[type="hidden"].category-id').val(p_cat_id);
			$('[type="hidden"].cat-table-number').val(table_num);
		}
	})
}

function tags_searcher(){
	$(".tags_searcher").keyup(function(){
		var _this = $(this);

		$('.well button').each(function(){
			if($(this).hasClass('saved-tag')){
				// some code
			} else {
				$(this).remove();
			}
		});

		function storage_tags(){
        	var tags_ids = Array();

            $('.well button').each(function(){
				if($(this).hasClass('saved-tag')){
					tags_ids.push($(this).attr('data-id'));

					tags_ids = tags_ids.filter(function(item, pos) {
					    return tags_ids.indexOf(item) == pos;
					});

					$('.well [type="hidden"]').val(tags_ids + '');
				}
			});

			window.tags_ids = tags_ids;
        }

		if(_this.val().length > 0){
			$.ajax({
				url: '/admin/products/tags/view-by-keyword',
				type: 'post',
				data: {
					keyword: _this.val(),
					appended_ids: JSON.stringify(window.tags_ids)
				},
				success: function(data){
					var data = JSON.parse(data);

					for(var i in data){
						if(data[i].id !== undefined){
							$('.well').append('<button type="button" class="btn btn-default btn-sm" data-id="'+data[i].id+'">'+data[i].tag_name+'</button> ');
						}
                    }

                    $('.well button').on('click', function(){
                    	$(this).toggleClass('static-tags-btn saved-tag');
                    	storage_tags();
                    });
				}
			})
		}
	});
}
