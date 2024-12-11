    <main class="col-md-9 col-lg-7 order-2 p-3">
        <form action="<?= base_url() . "crear-tema" ?>" method="post" class="row needs-validation g-3 p-2 pb-4 border rounded bg-white" novalidate>
            <?= csrf_field() ?>
            <div class="col-12">
                <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
            </div>
            <div class="col-md-6 form-group">
                <label for="category" class="form-label">Categoría *</label>
                <select
                    id="category"
                    name="category"
                    class="form-select"
                    required>
                    <option value="">Selecciona una categoría...</option>
                    <?php if (isset($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>" <?php
                                                                    if (esc(set_value('category')) === $category['id']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?= $category['title'] ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una categoría
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="subcategory" class="form-label">Subcategoría *</label>
                <select
                    id="subcategory"
                    name="subcategory"
                    class="form-select"
                    data-selected-value="<?= esc(set_value('subcategory')) ?>"
                    required>
                    <option value="">Selecciona una subcategoría...</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una subcategoría
                </div>
            </div>
            <div class="col-sm-12 form-group">
                <label for="topic-title" class="form-label">Título *</label>
                <input
                    id="topic-title"
                    name="topic-title"
                    type="text"
                    class="form-control"
                    value="<?= esc(set_value('topic-title')) ?>"
                    placeholder="Introduce un título para el tema..."
                    minlength="10"
                    maxlength="250"
                    required>
                <small class="text-body-secondary">Debe contener al menor 10 caracteres</small>
                <div class="invalid-feedback">
                    Introduce un título válido. Asegúrate de cumplir las reglas para el título.
                </div>
            </div>
            <div class="col-sm-12 topic-opening-message">
                <label for="topic-opening-message" class="form-label">Contenido *</label>
                <textarea
                    id="topic-opening-message"
                    name="topic-opening-message"
                    class="form-control"
                    placeholder="Incluir edición con Quill"
                    rows="8"
                    minlength="40"
                    required><?= esc(set_value('topic-opening-message')) ?></textarea>
                <small class="text-body-secondary">Debe contener al menor 40 caracteres</small>
                <div class="invalid-feedback">
                    Introduce un contenido válido. Asegúrate de cumplir las reglas para el contenido.
                </div>
            </div>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('warn')): ?>
                <div class="alert alert-warning">
                    <?= session('warn') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                    <ul>
                        <?php foreach (session()->get('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                    <ul>
                        <li> <?= session('error') ?></li>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="col-sm-12 d-flex ms-auto gap-1">
                <a href="<?= previous_url() ?>" class="w-100 btn btn-danger btn-lg text-center">Cancelar</a>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Publicar</button>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Array de categorías que se pasa desde PHP a JS
            const categories = <?= json_encode($categories) ?>;

            const categorySelect = document.getElementById('category'); // Select de categorías
            const subcategorySelect = document.getElementById('subcategory'); // Select de subcategorías

            // Función para cargar las subcategorías según la categoría seleccionada
            const loadSubcategories = (selectedCategory) => {
                console.log("selectedCategory:", selectedCategory); // Verifica el valor de selectedCategory

                // Limpiar las opciones actuales de subcategorías
                subcategorySelect.innerHTML = '<option value="">Selecciona una subcategoría...</option>';

                // Deshabilitar el select de subcategorías si no hay categoría seleccionada
                if (!selectedCategory) {
                    subcategorySelect.disabled = true;
                    return;
                }

                // Buscar la categoría seleccionada en el array de categorías
                const category = categories.find(cat => cat['id'] == selectedCategory); // Accede con corchetes, no con punto
                console.log("Category:", category); // Verifica si se encontró la categoría

                // Verificar si la categoría tiene la propiedad 'subcategories' y si tiene subcategorías
                if (category && Array.isArray(category['subcategories'])) {
                    if (category['subcategories'].length > 0) {
                        // Cargar las subcategorías en el select
                        category['subcategories'].forEach(subcat => {
                            const option = document.createElement('option');
                            option.value = subcat['id']; // Accede con corchetes
                            option.textContent = subcat['title']; // Accede con corchetes

                            // Añadir la opción de subcategoría al select
                            subcategorySelect.appendChild(option);
                        });

                        // Habilitar el select de subcategorías
                        subcategorySelect.disabled = false;
                    } else {
                        // Si no hay subcategorías, deshabilitar el select
                        subcategorySelect.disabled = true;
                    }
                } else {
                    // Si la categoría no tiene subcategorías, deshabilitar el select
                    subcategorySelect.disabled = true;
                }
            };

            // Obtener el valor seleccionado de la categoría
            const selectedCategory = categorySelect.value;
            console.log("Initial selectedCategory:", selectedCategory); // Verifica el valor de selectedCategory

            // Si ya hay una categoría seleccionada, cargar las subcategorías correspondientes
            loadSubcategories(selectedCategory);

            // Event listener para cuando cambie la categoría seleccionada
            categorySelect.addEventListener('change', () => {
                const selectedCategory = categorySelect.value;
                console.log("Category changed, selectedCategory:", selectedCategory); // Verifica el cambio de categoría
                loadSubcategories(selectedCategory); // Recarga las subcategorías
            });
        });
    </script>