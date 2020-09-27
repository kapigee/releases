import jQuery from 'jquery';

(($ => {

  // Hide all accordion content
  $('.accordion__content').addClass('u-hidden--visually');

  // Open/close accordion content
  $('.accordion__label').on('click', function () {
    $(this).toggleClass('accordion__label--open');
    $(this).next('.accordion__content').toggleClass('u-hidden--visually');
  });

}))(jQuery);
