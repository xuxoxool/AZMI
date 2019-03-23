var DIR_SEPARATOR = '/';
var DIR_SEPARATOR_DOUBLE = '//';

// TRIM
String.prototype.trim = function () {
	return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
};
// TRIM LEFT
String.prototype.trimLeft = function(charlist) {
  if (typeof charlist === undefined) charlist = "\s";
  return this.replace(new RegExp("^[" + charlist + "]+"), "");
};
// TRIM RIGHT
String.prototype.trimRight = function(charlist) {
  if (typeof charlist === undefined) charlist = "\s";
  return this.replace(new RegExp("[" + charlist + "]+$"), "");
};
// UCWORDS
String.prototype.ucwords = function() {
  str = this.toLowerCase();
  return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
  	function(s){
  	  return s.toUpperCase();
	});
};
// ALPHANUMERIC
String.prototype.alphanumeric = function() {
	//return JSON.stringify(this.trim()).replace(/\W/g, '');
	//return this.trim().replace(/\W/g, '');
	//return this.trim().replace(/^[a-zA-Z0-9-_]+$/, '');
	return this.trim().replace(/[^\w.-]+/g, '');
}
// SLUGIFY
String.prototype.slugify = function() {
	var slug = this;
			slug = slug.toString();
			slug = slug.trim();
			slug = slug.toLowerCase();
			slug = slug.replace(/\\u([0-9a-f]{4})/g, function (whole, group1) {
														return String.fromCharCode(parseInt(group1, 16));
													});
			slug = slug.replace(/\s+/g, '-');           // Replace spaces with -
			slug = slug.replace(/\./g,'-');							// Replace dots with -
			slug = slug.replace(/[^\w\-]+/g, '');       // Remove all non-word chars
			slug = slug.replace(/\-\-+/g, '-');         // Replace multiple - with single -
			slug = slug.replace(/^-+/, '');             // Trim - from start of text
			slug = slug.replace(/-+$/, '');            // Trim - from end of text
			slug = slug.alphanumeric();
			return slug;
}

// PHP EQUIVALENT OF NL2BR
function nl2br (str, is_xhtml) {
	if (typeof str === 'undefined' || str === null) {
		return '';
	}
	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

// GET FILE EXTENSION FROM FILE NAME
function getFileExt(name) {
	return name.substr((name.lastIndexOf('.')+1)) || name;
}

// GET SCROLLBARSIZES
function getScrollbarSizes(x) {
	var el= document.createElement('div');
	el.style.visibility= 'hidden';
	el.style.overflow= 'scroll';
	document.body.appendChild(el);
	var w= el.offsetWidth-el.clientWidth;
	var h= el.offsetHeight-el.clientHeight;
	document.body.removeChild(el);
	
	var ret = { 'w' : w , 'h' : h };
	return (typeof x !== 'undefined') ? ret[x] : ret;
}

// GET BASE URL
function baseUrl() {
	var url = window.location;
	var pathNames = url.pathname.trimLeft(DIR_SEPARATOR).split(DIR_SEPARATOR);
	var projName = pathNames[0];
	
	var baseUrl = url .protocol + DIR_SEPARATOR_DOUBLE + url.host + DIR_SEPARATOR + projName + DIR_SEPARATOR;
	return baseUrl;
}