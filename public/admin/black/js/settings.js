$(document).ready(function() {
  $().ready(function() {
    $sidebar = $('.sidebar');
    $navbar = $('.navbar');
    $main_panel = $('.main-panel');

    $full_page = $('.full-page');

    $sidebar_responsive = $('body > .navbar-collapse');

    $sidebar_mini_active = JSON.parse(localStorage.getItem("sidebar_mini_active"));

    $white_color = JSON.parse(localStorage.getItem("theme_active"));

    window_width = $(window).width();

    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



    $('.fixed-plugin a').click(function(event) {
      if ($(this).hasClass('switch-trigger')) {
        if (event.stopPropagation) {
          event.stopPropagation();
        } else if (window.event) {
          window.event.cancelBubble = true;
        }
      }
    });

    $('.fixed-plugin .background-color span').click(function() {
      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('color');

      localStorage.setItem("bar_color", new_color);

      if ($sidebar.length != 0) {
        $sidebar.attr('data', new_color);
      }

      if ($main_panel.length != 0) {
        $main_panel.attr('data', new_color);
      }

      if ($full_page.length != 0) {
        $full_page.attr('filter-color', new_color);
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.attr('data', new_color);
      }
    });

    if ($sidebar_mini_active == true) {
        $('body').addClass("sidebar-mini");
        $('.switch-sidebar-mini input').prop('checked', true).change();
    }else{
        $('body').removeClass("sidebar-mini");
    }

    if (localStorage.getItem("bar_color")) {
      $sidebar.attr('data', localStorage.getItem("bar_color"));
      $main_panel.attr('data', localStorage.getItem("bar_color"));
    }

    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
      var $btn = $(this);

      if ($sidebar_mini_active == true) {
        localStorage.setItem("sidebar_mini_active", false);
        $sidebar_mini_active = false;
        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
        $('body').removeClass('sidebar-mini');
      }else {
        localStorage.setItem("sidebar_mini_active", true);
        $sidebar_mini_active = true;
        blackDashboard.showSidebarMessage('Sidebar mini activated...');
        $('body').addClass('sidebar-mini');
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });


    if ($white_color == true) {
        $('body').addClass('white-content');
        $('.switch-change-theme input').prop('checked', true).change();
        $white_color = true;
    }
    $('.switch-change-theme input').on("switchChange.bootstrapSwitch", function() {
    
      if ($white_color == true) {
        $('body').addClass('change-background');
        setTimeout(function() {
          $('body').removeClass('change-background');
          $('body').removeClass('white-content');
          blackDashboard.showSidebarMessage('Black theme activated...');
        }, 900);
        $white_color = false;
      } else {
        $('body').addClass('change-background');
        setTimeout(function() {
          $('body').removeClass('change-background');
          $('body').addClass('white-content');
          blackDashboard.showSidebarMessage('White theme activated...');
        }, 900);

        $white_color = true;
      }
      localStorage.setItem("theme_active", $white_color);
    });


    $('.light-badge').click(function() {
      $('body').addClass('white-content');
    });

    $('.dark-badge').click(function() {
      $('body').removeClass('white-content');
    });
    $('.sidebar-wrapper').find('.active').parents('li').addClass('active');
    $('.sidebar-wrapper').find('.active').parents('.collapse').addClass('show');
  });
});