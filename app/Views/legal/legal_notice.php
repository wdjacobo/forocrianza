<div class="container">
    <!-- EXEMPLO BLOG -->
    <div class="row g-5">

        <aside class="col-md-3 p-0 pe-3">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary position-sticky p-0" style="top: 2rem;">
                <div class="list-group list-group-flush scrollarea rounded">
                    <div class="list-group-item py-3 lh-sm">
                        <div>Contenidos</div>
                        <ul style="list-style-type: none;">
                            <li><a href="#lssi">Ley de los servicios de la sociedad de la información (LSSI)</a></li>
                            <li><a href="#datos-identificativos">Datos identificativos</a></li>
                            <li><a href="#privacidad-y-tratamiento-de-datos">Privacidad y tratamiento de datos</a></li>
                            <li><a href="#propiedad-industrial-e-intelectual">Propiedad industrial e intelectual</a></li>
                            <li><a href="#informacion-de-contacto">Informacion de contacto</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="col-md-7 px-1">
            <h1 class="text-center my-4"><?php
                                            if (isset($title)) {
                                                echo $title;
                                            }
                                            ?></h1>
            <h3 id="lssi">Ley de los servicios de la sociedad de la información (LSSI)</h3>
            </h3>
            <p>ForoCrianza, responsable del sitio web, pone a disposición de los usuarios el presente documento, con el que pretende dar cumplimiento a las obligaciones dispuestas en la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), así como informar a todos los usuarios del sitio web respecto a cuáles son las condiciones de uso.</p>
            <p> Toda persona que acceda a este sitio web asume el papel de usuario, comprometiéndose a la observancia y cumplimiento riguroso de las disposiciones aquí dispuestas, así como a cualquier otra disposición legal que fuera de aplicación.</p>
            <p>ForoCrianza se reserva el derecho de modificar cualquier tipo de información que pudiera aparecer en el sitio web, sin que exista obligación de preavisar o poner en conocimiento de los usuarios dichas obligaciones, entendiéndose como suficiente con la publicación en el sitio web de ForoCrianza</p>
            <h3 id="datos-identificativos">Datos identificativos</h3>
            <ul>
                <li>Denominación social: ForoCrianza</li>
                <li>Nombre comercial: ForoCrianza</li>
                <li>CIF: 011235813F</li>
                <li>Domicilio: Meconio 5, Madrid.</li>
                <li>Correo electrónico: <?= mailto('contacto@forocrianza.com', 'contacto@forocrianza.com'); ?></li>
            </ul>
            <h3 id="privacidad-y-tratamiento-de-datos">Privacidad y tratamiento de datos</h3>
            <p>Cuando para el acceso a determinados contenidos o servicio sea necesario facilitar datos de carácter personal, los usuarios garantizarán su veracidad, exactitud, autenticidad y vigencia. La empresa dará a dichos datos el tratamiento automatizado que corresponda en función de su naturaleza o finalidad, en los términos indicados en la sección de <a href="<?= url_to('privacy-policy') ?>">Política de privacidad</a>.</p>
            <h3 id="propiedad-industrial-e-intelectual">Propiedad industrial e intelectual</h3>
            <p class="mb-5">El usuario reconoce y acepta que todos los contenidos que se muestran en el sitio web y en especial, diseños, textos, imágenes, logos, iconos, botones, software, nombres comerciales, marcas, o cualesquiera otros signos susceptibles de utilización industrial y/o comercial están sujetos a derechos de Propiedad Intelectual y todas las marcas, nombres comerciales o signos distintivos, todos los derechos de propiedad industrial e intelectual, sobre los contenidos y/o cualesquiera otros elementos insertados en el página, que son propiedad exclusiva de la empresa y/o de terceros, quienes tienen el derecho exclusivo de utilizarlos en el tráfico económico. Por todo ello el Usuario se compromete a no reproducir, copiar, distribuir, poner a disposición o de cualquier otra forma comunicar públicamente, transformar o modificar tales contenidos manteniendo indemne a la empresa de cualquier reclamación que se derive del incumplimiento de tales obligaciones. En ningún caso el acceso al Espacio Web implica ningún tipo de renuncia, transmisión, licencia o cesión total ni parcial de dichos derechos, salvo que se establezca expresamente lo contrario.</p>
            <h3 id="informacion-de-contacto">Informacion de contacto</h3>
            <p>Si le surge cualquier tipo de duda o pregunta o inquietudes sobre nuestro Aviso legal, puede contactarnos a través de:</p>
            <ul class="mb-5">
                <li>Correo electrónico: <?= mailto('contacto@forocrianza.com', 'contacto@forocrianza.com'); ?></li>
            </ul>
        </div>
    </div>
</div>