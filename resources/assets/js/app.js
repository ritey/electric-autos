
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));

//const app = new Vue({
//    el: 'body'
//});
$('document').ready(function() {
  $('a[href="#filters"').css('cursor','pointer');
	$(document).on('click','a[href="#filters"',function(e) {
		e.preventDefault();
		if ($('.filters').hasClass('visible-xs')) {
			$(this).html('Show filters');
			$('.filters').removeClass('visible-xs');
			$('.filters').removeClass('visible-sm');
		} else {
			$(this).html('Hide filters');
			$('.filters').addClass('visible-xs');
			$('.filters').addClass('visible-sm');
		}
		return false;
	});
});