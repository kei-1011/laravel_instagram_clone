
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });


$(function () {
    /**
     * コメント欄でenterでsubmit、shift+enterで改行
     */
    $(document).on("keypress", ".comment-input", function (e) {
        var form = $(this).parent().parent('form');

        console.log(form);
        if (e.keyCode == 13) {
            if (e.shiftKey) {
            $.noop();
            } else if ($(this).val().replace(/\s/g, "").length > 0) {
            e.preventDefault();
            form.submit();
            }
        } else {
            $.noop();
        }
    });
});
