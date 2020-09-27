(function ($) {
  Drupal.behaviors.apigee_company_ucla = {
    attach: function (context, settings) {
      $(function() {
        document.getElementById("edit-name").style.display = "none";
        document.getElementById("edit-displayname-0-value").addEventListener("input",function(){
          var humanname = document.getElementById("edit-displayname-0-value").value;
            var sample = humanname.replace(/[&\/\\#\-, '":*?]/g, '_').toLowerCase();
          document.getElementById("edit-name").value = sample;
        });
      });
    }
  };
}(jQuery));
