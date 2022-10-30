import jQuery from "jquery";
import Cookies from "jquery.cookie";
import WOW from "wow.js";
import toastr from "toastr";

window.$ = jQuery;
window.jQuery = jQuery;
window.WOW = WOW;
window.Cookies = Cookies;
window.toastr = toastr;

require("jquery.scrollup/dist/jquery.scrollUp");

require("@popperjs/core");
require("bootstrap");
require("toastr");
require("./main");
