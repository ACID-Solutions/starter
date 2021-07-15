import Collapse from 'bootstrap/js/dist/collapse';

export default class BootstrapCollapse {

    static init() {
        const collapseTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="collapse"]'));
        collapseTriggerList.map((collapseTriggerEl) => {
            return new Collapse(collapseTriggerEl);
        });
    }

}
