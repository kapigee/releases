import jQuery from 'jquery';

(($ => {

  const breakpoint = 1024;

  closeMobileMenu($(window).width());

  $(window).resize(function () {
    closeMobileMenu($(window).width());
  });

  $('.hamburger').on('click', function () {
    $('.header__navbar').toggleClass('header__navbar--open');
  });

  function closeMobileMenu(windowWidth) {

    if (windowWidth >= breakpoint) {
      $('.header__navbar').removeClass('header__navbar--open');
    }
  }

}))(jQuery);
