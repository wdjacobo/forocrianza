<div class="row">
    <aside class="col-lg-3 col-xl-3 col-xxl-2 d-flex flex-column align-items-stretch flex-shrink-0 mb-3 mb-lg-0">
        <div class="list-group list-group-flush scrollarea border rounded">
            <a href="<?= url_to('categories') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Categorías' ? 'active' : '' ?>"" aria-current=" true">
                <div class="d-flex w-100 align-items-center justify-content-between px-1">
                    <strong>Categorías</strong>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                        <path d="M120-120v-720h720v720H120Zm60-60h600v-600H180v600Zm0 0v-600 600Z" />
                    </svg>
                </div>
            </a>
            <a href="<?= url_to('subcategories') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Subcategorías' ? 'active' : '' ?>"" aria-current=" true">
                <div class="d-flex w-100 align-items-center justify-content-between px-1">
                    <strong>Subcategorías</strong>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                        <path d="M120-510v-330h330v330H120Zm0 390v-330h330v330H120Zm390-390v-330h330v330H510Zm0 390v-330h330v330H510ZM180-570h210v-210H180v210Zm390 0h210v-210H570v210Zm0 390h210v-210H570v210Zm-390 0h210v-210H180v210Zm390-390Zm0 180Zm-180 0Zm0-180Z" />
                    </svg>
                    </svg>
                </div>
            </a>
            <a href="<?= url_to('topics') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Temas' ? 'active' : '' ?>"" aria-current=" true">
                <div class="d-flex w-100 align-items-center justify-content-between px-1">
                    <strong>Temas</strong>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                        <path d="M120-120v-720h720v720H120Zm640-143H200v78h560v-78Zm-560-41h560v-78H200v78Zm0-129h560v-327H200v327Zm0 170v78-78Zm0-41v-78 78Zm0-129v-327 327Zm0 51v-51 51Zm0 119v-41 41Z" />
                    </svg>
                </div>
            </a>
            <a href="<?= url_to('users') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Usuarios' ? 'active' : '' ?>"" aria-current=" true">
                <div class="d-flex w-100 align-items-center justify-content-between px-1">
                    <strong>Usuarios</strong>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                        <path d="M38-160v-94q0-35 18-63.5t50-42.5q73-32 131.5-46T358-420q62 0 120 14t131 46q32 14 50.5 42.5T678-254v94H38Zm700 0v-94q0-63-32-103.5T622-423q69 8 130 23.5t99 35.5q33 19 52 47t19 63v94H738ZM358-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42Zm360-150q0 66-42 108t-108 42q-11 0-24.5-1.5T519-488q24-25 36.5-61.5T568-631q0-45-12.5-79.5T519-774q11-3 24.5-5t24.5-2q66 0 108 42t42 108ZM98-220h520v-34q0-16-9.5-31T585-306q-72-32-121-43t-106-11q-57 0-106.5 11T130-306q-14 6-23 21t-9 31v34Zm260-321q39 0 64.5-25.5T448-631q0-39-25.5-64.5T358-721q-39 0-64.5 25.5T268-631q0 39 25.5 64.5T358-541Zm0 321Zm0-411Z" />
                    </svg>
                </div>
            </a>
        </div>
    </aside>