/* import './bootstrap'; */

import Alpine from 'alpinejs';
import slug from 'alpinejs-slug';

/* import intersect from '@alpinejs/intersect' */
import intersectClass from 'alpinejs-intersect-class'

window.Alpine = Alpine;

Alpine.plugin(slug)
/* Alpine.plugin(intersect) */
Alpine.plugin(intersectClass)

Alpine.start();


