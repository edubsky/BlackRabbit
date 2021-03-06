/**
 * Font resize
 * @credit http://www.shopdev.co.uk/blog/font-resize.html
 */
$(document).ready(function(){
  // Reset Font Size
  var originalFontSize = $('html').css('font-size');
  $(".resetFont").click(function(){
  $('html').css('font-size', originalFontSize);
  });
  // Increase Font Size
  $(".fontResize.increase").click(function(){
  	var currentFontSize = $('html').css('font-size');
 	var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*1.2;
	$('html').css('font-size', newFontSize);
	return false;
  });
  // Decrease Font Size
  $(".fontResize.decrease").click(function(){
  	var currentFontSize = $('html').css('font-size');
 	var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*0.8;
	$('html').css('font-size', newFontSize);
	return false;
  });
});
