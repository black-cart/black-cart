<script type="text/javascript">
    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-container');
    var $topeContent = $('.isotope-grid');
    var $filter = $('.filter-tope-group');
    var $grid;
    // init Isotope
    $(window).on('load', function () {
        $grid = $topeContent.each(function () {
            $(this).isotope(ConfigIsotope());
        });
    });
    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            if ($(this).hasClass('life-filter')) {
                var categoryId = filterValue.replace('.','');
                $('[name=categoryId]').val(categoryId);
                $('[name=page]').val(1);
                var data_filter = $('#sort_form').serializeArray();
                CallAjaxLoadItem(data_filter);
            }else{
                $topeContent.isotope({filter: filterValue});
            }
        });
    });
    function ConfigIsotope() {
        return {
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                }
    }

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
                $(isotopeButton[i]).parents('.active-menu').find('.sub-menu').removeClass('show');
            }
            $(this).addClass('how-active1');
            $(this).parents('.active-menu > .sub-menu').addClass('show');
        });
    });

    // sort by order
    $('.shop-sort-by').click(function(event) {
        var sort_by = $(this).data('sort');
        $('.shop-sort-by').removeClass('filter-link-active');
        $(this).addClass('filter-link-active');
        $('[name=filter_sort]').val(sort_by);
        $('[name=page]').val(1);
        var data_filter = $('#sort_form').serializeArray();
        CallAjaxLoadItem(data_filter);
    });

    // sort by price
    $('.shop-sort-price').click(function(event) {
        $('[name=page]').val(1);
        var data_filter = $('#sort_form').serializeArray();
        CallAjaxLoadItem(data_filter);
    });

    // sort by keyword
    $('.shop-sort-keyword').click(function(event) {
        var sort_keyword = $(this).data('keyword');
        $('.shop-sort-keyword').removeClass('hov-tag1-active');
        $(this).addClass('hov-tag1-active');
        $('[name=filter_keyword]').val(sort_keyword);
        $('[name=page]').val(1);
        var data_filter = $('#sort_form').serializeArray();
        CallAjaxLoadItem(data_filter);
    });
    // sort by attribute
    $('.shop-sort-attribute').click(function(event) {
        var sort_atttribute = $(this).data('attribute');
        $('.shop-sort-attribute').parent().css({
            border: 'unset',
            padding: 'unset',
            borderRadius: 'unset',
        });
        $(this).parent().css({
            border: '1px solid '+sort_atttribute,
            borderRadius: '50% ',
            padding: '1px'
        });
        $('[name=filter_attribute]').val(sort_atttribute);
        $('[name=page]').val(1);
        var data_filter = $('#sort_form').serializeArray();
        CallAjaxLoadItem(data_filter);
    });
    // paginate
    $topeContainer.on('click','.shop-paginate',function(event) {
        var page = $(this).data('page');
        $('[name=page]').val(page);
        var data_filter = $('#sort_form').serializeArray();
        CallAjaxLoadItem(data_filter);
    });

    function CallAjaxLoadItem(param) {
        $topeContainer.html("<div class='flex-c-m isotope-loading'><i class='fa fa-spinner fa-spin'></i></div>");
        $.ajax({
            url: "{{ bc_route('shop') }}",
            type: "GET",
            data: param,
            async: true,
            success: function(data){
                //$topeContainer.isotope({filter: filterValue});
                newItems = $(data).appendTo('.isotope-container');
                newItems.imagesLoaded( function() {
                    $('.isotope-loading').remove();
                    $('.isotope-grid').isotope(ConfigIsotope()).isotope('layout').isotope({ sortBy : 'random' });
                });
            }
        });
    }
</script>