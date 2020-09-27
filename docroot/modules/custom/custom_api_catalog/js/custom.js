(function ($) {
  Drupal.behaviors.apigee_company_ucla = {
    attach: function (context, settings) {
      $(function() {
        $( ".messages__list li.messages__item:nth-child(2)" ).hide();
        document.getElementById("edit-name").style.display = "none";
        document.getElementById("edit-displayname-0-value").addEventListener("input",function(){
          var humanname = document.getElementById("edit-displayname-0-value").value;
          document.getElementById("edit-name").value = humanname;
        });
      });
    }
  };
}(jQuery));
