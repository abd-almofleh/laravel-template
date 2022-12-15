import jQuery from "jquery";
import Cookies from "jquery.cookie";
import WOW from "wow.js";
import toastr from "toastr";
import Swal from 'sweetalert2'
import "lazysizes";
// import a plugin
import "lazysizes/plugins/parent-fit/ls.parent-fit";

window.$ = jQuery;
window.jQuery = jQuery;
window.WOW = WOW;
window.Cookies = Cookies;
window.toastr = toastr;
window.Swal = Swal;

require("jquery.scrollup/dist/jquery.scrollUp");

require("@popperjs/core");
require("bootstrap");
require("toastr");
require("slick-carousel");
require("@zeitiger/elevatezoom");
require("./main");
