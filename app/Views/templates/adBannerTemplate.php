<aside names="ad-banner" class="col-md-3 col-lg-2 order-md-3 order-sm-1 mb-3 mb-md-0 px-1">
    <div id="ad-container" class="position-sticky">
        <svg id="close-ad-icon" xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="white" class="position-absolute top-0 end-0 p-1">
            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
        </svg>
        <a href="https://www.fortnite.com/item-shop/v-bucks?lang=es-ES">
            <picture>
                <!-- Pantallas más pequeñas que el breackpoint md (< 768px) -->
                <source media="(max-width: 767px)" srcset="<?= esc($ad_urls['small']) ?>" width="100%">
                <!-- Para pantallas mayores o iguales a lg (992px o más) -->
                <img class="p-0 bg-body-tertiary" src="<?= esc($ad_urls['normal']) ?>" alt="Imagen publicitaria" width="100%">
            </picture>
            <!-- Las fotos utilizadas en los carteles publicitarios han sido obtenidas en Unsplash (https://unsplash.com/) o en Freepik (http://www.freepik.com) a través de una licencia gratuita. Todas han sido editadas. -->
            <a href=""></a>
        </a>
    </div>
</aside>
</div>