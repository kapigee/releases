import jQuery from 'jquery';

(($ => {

  // Add an .icon-link class and modifier to each link in a Link Icon list.
  $('.list--link-icon a').each(function () {
    const $this = $(this);
    const link = $this.attr('href');
    const linkParts = link.split('.');
    const fileExt = linkParts[linkParts.length - 1];
    const webPgExts = ['html', 'htm', 'jhtml', 'jsp', 'asp', 'aspx', 'php', 'cfm', 'rhtml', 'shtml', 'vbhtml', 'xhtml'];

    // Check if this is an internal or external link
    if (location.hostname === this.hostname || !this.hostname.length) {
      // Check if this is a link to a document or internal web page extension
      if (link.lastIndexOf('.') !== -1 && !webPgExts.includes(fileExt)) {
        // If this is a link to a document append the extension to the link name and add the icon class.
        $this.append(' (' + fileExt + ')');
        $this.addClass('icon-link icon-link--download');
      }
      // If this is not a document, then it is an internal link and add the internal link icon.
      else {
        $this.addClass('icon-link icon-link--internal');
      }
    }
    else {
      // If this is an external link add class for external icon.
      $this.addClass('icon-link icon-link--external');
    }
  });

}))(jQuery);
