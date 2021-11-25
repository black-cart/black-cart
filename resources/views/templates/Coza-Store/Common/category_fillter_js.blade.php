<script type="text/javascript">
	var data = {!! $categories !!};	
	var html = '<ul class="main-menu category-menu">';
	html += '<li>'+
				'<a href="javascript:void(0)">'+
                '<button class="stext-106 cl6 hov1 bor3 trans-04 m-tb-5 how-active1 {{ isset($FilterClass)?$FilterClass:'' }}" data-filter="">'+
                    'All Products'+
                '</button>'+
                '</a>'+
            '</li>';
	function renderFillterCat() {
		var div = $('.filter-categories');

		$.each(data, function(index, val) {
			html += excuteCat(val);
		});
		html += '</ul>';
		div.html(html);
	}
	function excuteCat(val) {
		var htm = '';
			if (val['children']) {
				htm += '<li class="active-menu">'+
							'<a href="javascript:void(0)">'+
								'<button class="stext-106 cl6 hov1 bor3 trans-04 m-tb-5 {{ isset($FilterClass)?$FilterClass:'' }}" data-filter=".'+val['id']+'">'+val['title']+'</button>'+
							'</a>';
					htm += '<ul class="sub-menu">';
					$.each(val['children'], function(index, val) {
						htm += excuteCat(val);
					});
					htm += '</ul>';
				htm += '</li>';
			}else{
				htm += '<li>'+
							'<a href="javascript:void(0)">'+
								'<button class="stext-106 cl6 hov1 bor3 trans-04 m-tb-5 {{ isset($FilterClass)?$FilterClass:'' }}" data-filter=".'+val['id']+'">'
									+val['title']+
								'</button>'+
							'</a>'+
						'</li>';
			}
			return htm;
	}
	renderFillterCat();
</script>