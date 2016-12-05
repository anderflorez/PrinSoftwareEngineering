// exts is an array of strings (e.g. [".png", ".jpg"])
$.fn.hasExtension = function(exts) {
  return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test($(this).val());
}