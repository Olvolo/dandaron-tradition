import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Подключаем плагин collapse
Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();
