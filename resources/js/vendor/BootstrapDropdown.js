import Dropdown from 'bootstrap/js/dist/dropdown';

export default class BootstrapDropdown {

    static init() {
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        dropdownElementList.map(function (dropdownToggleEl) {
            return new Dropdown(dropdownToggleEl);
        });
    }

}
