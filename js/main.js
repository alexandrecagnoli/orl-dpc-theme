
function init()
{

    jQuery('.hamburger-link').click(function(event){
        event.preventDefault();
        jQuery('.site-header nav.user-navigation').hide();
        jQuery('.site-header nav.main-navigation').toggle();

    });
    jQuery('.user-link.logged-in').click(function(event){
        event.preventDefault();
        jQuery('.site-header nav.main-navigation').hide();
        jQuery('.site-header nav.user-navigation').toggle();
    });
    jQuery('.site-header .toggle-submenu').click(function(){
        jQuery(this).next("ul").toggle();
        if (jQuery(this).hasClass("fa-chevron-down")) {
          jQuery(this).removeClass("fa-chevron-down");
          jQuery(this).addClass("fa-chevron-up");
        }
        else{
          jQuery(this).removeClass("fa-chevron-up");
          jQuery(this).addClass("fa-chevron-down");
        }
    });
    jQuery('.tabs-menu a').click(function(event){
       event.preventDefault();
       var getId = jQuery(this).attr("data-target");
       jQuery('.tab-content').hide();
       jQuery('.tabs-content').removeClass("active");
       jQuery('#'+getId).addClass("active");
       jQuery('.tabs-menu a').removeClass("active");
       jQuery(this).addClass("active");
       jQuery('#'+getId).show();
    });

    jQuery('.accordion-title button, .accordion-title i.fas').click(function(event){
    event.preventDefault();
    var getId = jQuery(this).attr("aria-controls");
    jQuery('#'+getId).toggle();

        if (jQuery(this).closest('.accordion-title').find('i.fas').hasClass("fa-chevron-down")) {
          jQuery(this).closest('.accordion-title').find('i.fas').removeClass("fa-chevron-down");
          jQuery(this).closest('.accordion-title').find('i.fas').addClass("fa-chevron-up");
        }
        else{
          jQuery(this).closest('.accordion-title').find('i.fas').removeClass("fa-chevron-up");
          jQuery(this).closest('.accordion-title').find('i.fas').addClass("fa-chevron-down");
        }
    });
}

function checkAll(source, selector)
{

  checkboxes = document.getElementsByName(selector);

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
