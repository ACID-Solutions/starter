// Doc available @ https://cookieconsent.insites.com/documentation/javascript-api

export default class CookieConsentConfig {

    static setup = () => {
        window.cookieconsent.initialise({
            container: document.getElementById('layout'),
            content: {
                message: app.cookieConsent.message,
                dismiss: app.cookieConsent.dismiss,
                link: app.cookieConsent.link,
                href: app.gdprPage.route
            },
            elements: {
                dismiss: '<a'
                    + 'aria-label="dismiss cookie message"'
                    + 'tabindex="0"'
                    + 'class="cc-btn cc-dismiss btn btn-outline-primary">'
                    + '{{dismiss}}'
                    + '</a>'
            },
            revokable: false,
            law: {
                regionalLaw: false
            },
            location: false
        });
    };

}
