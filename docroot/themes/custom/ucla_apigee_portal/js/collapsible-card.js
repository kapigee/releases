var selitems = new Array();
var index = 0;
(function ($, Drupal) {
    var selitems = new Array();
    var index = 0;
    'use strict';

  Drupal.behaviors.collapsibleCard = {
    attach: function (context) {
      /* Adding Team Member through jQuery */
      var pathname = window.location.pathname;
      var arr = pathname.split('/');
      if ((arr[1] == 'teams') && arr[3] == 'members') {
        jQuery("td:empty")
          .text("Team Member")
          .css("background", "rgb(fff,fff,fff)");
      }
        /* Prevent copy paste for adding members in Add members form */

        $('.apigee-edge-teams-add-team-member-form .form-autocomplete').on("cut copy paste",function(e) {
            e.preventDefault();
        });

      /* Adding API products in span on load when error came in developer apps*/
        var names_qa = new Array();
        $('form.developer-app-add-for-developer-form #edit-api-products--wrapper div.form-item .form-checkbox:checked').each(function () {
            var selectedlabel = $(this).val();
            names_qa.push("<span>" + selectedlabel + "</span");
            $(".productsdisplay").html('');
            $(".productsdisplay").append(names_qa);
        })
        var names_qa = new Array();

        /* Adding API products in span on load when error came in team apps */
        $('form.team-app-add-for-team-form #edit-api-products--wrapper div.form-item .form-checkbox:checked').each(function () {
            var selectedlabel = $(this).val();
            names_qa.push("<span>" + selectedlabel + "</span");
            $(".productsdisplay").html('');
            $(".productsdisplay").append(names_qa);
        })

        var names_qa = new Array();
        $('#edit-credential .form-checkbox:checked').each(function () {
            var selectedlabel = $(this).val();
            var arr = new Array();
            if(!arr.includes(selectedlabel)){
                arr.push(selectedlabel);
                names_qa.push("<span>" + selectedlabel + "</span");
            }
            $(".productsdisplay").html('');
            $(".productsdisplay").append(names_qa);
        });

      /* To close modal pop up on clicking close in qa modal window */
      $("#closeqa").click(function () {
        $(".ui-dialog-titlebar-close").trigger("click");
      });

      $("#closeprod").click(function () {
        $(".ui-dialog-titlebar-close").trigger("click");
      });
/* Edit Developer and Team Apps Select product click loader come for 3 seconds*/
        $(".developer-app-edit-for-developer-form .api-catalog-grid .use-ajax, .team-app-edit-form .api-catalog-grid .use-ajax").click(function () {
               $('.three-cols').hide();
               var selected = [];
               setTimeout(function () {
                   selitems = [];
                   var items = 0;
                   $('.three-cols .card .visually-hidden').each(function () {
                       var labeldiv = $(this);
                       var label = $(this).text();
                       $('#edit-credential .form-checkbox:checked').each(function () {
                           var selectedlabel = $(this).val();
                           if (label == selectedlabel) {
                               selitems.push(selectedlabel);
                               labeldiv.next('input').prop('checked', true);
                               ;
                           }
                       });
                       $('#edit-api-products--wrapper .form-checkbox:checked').each(function () {
                           var selectedlabel = $(this).val();
                           if (label == selectedlabel) {
                               selitems.push(selectedlabel);
                               labeldiv.next('input').prop('checked', true);
                               ;
                           }
                       });
                   });
                   index = index + 1;
                   $('.loader-bg').hide();
               }, 5000);
               $('.three-cols').show();
        });

        /* Add Developer and Team Apps Select product click loader come fast than edit*/
        $(".team-app-add-for-team-form .api-catalog-grid .use-ajax, .developer-app-add-for-developer-form .api-catalog-grid .use-ajax").click(function () {
            if ($('#edit-api-products--wrapper .form-checkbox:checked').length === 0) {
                setTimeout(function () {
                    $('.loader-bg').hide();
                }, 1500);
            }
            else {
            $('.three-cols').hide();
            var selected = [];
            setTimeout(function () {
                selitems = [];
                var items = 0;
                $('.three-cols .card .visually-hidden').each(function () {
                    var labeldiv = $(this);
                    var label = $(this).text();
                    $('#edit-credential .form-checkbox:checked').each(function () {
                        var selectedlabel = $(this).val();
                        if (label == selectedlabel) {
                            selitems.push(selectedlabel);
                            labeldiv.next('input').prop('checked', true);
                            ;
                        }
                    });
                    $('#edit-api-products--wrapper .form-checkbox:checked').each(function () {
                        var selectedlabel = $(this).val();
                        if (label == selectedlabel) {
                            selitems.push(selectedlabel);
                            labeldiv.next('input').prop('checked', true);
                            ;
                        }
                    });
                });
                index = index + 1;
                $('.loader-bg').hide();
            }, 5000);
            $('.three-cols').show();
        }
        });

/* Filtered check and uncheck api products */
        $('.bef-exposed-form').click(function () {
            setTimeout(function(){
                $('form.vbo-view-form .card .form-checkbox').each(function () {
                    var option = $(this).prev(".visually-hidden").text();
                    var i;
                    for(i=0; i<selitems.length; i++){
                        if(selitems[i] == option){
                            $(this).prop('checked', true);
                        }
                    }
                });
                $('.loader-bg').hide();
            }, 3000);
        });

        $('.bef-exposed-form .form-submit').click(function () {
            setTimeout(function(){
                $('form.vbo-view-form .card .form-checkbox').each(function () {
                    var option = $(this).prev(".visually-hidden").text();
                    var i;
                    for(i=0; i<selitems.length; i++){
                        if(selitems[i] == option){
                            $(this).prop('checked', true);
                        }
                    }
                });
                $('.loader-bg').hide();
            }, 3000);
        });

        $('#vbo-action-form-wrapper .vbo-select-all').click(function(){
            var ischecked = $(this).is(':checked');
            setTimeout(function(){
           // selitems = [];
                if(ischecked) {
                    $('.three-cols .card .form-checkbox:checked').each(function () {
                        var sel = $(this).prev(".visually-hidden").text();
                        if (!selitems.includes(sel)) {
                            selitems.push(sel);
                        }
                    })
                }else{
                    $('.three-cols .card .form-checkbox').each(function () {
                        var sel = $(this).prev(".visually-hidden").text();
                        if(selitems.includes(sel)){
                            selitems = selitems.filter(e => e !== sel);
                        }
                    })
                }
                $('.loader-bg').hide();
            }, 1000);
        });

        $('form.vbo-view-form .card .form-checkbox').change(function () {
            var sel = $(this).prev(".visually-hidden").text();
            if ($(this).is(':checked')) {
               // console.log('CHECKED');
                if(!selitems.includes(sel)){
                    selitems.push(sel);
                }
            }
            else{
                if(selitems.includes(sel)){
                    selitems = selitems.filter(e => e !== sel);
                }
            }
        });


      /* To uncheck checkboxes on environment change */

      $("#edit-field-environments").change(function () {
          $(".use-ajax").hide();
          $(".use-ajax").delay(5000).fadeIn(500);
        $(".productsdisplay").html("");
        index = 0;
          selitems = [];
        var apiproducts_uncheck = $('form.team-app-add-for-team-form #edit-api-products div.form-item');
        $(apiproducts_uncheck).each(function (p_unckk, p_unckv) {
          var uncheck_products = $(p_unckv).find('input');
          $(uncheck_products).prop('checked', false);
        });

        var myapiproducts_uncheck = $('form.developer-app-add-for-developer-form #edit-api-products div.form-item');
        $(myapiproducts_uncheck).each(function (myp_unckk, myp_unckv) {
          var myuncheck_products = $(myp_unckv).find('input');
          $(myuncheck_products).prop('checked', false);
        });

      });

      /* To uncheck products everytime we click select product button - Team apps */
      $('.use-ajax').click(function () {
        var apiproducts_uncheck = $('form.team-app-add-for-team-form #edit-api-products div.form-item');
        $(apiproducts_uncheck).each(function (p_unckk, p_unckv) {
          var uncheck_products = $(p_unckv).find('input');
         // $(uncheck_products).prop('checked', false);
        });

      });

      /* To uncheck products everytime we click select product button in Edit scenario - Team apps*/
      $('.use-ajax').click(function () {
        var apip_edit = $('form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox');
        $(apip_edit).each(function (c_apk_edit, c_apv_edit) {
        //  $(c_apv_edit).prop('checked', false);
        });

      });

      /* To uncheck products everytime we click select product button - Developer apps */
      $('.use-ajax').click(function () {
        var myapiproducts_uncheck = $('form.developer-app-add-for-developer-form #edit-api-products div.form-item');
        $(myapiproducts_uncheck).each(function (myp_unckk, myp_unckv) {
          var myuncheck_products = $(myp_unckv).find('input');
         // $(myuncheck_products).prop('checked', false);
        });

      });

      /* To uncheck products everytime we click select product button in Edit scenario - Developer apps*/
      $('.use-ajax').click(function () {
        var myapip_edit = $('form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox');
        $(myapip_edit).each(function (myc_apk_edit, myc_apv_edit) {
        //  $(myc_apv_edit).prop('checked', false);
        });

      });

      /* To collect qa products selected in modal window */
      $("#productsqa").click(function () {
        var selected = new Array();
          $(".productsdisplay").html('');
          var names_qa = new Array();
        var cards = $('form.vbo-view-form .card');
        $(cards).each(function (c_index, c_value) {
          var check = $(c_value).find('input');
          if ($(check).prop("checked") == true) {
            selected.push($(c_value).find('.views-field-name .field-content').text());
          }
        });

        /* To check qa products selected in modal window and enable checkboxes in Edit scenario- Team apps */
        var api_productsqa_edit = $('form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox');
        $(api_productsqa_edit).each(function (ap_k_edit, ap_v_edit) {
          $(selected).each(function (mwqa_k_edit, mwqa_v_edit) {
            if ($(ap_v_edit).val() == mwqa_v_edit) {
              $(ap_v_edit).prop('checked', true);
            }else {
                $(ap_v_edit).prop('checked', false);
            }
          });
        });

        /* To check qa products selected in modal window and enable checkboxes - Developer apps */
        var apip_myapps = $('form.developer-app-add-for-developer-form #edit-api-products div.form-item');
          var matched = Array();
        $(apip_myapps).each(function (myc_apk, myc_apv) {
            var i;

            if(index == 3 || index == 1) {
                $(selected).each(function (myc_x, myc_y) {
                    var mycheckap = $(myc_apv).find('input');
                    if (!matched.includes($(mycheckap).val())) {
                        if ($(mycheckap).val() == myc_y) {
                            matched.push($(mycheckap).val());
                            $(mycheckap).prop('checked', true);
                            names_qa.push("<span>" + $(mycheckap).val() + "</span");
                        } else {
                            $(mycheckap).prop('checked', false);
                        }
                    }
                });
            }else {
                var mycheckap = $(myc_apv).find('input');
                if (selitems.length != 0) {
                for (i = 0; i < selitems.length; i++) {
                    if (!matched.includes($(mycheckap).val())) {
                        if ($(mycheckap).val() == selitems[i]) {
                            $(mycheckap).prop('checked', true);
                            matched.push($(mycheckap).val());
                            names_qa.push("<span>" + $(mycheckap).val() + "</span");
                        } else {
                            $(mycheckap).prop('checked', false);
                        }
                    }
                }
            }else{
                    $(mycheckap).prop('checked', false);
            }
            }

        });
          //for team apps
          var matched = new Array();
          var br = "<br/>";
          var apip_myapps = $('form.team-app-add-for-team-form #edit-api-products div.form-item');
          $(apip_myapps).each(function (myc_apk, myc_apv) {
              var i;
              if(index == 3 || index == 1) {
                  $(selected).each(function (myc_x, myc_y) {
                      var mycheckap = $(myc_apv).find('input');
                      if (!matched.includes($(mycheckap).val())) {
                          if ($(mycheckap).val() == myc_y) {
                              matched.push($(mycheckap).val());
                              $(mycheckap).prop('checked', true);
                              names_qa.push("<span>" + $(mycheckap).val() + "</span");
                          }else {
                              $(mycheckap).prop('checked', false);
                          }
                      }
                  });
              }else {
                  var mycheckap = $(myc_apv).find('input');
                  if (selitems.length != 0) {
                      for (i = 0; i < selitems.length; i++) {
                          if (!matched.includes($(mycheckap).val())) {
                              if ($(mycheckap).val() == selitems[i]) {
                                  $(mycheckap).prop('checked', true);
                                  matched.push($(mycheckap).val());
                                  names_qa.push("<span>" + $(mycheckap).val() + "</span");
                              } else {
                                  $(mycheckap).prop('checked', false);
                              }
                          }
                      }
                  }else{
                      $(mycheckap).prop('checked', false);
                  }
              }
          });

          //team apps edit
          var br = "<br/>";
          var matched = new Array();
          var apip_myapps = $('form.team-app-edit-form #edit-credential div.form-item');
          $(apip_myapps).each(function (myc_apk, myc_apv) {
              var i;
              var mycheckap = $(myc_apv).find('input');
              if (selitems.length != 0) {
                  {
                      for (i = 0; i < selitems.length; i++) {
                          if (!matched.includes($(mycheckap).val())) {
                              if ($(mycheckap).val() == selitems[i]) {
                                  matched.push($(mycheckap).val());
                                  $(mycheckap).prop('checked', true);
                                  names_qa.push("<span>" + $(mycheckap).val() + "</span");
                              }else {
                                  $(mycheckap).prop('checked', false);
                              }
                          }
                      }
                  };
          }else
              {
                  $(mycheckap).prop('checked', false);
              }
          });

          //developer app edit
          var matched = Array();
          var br = "<br/>";
          var apip_myapps = $('form.developer-app-edit-for-developer-form #edit-credential div.form-item');
          $(apip_myapps).each(function (myc_apk, myc_apv) {
              var i;
              var mycheckap = $(myc_apv).find('input');
              if (selitems.length != 0) {
                  for (i = 0; i < selitems.length; i++) {
                      if (!matched.includes($(mycheckap).val())) {
                          if ($(mycheckap).val() == selitems[i]) {
                              $(mycheckap).prop('checked', true);
                              matched.push($(mycheckap).val());
                              names_qa.push("<span>" + $(mycheckap).val() + "</span");
                          } else {
                              $(mycheckap).prop('checked', false);
                          }
                      }
                  };
              }else
              {
                  $(mycheckap).prop('checked', false);
              }
          });
          $(".productsdisplay").append(names_qa);

        $(".ui-dialog-titlebar-close").trigger("click");
      });

        /* To collect prod products selected in modal window */
      $("#productsprod").click(function () {
          var selectedp = new Array();
          $(".productsdisplay").html('');
          var names_1 = new Array();
        var cardsp = $('form.vbo-view-form .card');
        $(cardsp).each(function (c_indexp, c_valuep) {
          var checkp = $(c_valuep).find('input');
          if ($(checkp).prop("checked") == true) {
            selectedp.push($(c_valuep).find('.views-field-name .field-content').text());
            selitems.push($(c_valuep).find('.views-field-name .field-content').text());
          }
        });
        /* To check prod products selected in modal window and enable checkboxes - Team apps */
          var api_productsprod = $('form.team-app-add-for-team-form #edit-api-products--wrapper div.form-item');
          var matched = new Array();
          //console.log('IIII',index);
          $(api_productsprod).each(function (ap_kp, ap_vp) {
              /*if(selectedp.length == 0){
                  var check_productsprod = $(ap_vp).find('input');
                  $(check_productsprod).prop('checked', false);
              }else {*/
                  var i;
                  if(index == 3 || index == 1) {
                      $(selectedp).each(function (mwp_k, mwp_v) {
                          var check_productsprod = $(ap_vp).find('input');
                          if (!matched.includes($(check_productsprod).val())) {
                              if ($(check_productsprod).val() == mwp_v) {
                                  matched.push($(check_productsprod).val());
                                  $(check_productsprod).prop('checked', true);
                                  names_1.push("<span>" + $(check_productsprod).val() + "</span");
                              } else {
                                  $(check_productsprod).prop('checked', false);
                              }
                          }
                      });
                  }else {
                      var check_productsprod = $(ap_vp).find('input');
                      if (selitems.length != 0){
                          for (i = 0; i < selitems.length; i++) {
                              if (!matched.includes($(check_productsprod).val())) {
                                  if ($(check_productsprod).val() == selitems[i]) {
                                      matched.push($(check_productsprod).val());
                                      $(check_productsprod).prop('checked', true);
                                      names_1.push("<span>" + $(check_productsprod).val() + "</span");
                                  } else {
                                     // console.log('unchecked', $(check_productsprod).val());
                                      $(check_productsprod).prop('checked', false);
                                  }
                              }

                          }
                  }else{
                          $(check_productsprod).prop('checked', false);
                      }
                  }
            //  }
          });

        /* To check prod products selected in modal window and enable checkboxes in Edit scenario- Team apps */
        var api_productsprod_edit = $('form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox');
        $(api_productsprod_edit).each(function (ap_kp_edit, ap_vp_edit) {
          $(selectedp).each(function (mwp_k_edit, mwp_v_edit) {
            if ($(ap_vp_edit).val() == mwp_v_edit) {
              $(ap_vp_edit).prop('checked', true);
            }else{
                $(ap_vp_edit).prop('checked', false);
            }

          });
        });

        /* To check prod products selected in modal window and enable checkboxes - Developer apps */
        var br = "<br/>";
        var apip_myapps = $('form.developer-app-add-for-developer-form #edit-api-products--wrapper div.form-item');
          var matched = new Array();
          $(apip_myapps).each(function (ap_kp, ap_vp) {
                  var i;
                  //  $(selectedp).each(function (mwp_k, mwp_v) {
                  if(index == 3) {
                     // console.log('yes',selitems);
                      $(selectedp).each(function (mwp_k, mwp_v) {
                          var check_productsprod = $(ap_vp).find('input');
                          if (!matched.includes($(check_productsprod).val())) {
                              if ($(check_productsprod).val() == mwp_v) {
                                  // console.log('CHECKED', $(check_productsprod).val());
                                  matched.push($(check_productsprod).val());
                                  $(check_productsprod).prop('checked', true);
                                  names_1.push("<span>" + $(check_productsprod).val() + "</span");
                              } else {
                                  // console.log('unchecked', $(check_productsprod).val());
                                  $(check_productsprod).prop('checked', false);
                              }
                          }

                      });
                  }else{
                      var check_productsprod = $(ap_vp).find('input');
                      if (selitems.length != 0) {
                          for (i = 0; i < selitems.length; i++) {
                              if (!matched.includes($(check_productsprod).val())) {
                                  if ($(check_productsprod).val() == selitems[i]) {
                                      // console.log('CHECKED', $(check_productsprod).val());
                                      matched.push($(check_productsprod).val());
                                      $(check_productsprod).prop('checked', true);
                                      names_1.push("<span>" + $(check_productsprod).val() + "</span");
                                  } else {
                                      // console.log('unchecked', $(check_productsprod).val());
                                      $(check_productsprod).prop('checked', false);
                                  }
                              }

                          }
                      }else{
                          $(check_productsprod).prop('checked', false);
                      }
              }
              //}
          });

          //team apps edit
          var br = "<br/>";
          var apip_myapps = $('form.team-app-edit-form #edit-credential div.form-item');
          $(apip_myapps).each(function (myc_apk, myc_apv) {
              //console.log('3333333');
              var i;
              var mycheckap = $(myc_apv).find('input');
              if (selitems.length != 0) {
                  console.log('SELITEMS',selitems)
                  for (i = 0; i < selitems.length; i++) {
                      if (!matched.includes($(mycheckap).val())) {
                          if ($(mycheckap).val() == selitems[i]) {
                              matched.push($(mycheckap).val());
                              $(mycheckap).prop('checked', true);
                              names_1.push("<span>" + $(mycheckap).val() + "</span");
                          }else{
                              $(mycheckap).prop('checked', false);
                          }
                      }
              };
              }else{
                  $(mycheckap).prop('checked', false);
              }
          });

          //developer app edit
          var matched = new Array();
          var br = "<br/>";
          var apip_myapps = $('form.developer-app-edit-for-developer-form #edit-credential div.form-item');
          $(apip_myapps).each(function (myc_apk, myc_apv) {
              var i;
              var mycheckap = $(myc_apv).find('input');
              if (selitems.length != 0) {
                  for (i = 0; i < selitems.length; i++) {
                  if (!matched.includes($(mycheckap).val())) {
                      if ($(mycheckap).val() == selitems[i]) {
                          matched.push($(mycheckap).val());
                          $(mycheckap).prop('checked', true);
                          names_1.push("<span>" + $(mycheckap).val() + "</span");
                      } else {
                          $(mycheckap).prop('checked', false);
                      }
                  }
              }
          }else
          {
              $(mycheckap).prop('checked', false);
          }
          });

          $(".productsdisplay").append(names_1); //  console.log(names_1);
        /* To check prod products selected in modal window and enable checkboxes in Edit scenario- Developer apps */
        var api_productsprod_edit = $('form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox');
        $(api_productsprod_edit).each(function (ap_kp_edit, ap_vp_edit) {
          $(selectedp).each(function (mwp_k_edit, mwp_v_edit) {
            if ($(ap_vp_edit).val() == mwp_v_edit) {
              $(ap_vp_edit).prop('checked', true);
            }

          });
        });

          $('.three-cols .card .visually-hidden').each(function () {
              var labeldiv = $(this);
              labeldiv.next('input').prop('checked', false);
          })
        $(".ui-dialog-titlebar-close").trigger("click");
      });


      let $collapsibleCards = $('.collapsible-card', context);
      if ($collapsibleCards.length) {
        $collapsibleCards.each(function () {
          let $collapsibleCard = $(this);
          let $toggle = $collapsibleCard.find('.collapsible-card__toggle');
          let $content = $collapsibleCard.find('.collapsible-card__content');

          $toggle.on('click', function (event) {
            event.preventDefault();
            $collapsibleCard.toggleClass('collapsible-card--active');
            $content.slideToggle(200);
          });
        });
      }

      /* To get app name from query parameters */

      $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results.length != 0) {
          return results[1] || 0;
        } else {
          return;
        }
      }

      var url_app_name = decodeURIComponent($.urlParam('app'));
      var team_list = $('.path-teams div.collapsible-card');
      $(team_list).each(function (t_index, t_value) {
        if ($(t_value).find('button.collapsible-card__toggle span.btn').text() == url_app_name) {
          $(t_value).addClass('collapsible-card--active');
          $(t_value).find('div.collapsible-card__content').show();
        }
      });
    }
  };

})(jQuery, Drupal);
