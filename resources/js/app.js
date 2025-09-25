import './bootstrap';
import 'preline';
import { refreshTooltips } from './components/tooltip';

document.addEventListener('alpine:init', () => {
    Alpine.data('refreshTooltips', refreshTooltips);
});