import './bootstrap';
import Alpine from 'alpinejs';
import jQuery from 'jquery';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as Popper from '@popperjs/core';

window.Alpine = Alpine;
window.$ = window.jQuery = jQuery;
window.Popper = Popper;

Alpine.start();
