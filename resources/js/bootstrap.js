import 'bootstrap';
import '@popperjs/core';  // Import Popper.js, required by Bootstrap

import axios from 'axios';  // Your existing axios setup
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
