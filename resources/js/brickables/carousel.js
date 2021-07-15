import BootstrapCarousel from '../vendor/BootstrapCarousel';
import ResponsiveImages from '../utils/ResponsiveImages';

BootstrapCarousel.init();
ResponsiveImages.setCarouselHiddenImagesSizesAttributes(
    '.carousel',
    '.carousel-item.active > img',
    '.carousel-item:not(.active) > img'
);
