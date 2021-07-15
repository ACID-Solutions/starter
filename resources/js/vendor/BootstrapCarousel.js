import Carousel from 'bootstrap/js/dist/carousel';

export default class BootstrapCarousel {

    static init() {
        const carouselTriggerList = [].slice.call(document.querySelectorAll('[data-bs-ride="carousel"]'));
        carouselTriggerList.map((carouselTriggerEl) => {
            return new Carousel(carouselTriggerEl);
        });
    }

}
