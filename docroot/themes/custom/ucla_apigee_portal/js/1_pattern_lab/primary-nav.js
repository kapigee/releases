import jQuery from 'jquery';

(($ => {

  const $sublistItem = $('.nav-primary__sublist');
  const $toggle = $('.nav-primary__toggle');
  const breakpoint = 1024;

  // Hide sub items in small device sizes
  $sublistItem.addClass('nav-primary__sublist--hidden');

  // Show nav children on click of toggle
  $toggle.on('click', function () {
    $(this).siblings('.nav-primary__sublist').toggleClass('nav-primary__sublist--hidden');
    $(this).toggleClass('is-open');
  });

  // Evaluate mobile sub nav states on page load
  evalNav($(window).width());

  // Run evaluation on page resize
  $(window).resize(function () {
    evalNav($(window).width());
  });

  // Hide open mobile sub navs above browser width 1024px
  function evalNav(windowWidth) {

    if (windowWidth >= breakpoint) {
      $sublistItem.addClass('nav-primary__sublist--hidden');
      $toggle.removeClass('is-open');
    }
  }

}))(jQuery);
