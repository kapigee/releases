!function(e){var o={};function a(t){if(o[t])return o[t].exports;var n=o[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=e,a.c=o,a.d=function(e,o,t){a.o(e,o)||Object.defineProperty(e,o,{enumerable:!0,get:t})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,o){if(1&o&&(e=a(e)),8&o)return e;if(4&o&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(a.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&o&&"string"!=typeof e)for(var n in e)a.d(t,n,function(o){return e[o]}.bind(null,n));return t},a.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(o,"a",o),o},a.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},a.p="",a(a.s=1)}([function(e,o){e.exports=jQuery},function(e,o,a){a(2),a(3),a(4),a(5),a(6),a(7),a(8),a(9),a(10),a(11),e.exports=a(12)},function(e,o,a){"use strict";a.r(o);var t,n=a(0);(t=a.n(n).a)(".accordion__content").addClass("u-hidden--visually"),t(".accordion__label").on("click",(function(){t(this).toggleClass("accordion__label--open"),t(this).next(".accordion__content").toggleClass("u-hidden--visually")}))},function(e,o,a){"use strict";a.r(o);var t=a(0);!function(e){function o(o){o>=1024&&e(".header__navbar").removeClass("header__navbar--open")}o(e(window).width()),e(window).resize((function(){o(e(window).width())})),e(".hamburger").on("click",(function(){e(".header__navbar").toggleClass("header__navbar--open")}))}(a.n(t).a)},function(e,o,a){"use strict";a.r(o);var t=a(0);!function(e,o){e(".heading--ribbon-branding, .heading--ribbon-highlight").each((function(){var a=e(this);if("CSS"in o&&"supports"in o.CSS&&CSS.supports("(-webkit-box-decoration-break: clone) or (box-decoration-break: clone)"))a.wrapInner("<span></span>");else{var t=a.text().replace(/\S+/g,"<span>$&</span>");a.html(t)}}))}(a.n(t).a,window)},function(e,o,a){"use strict";a.r(o);var t,n=a(0);(t=a.n(n).a)(".hero-banner__video-play").on("click",(function(e){e.preventDefault(),e.stopPropagation();var o=t(".hero-banner__video-popup"),a=o.find("iframe"),n=a.attr("src"),r="?";n.includes("?")&&(r="&"),a.attr("src","".concat(n+r,"autoplay=1")),o.removeClass("u-hidden"),t(".hero-banner__body, .hero-banner__image").addClass("u-hidden")}))},function(e,o,a){"use strict";a.r(o);var t,n=a(0);(t=a.n(n).a)(".list--link-icon a").each((function(){var e=t(this),o=e.attr("href"),a=o.split("."),n=a[a.length-1];location.hostname!==this.hostname&&this.hostname.length?e.addClass("icon-link icon-link--external"):-1===o.lastIndexOf(".")||["html","htm","jhtml","jsp","asp","aspx","php","cfm","rhtml","shtml","vbhtml","xhtml"].includes(n)?e.addClass("icon-link icon-link--internal"):(e.append(" ("+n+")"),e.addClass("icon-link icon-link--download"))}))},function(e,o,a){"use strict";a.r(o);var t=a(0);!function(e,o){e(document).ready((function(){var a=e(".panel--mobile-collapse .panel__title"),t=e(".panel--mobile-collapse .panel__content"),n=function(o){o.matches?(a.off("click"),t.show()):(t.hide(),a.on("click",(function(o){o.preventDefault(),o.stopPropagation(),e(this).siblings(".panel__content").slideToggle(300)})))},r=o.matchMedia("(min-width: 1024px)");r.addListener(n),n(r)}))}(a.n(t).a,window)},function(e,o,a){"use strict";a.r(o);var t=a(0);!function(e){var o=e(".nav-primary__sublist"),a=e(".nav-primary__toggle");function t(e){e>=1024&&(o.addClass("nav-primary__sublist--hidden"),a.removeClass("is-open"))}o.addClass("nav-primary__sublist--hidden"),a.on("click",(function(){e(this).siblings(".nav-primary__sublist").toggleClass("nav-primary__sublist--hidden"),e(this).toggleClass("is-open")})),t(e(window).width()),e(window).resize((function(){t(e(window).width())}))}(a.n(t).a)},function(e,o,a){"use strict";a.r(o);var t=a(0);!function(e){function o(o){o>=1024?a():e(".search-bar__form").removeClass("u-hidden")}function a(){e(".search-bar").removeClass("search-bar--open"),e(".search-bar__form").addClass("u-hidden"),e(".nav-primary").removeClass("search-bar__trigger")}e(".search-bar__btn").on("click",(function(){var o=e(this);o.parent().toggleClass("search-bar--open"),o.next(".search-bar__form").toggleClass("u-hidden"),setTimeout((function(){e(".nav-primary").toggleClass("search-bar__trigger")}),1e3)})),e(".header__navbar").on("mouseover",".search-bar__trigger",(function(){a()})),o(e(window).width()),e(window).resize((function(){o(e(window).width())}))}(a.n(t).a)},function(e,o,a){"use strict";a.r(o);var t,n,r,c,i,d=a(0);t=a.n(d).a,n=function(e){return e.toISOString().replace(/-|:|\.\d+/g,"")},r=function(e){return e.end?n(e.end):n(new Date(e.start.getTime()+6e4*e.duration))},c={google:function(e){var o=n(e.start),a=r(e),t=encodeURI(["https://www.google.com/calendar/render","?action=TEMPLATE","&text=".concat(e.title||""),"&dates=".concat(o||""),"/".concat(a||""),"&details=".concat(e.description||""),"&location=".concat(e.address||""),"&sprop=&sprop=name:"].join(""));return'<a class="icon-google" target="_blank" href="'.concat(t,'">Google Calendar</a>')},yahoo:function(e){var o=e.end?(e.end.getTime()-e.start.getTime())/6e4:e.duration,a=(o<600?"0".concat(Math.floor(o/60)):"".concat(Math.floor(o/60)))+(o%60<10?"0".concat(o%60):"".concat(o%60)),t=n(new Date(e.start-6e4*e.start.getTimezoneOffset()))||"",r=encodeURI(["http://calendar.yahoo.com/?v=60&view=d&type=20","&title=".concat(e.title||""),"&st=".concat(t),"&dur=".concat(a||""),"&desc=".concat(e.description||""),"&in_loc=".concat(e.address||"")].join(""));return'<a class="icon-yahoo" target="_blank" href="'.concat(r,'">Yahoo! Calendar</a>')},ics:function(e,o,a){var t=n(e.start),c=r(e),i=encodeURI("data:text/calendar;charset=utf8,".concat(["BEGIN:VCALENDAR","VERSION:2.0","BEGIN:VEVENT","URL:"+document.URL,"DTSTART:"+(t||""),"DTEND:"+(c||""),"SUMMARY:"+(e.title||""),"DESCRIPTION:"+(e.description||""),"LOCATION:"+(e.address||""),"END:VEVENT","END:VCALENDAR"].join("\n")));return'<a class="'.concat(o,'" target="_blank" href="').concat(i,'">').concat(a," Calendar</a>")},ical:function(e){return this.ics(e,"icon-ical","iCal")},outlook:function(e){return this.ics(e,"icon-outlook","Outlook")}},i=function(e){var o,a,t,n;if(function(e){return void 0!==e.data&&void 0!==e.data.start&&(void 0!==e.data.end||void 0!==e.data.duration)}(e))return n=e.data,o={google:c.google(n),yahoo:c.yahoo(n),ical:c.ical(n),outlook:c.outlook(n)},a=document.createElement("div"),t="",a.innerHTML='<a class="dropdown__btn">+ Add to my Calendar</a>',Object.keys(o).forEach((function(e){t+='<li class="dropdown__item">'.concat(o[e],"</li>")})),a.innerHTML+='<ul class="dropdown__content">'.concat(t,"</ul>"),a.innerHTML+="</div>",a.className="dropdown",a},Drupal.behaviors.sitefarmOneAddToCal={attach:function(e,o){t("div.add-to-calendar-button",e).once("addToCalendarBehavior").each((function(){var e=o.event.title,a=o.event.start_date,n=o.event.end_date,r=o.event.desc,c=o.event.address,d=i({data:{title:e,start:new Date(a),end:new Date(n),address:c,description:r}});t(".add-to-calendar-button").append(d)}))}}},function(e,o){!function(e,o){"use strict";o.behaviors.collapsibleCard={attach:function(o){var a=window.location.pathname.split("/");"teams"==a[1]&&"members"==a[3]&&jQuery("td:empty").text("Team Member").css("background","rgb(fff,fff,fff)"),e("#closeqa").click((function(){e("#productsqa").click()})),e("#closeprod").click((function(){e("#productsprod").click()})),e("#edit-environment-ucla").change((function(){var o=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(o).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}));var a=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(a).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(o).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(o).each((function(o,a){e(a).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(o).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(o).each((function(o,a){e(a).prop("checked",!1)}))})),e("#productsqa").click((function(){var o=new Array,a=e("form.vbo-view-form .card");e(a).each((function(a,t){var n=e(t).find("input");1==e(n).prop("checked")&&o.push(e(t).find(".views-field-name .field-content").text())}));var t=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(t).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&e(n).prop("checked",!0)}))}));var n=e("form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(n).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))}));var r=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(r).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&e(n).prop("checked",!0)}))}));var c=e("form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(c).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))})),e(".ui-dialog-titlebar-close").trigger("click")})),e("#productsprod").click((function(){var o=new Array,a=e("form.vbo-view-form .card");e(a).each((function(a,t){var n=e(t).find("input");1==e(n).prop("checked")&&o.push(e(t).find(".views-field-name .field-content").text())}));var t=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(t).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&e(n).prop("checked",!0)}))}));var n=e("form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(n).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))}));var r=new Array,c=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push("<span>"+e(n).val()+"</span"))}))})),e(".productsdisplay").append(r),console.log(r);r=new Array,c=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push("<span>"+e(n).val()+"</span"))}))})),e(".productsdisplay").append(r),console.log(r);r=new Array,c=e("form.team-app-edit-form #edit-credential div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push("<span>"+e(n).val()+"</span"))}))})),e(".productsdisplay").append(r),console.log(r);r=new Array,c=e("form.developer-app-edit-for-developer-form #edit-credential div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push("<span>"+e(n).val()+"</span"))}))})),e(".productsdisplay").append(r),console.log(r);n=e("form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(n).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))})),e(".ui-dialog-titlebar-close").trigger("click")}));var t=e(".collapsible-card",o);t.length&&t.each((function(){var o=e(this),a=o.find(".collapsible-card__toggle"),t=o.find(".collapsible-card__content");a.on("click",(function(e){e.preventDefault(),o.toggleClass("collapsible-card--active"),t.slideToggle(200)}))})),e.urlParam=function(e){var o=new RegExp("[?&]"+e+"=([^&#]*)").exec(window.location.href);return 0!=o.length?o[1]||0:void 0};var n=decodeURIComponent(e.urlParam("app")),r=e(".path-teams div.collapsible-card");e(r).each((function(o,a){e(a).find("button.collapsible-card__toggle span.btn").text()==n&&(e(a).addClass("collapsible-card--active"),e(a).find("div.collapsible-card__content").show())}))}}}(jQuery,Drupal)},function(e,o){!function(e,o){"use strict";o.behaviors.collapsibleCard={attach:function(o){var a=window.location.pathname.split("/");"teams"==a[1]&&"members"==a[3]&&jQuery("td:empty").text("Team Member").css("background","rgb(fff,fff,fff)"),e("#closeqa").click((function(){e("#productsqa").click()})),e("#closeprod").click((function(){e("#productsprod").click()})),e("#edit-environment-ucla").change((function(){var o=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(o).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}));var a=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(a).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(o).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(o).each((function(o,a){e(a).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(o).each((function(o,a){var t=e(a).find("input");e(t).prop("checked",!1)}))})),e(".use-ajax").click((function(){var o=e("form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(o).each((function(o,a){e(a).prop("checked",!1)}))})),e("#productsqa").click((function(){var o=new Array,a=e("form.vbo-view-form .card");e(a).each((function(a,t){var n=e(t).find("input");1==e(n).prop("checked")&&o.push(e(t).find(".views-field-name .field-content").text())}));var t=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(t).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&e(n).prop("checked",!0)}))}));var n=e("form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(n).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))}));var r=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(r).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&e(n).prop("checked",!0)}))}));var c=e("form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(c).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))})),e(".ui-dialog-titlebar-close").trigger("click")})),e("#productsprod").click((function(){var o=new Array,a=e("form.vbo-view-form .card");e(a).each((function(a,t){var n=e(t).find("input");1==e(n).prop("checked")&&o.push(e(t).find(".views-field-name .field-content").text())}));var t=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(t).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&e(n).prop("checked",!0)}))}));var n=e("form.team-app-edit-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(n).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))}));var r=new Array,c=e("form.developer-app-add-for-developer-form #edit-api-products div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push(e(n).val()+" , "))}))})),e(".productsdisplay").append(r),console.log(r);r=new Array,c=e("form.team-app-add-for-team-form #edit-api-products div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push(e(n).val()+" , "))}))})),e(".productsdisplay").append(r),console.log(r);r=new Array,c=e("form.team-app-edit-form #edit-credential div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push(e(n).val()+" , "))}))})),e(".productsdisplay").append(r),console.log(r);r=new Array,c=e("form.developer-app-edit-for-developer-form #edit-credential div.form-item");e(c).each((function(a,t){e(o).each((function(o,a){var n=e(t).find("input");e(n).val()==a&&(e(n).prop("checked",!0),r.push(e(n).val()+" , "))}))})),e(".productsdisplay").append(r),console.log(r);n=e("form.developer-app-edit-for-developer-form .fieldset-wrapper .fieldset-wrapper .form-type-checkbox input.form-checkbox");e(n).each((function(a,t){e(o).each((function(o,a){e(t).val()==a&&e(t).prop("checked",!0)}))})),e(".ui-dialog-titlebar-close").trigger("click")}));var t=e(".collapsible-card",o);t.length&&t.each((function(){var o=e(this),a=o.find(".collapsible-card__toggle"),t=o.find(".collapsible-card__content");a.on("click",(function(e){e.preventDefault(),o.toggleClass("collapsible-card--active"),t.slideToggle(200)}))})),e.urlParam=function(e){var o=new RegExp("[?&]"+e+"=([^&#]*)").exec(window.location.href);return 0!=o.length?o[1]||0:void 0};var n=decodeURIComponent(e.urlParam("app")),r=e(".path-teams div.collapsible-card");e(r).each((function(o,a){e(a).find("button.collapsible-card__toggle span.btn").text()==n&&(e(a).addClass("collapsible-card--active"),e(a).find("div.collapsible-card__content").show())}))}}}(jQuery,Drupal)}]);
//# sourceMappingURL=scripts.js.map