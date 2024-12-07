<div class="container">
    <!-- EXEMPLO BLOG -->
    <div class="row g-5">

        <aside class="col-md-3 p-0 pe-3">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary position-sticky p-0" style="top: 2rem;">
                <div class="list-group list-group-flush scrollarea rounded">
                    <div class="list-group-item py-3 lh-sm">
                        <div>Contenidos</div>
                        <ul style="list-style-type: none;">
                            <li><a href="#que-son-las-cookies">¿Qué son las cookies?</a></li>
                            <li><a href="#que-tipo-de-cookies-utilizamos">¿Qué tipo de cookies utilizamos?</a></li>
                            <li><a href="#como-puedo-gestionar-las-cookies">¿Cómo puede gestionar las cookies?</a></li>
                            <li><a href="#cambios-en-la-politica-de-cookies">Cambios en la política de cookies</a></li>
                            <li><a href="#informacion-de-contacto">Informacion de contacto</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="col-md-7 px-1">
            <h1 class="text-center my-4"><?php
                                            if (isset($title)) {
                                                echo esc($title);
                                            }
                                            ?></h1>
            <h3 id="que-son-las-cookies">¿Qué son las cookies?</h3>
            <p>Las cookies son procedimientos automáticos de recogida de información relativa a las preferencias determinadas por el usuario durante su visita al sitio Web con el fin de reconocerlo como usuario, y personalizar su experiencia y el uso del sitio Web, y pueden también, por ejemplo, ayudar a identificar y resolver errores.</p>
            <h3 id="que-tipo-de-cookies-utilizamos">¿Qué tipo de cookies utilizamos?</h3>
            <h4>Cookies propias</h4>
            <p>En ForoCrianza, utilizamos cookies de sesión. Estas cookies son temporales y se eliminan automáticamente una vez que cierra su navegador. La finalidad de estas cookies es gestionar su sesión en el foro y asegurarse de que puede navegar entre las distintas páginas de manera fluida sin tener que iniciar sesión continuamente. </p>
            <h4>Cookies de terceros</h4>
            <p>Son cookies utilizadas y gestionadas por entidades externas que proporcionan a ForoCrianza servicios solicitados por este mismo para mejorar el sitio web y la experiencia del usuario al navegar en el sitio web.</p>
            <p>Puede obtener más información sobre las cookies de terceros empleadas en ForoCrianza, como información sobre la privacidad, descripción del tipo de cookies que se utiliza, sus principales características o periodo de expiración en los siguientes enlaces:</p>
            <ul>
                <li><?= auto_link("Google Analytics: https://developers.google.com/analytics") ?></li>
            </ul>
            <h3 id="como-puedo-gestionar-las-cookies">¿Cómo puede gestionar las cookies?</h3>
            <p>Puede configurar su navegador para aceptar o rechazar todas las cookies, o bien para que le avise cada vez que se envíe una cookie. Si no acepta las cookies, algunas funciones del sitio web podrían no funcionar correctamente, como la funcionalidad de inicio de sesión.Para gestionar las cookies, siga las instrucciones de su navegador:
            </p>
            <ul>
                <li><?= auto_link("Google Chrome: https://support.google.com/chrome/answer/95647?hl=es") ?></li>
                <li><?= auto_link("Mozilla Firefox: https://support.mozilla.org/es/kb/Borrar%20cookies") ?></li>
                <li><?= auto_link("Microsoft Edge: https://support.microsoft.com/es-es/windows/administrar-cookies-en-microsoft-edge-ver-permitir-bloquear-eliminar-y-usar-168dab11-0753-043d-7c16-ede5947fc64d") ?></li>
                <li><?= auto_link("Safari: https://support.apple.com/es-es/guide/safari/sfri11471/mac") ?></li>
            </ul>
            <h3 id="cambios-en-la-politica-de-cookies">Cambios en la política de cookies</h3>
            <p class="mb-5">Podemos actualizar esta Política de Cookies para reflejar cambios en nuestra práctica o en la legislación vigente. Cuando realicemos modificaciones, se actualizará la fecha de la última revisión en la parte superior de este documento. Le recomendamos revisar esta página periódicamente para estar informado sobre cómo protegemos su privacidad al usar cookies.</p>
            <h3 id="informacion-de-contacto">Informacion de contacto</h3>
            <p>Si le surge cualquier tipo de duda o pregunta sobre nuestra Política de cookies, puede contactarnos a través de:</p>
            <ul class="mb-5">
                <li>Correo electrónico: <?= mailto('contacto@forocrianza.com', 'contacto@forocrianza.com'); ?></li>
            </ul>
        </div>
    </div>
</div>