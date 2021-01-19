// More information on https://github.com/biati-digital/glightbox

import GLightbox from 'glightbox';
import _ from 'lodash';

const getMimeType = (url) => {
    return new Promise(function (resolve) {
        const xhr = new XMLHttpRequest();
        xhr.open('HEAD', url);
        xhr.onreadystatechange = function () {
            if (this.readyState === this.DONE) {
                resolve(this.getResponseHeader('Content-Type'));
            }
        };
        xhr.send();
    });
};

export default class Lightbox {

    static init() {
        _.each(document.querySelectorAll('[data-lightbox]'), (lightboxElement) => {
            lightboxElement.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                getMimeType(url).then((mimeType) => {
                    const isAudio = mimeType.startsWith('audio/');
                    const lightbox = GLightbox({
                        skin: isAudio ? 'clean audio' : 'clean',
                        elements: [
                            isAudio
                                ? {
                                    content: '<audio class="w-100" controls autoplay><source src="'
                                        + url + '"/></audio>',
                                    height: 'auto'
                                }
                                : {href: url}
                        ],
                        zoomable: false,
                        draggable: false
                    });
                    lightbox.open();
                });
            });
        });
    }

}
