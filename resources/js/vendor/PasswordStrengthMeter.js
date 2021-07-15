import zxcvbn from 'zxcvbn';
import {each} from 'lodash';

const insertStrengthMeterBarInContainer = (element) => {
    const passwordMeterWrapDiv = document.createElement('div');
    passwordMeterWrapDiv.classList.add('password-meter-wrap');
    const passwordMeterBarDiv = document.createElement('div');
    passwordMeterBarDiv.classList.add('password-meter-bar');
    passwordMeterWrapDiv.appendChild(passwordMeterBarDiv);
    element.after(passwordMeterWrapDiv);
};

export default class PasswordStrengthMeter {

    static init() {
        const elements = document.querySelectorAll('[data-password-strength-meter]');
        if (elements.length < 1) {
            return false;
        }
        each(elements, (element) => {
            insertStrengthMeterBarInContainer(element);
            let bar = element.querySelector('.password-meter-bar');
            element.addEventListener('keyup', () => {
                let value = element.value;
                bar.classList.remove('level0', 'level1', 'level2', 'level3', 'level4');
                let result = zxcvbn(value);
                let cls = `level${result.score}`;
                bar.classList.add(cls);
            }, false);
        });
    }

}
