import Tooltip from 'bootstrap/js/dist/tooltip';

export default class BootstrapTooltips {

    static init() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new Tooltip(tooltipTriggerEl)
        })
    }

}
