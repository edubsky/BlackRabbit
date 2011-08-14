/**
 * JQUERY SWEETNESS
 */
$(function() {
  /**
   * Show/Hide Toggle functionality
   */
  // Annimation: Slide fade toggle (and make cofee)
  $.fn.slideFadeToggle = function(speed, easing, callback) {
    return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
  };
  // Initialization 
  $(".js_toggle.closed").each(function() {
    $(".wrapper_"+$(this).attr("id")).hide();
  })
  // a.toggle#<id> triggers closing/opening of .toggle_<id> (easy hey?)
  $('a.js_toggle').click(function() {
    if ($('a.js_toggle#' + $(this).attr("id")).hasClass("closed")) {
      $('a.js_toggle#' + $(this).attr("id")).addClass("open").removeClass("closed");
      $('a.js_toggle#' + $(this).attr("id")).parents('.widget').addClass("open").removeClass("closed");
      $(".js_toggle_" + $(this).attr("id")).show();
    } else {
      $('a.js_toggle#' + $(this).attr("id")).addClass("closed").removeClass("open");
      $('a.js_toggle#' + $(this).attr("id")).parents('.widget').addClass("closed").removeClass("open");
      $(".js_toggle_" + $(this).attr("id")).hide();
    }
    //$('#right_sidebar a.save-widgets').text(saveWidgetsText); // save the choice
    return false;
  });

  /**
   * Checkbox select all behavior  
   * One checkbox to rule them all!
   */
  $('input.js_select_all').click(function() {
    var check = false;
    if($(this).attr("checked")!= undefined && $(this).attr("checked")) {
      check = true;
    }
    $('input[type=checkbox]', $(this).parents('table')).each(function() {
      this.checked = check;
    })
  });
});
/**
 * NON JQUERY STUFFS - LAND OF EVIL
 */
/**
 * Launch the browser's bookmarks dialog
 */
function addFavorite() {
  var title = document.title;
  var url = location.href;
  if (window.sidebar) {
    window.sidebar.addPanel(title, url, "");
  } else if (document.all) {
    window.external.AddFavorite(url, title);
  } else if (window.opera && window.print) {
    var box = document.createElement('a');
    box.setAttribute('href',url); box.setAttribute('title',title); box.setAttribute('rel','sidebar');
    box.click();
  }
}
/**
 * Launch the browser's print dialog
 */
function printThis() {
  if (window.print) {
    window.print();
  } else {
    var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
    document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
    WebBrowser1.ExecWB(6, 2);
    WebBrowser1.outerHTML = "";
  }
}
