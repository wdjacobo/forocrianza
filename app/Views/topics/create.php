    <main class="col-md-9 col-lg-7 order-2 p-3 border rounded ">
        <form action="<?= base_url() . "crear-tema" ?>" method="post" class="row needs-validation g-3" novalidate>
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
                    <?php foreach (session()->get('errors') as $error): ?>
                        <?= $error ?>
                    <?php endforeach; ?>
                    <?= session('error') ?>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <!-- Cambiar este bloque por todo lo anterior adecuadamente -->
            <?php if (isset($errors)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>


            <div class="col-sm-12 d-flex ms-auto gap-1">
                <a href="<?= previous_url() ?>" class="w-100 btn btn-danger btn-lg text-center">Cancelar</a>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Publicar</button>
            </div>
        </form>
    </main>

    <script>
        // Pasar a script externo una vez lo tenga listo!!
        document.addEventListener('DOMContentLoaded', () => {
            const categories = <?= json_encode($categoriesWithSubcategories) ?>;
            const categorySelect = document.getElementById('category');
            const subcategorySelect = document.getElementById('subcategory');


            // Función para cargar subcategorías
            const loadSubcategories = (selectedCategory, selectedSubcategory) => {
                subcategorySelect.innerHTML = '<option value="">Selecciona una subcategoría...</option>';
                if (selectedCategory) {
                    const subcategories = categories.find(cat => cat.id == selectedCategory).subcategories || [];
                    subcategories.forEach(subcat => {
                        const option = document.createElement('option');
                        option.value = subcat.id;
                        option.textContent = subcat.title;
                        // Marcar como seleccionado si coincide con el valor anterior
                        if (selectedSubcategory == subcat.id) {
                            option.selected = true;
                        }
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false;
                } else {
                    subcategorySelect.disabled = true;
                }
            };

            // Al cargar la página, verificar si ya hay una categoría seleccionada
            const selectedCategory = categorySelect.value;
            const selectedSubcategory = subcategorySelect.dataset.selectedValue; // Recuperar el valor seleccionado previamente

            subcategorySelect.disabled = !selectedCategory; // Deshabilita si no hay categoría seleccionada

            if (selectedCategory) {
                loadSubcategories(selectedCategory, selectedSubcategory);
            }

            // Al cambiar la categoría, cargar las subcategorías correspondientes
            categorySelect.addEventListener('change', () => {
                const selectedCategory = categorySelect.value;
                loadSubcategories(selectedCategory, null);
            });
        });
    </script>