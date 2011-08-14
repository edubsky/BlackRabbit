/**
 * Cookie check
 * @author: rbertot@greenpeace.org
 */
$(function() {
  /*
   * Hide warning message if the cookie support is enabled
   * Note: Warning message is always displayed at first http call
   * as cookie support can not be detected server side in that case
   */
   if(navigator.cookieEnabled) {
     $('.message.warning_cookies_must_be_enabled').hide();
   }
});
