<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class MessagesController extends BaseController
{


    /**
     * Permite crear un nuevo mensaje en un tema si el usuario está autenticado.
     * 
     * @param int|string $topicId ID del tema donde se creará el mensaje.
     * 
     * @return RedirectResponse Redirige a la página correspondiente junto con mensajes
     * 
     * @throws \Exception Si surge algún problema durante la inserción del mensaje en la BBDD
     */
    public function create($topicId)
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('warn', 'Debes iniciar sesión para publicar un mensaje');
        }

        if ($this->request->is('post')) {

            $data = $this->request->getPost();

            $rules = [
                'message' => 'required|min_length[10]|trim',
            ];

            $errors = [
                'message' => [
                    'required' => 'Debes escribir algo en tu mensaje',
                    'min_length' => 'El mensaje es demasiado corto',
                ],
            ];

            //1. Validar
            // Si se intenta crear un mensaje en un tema que no existe, redirigimos a inicio
            $topicsModel = model('TopicsModel');
            $topicId = filter_var(intval($topicId), FILTER_VALIDATE_INT);
            if (!$topicsModel->find($topicId)) {
                return redirect()->to('index');
            }

            if ($this->validateData($data, $rules, $errors)) {
                $validData = $this->validator->getValidated();

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos
                // Aplicar sanitización de Quill usando clean_html de HTML Purifier; strip_tags() no es seguro, no sanitiza los atributos.

                // 4. Acción en la BD
                $messagesModel = model('MessagesModel');
                try {
                    $messagesModel->insert(
                        [
                            'content' => $validData['message'],
                            'author_id' => user_id(),
                            'topic_id' => $topicId,
                        ]
                    );

                    return redirect()->back();
                } catch (\Exception $e) {

                    // 5. Manejo de excepciones
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error inesperado al guardar el mensaje, inténtalo de nuevo.');
                }
            } else { // 2. Devolver errores
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }

    /**
     * Elimina un mensaje específico por su ID.
     * 
     * Este método permite eliminar un mensaje de la base de datos. Si la eliminación es exitosa,
     * redirige al usuario con un mensaje de confirmación. En caso de error, redirige con un mensaje
     * de error indicando el problema.
     * 
     * @param int $messageId ID del tema a eliminar.
     * 
     * @return RedirectResponse Redirige a la página correspondiente junto con mensajes
     * 
     * @throws \Exception Si surge algún problema durante la eliminación del mensaje en la BBDD
     */
    public function delete(int $messageId): RedirectResponse
    {
        $messagesModel = model('MessagesModel');
        $message = $messagesModel->find($messageId);

        // 1. Acción en la BD
        try {
            $messagesModel->delete($message);
            return redirect()->back()->with('success', 'Mensaje eliminado correctamente.');
        } catch (\Exception $e) {
            // 2. Manejo de excepciones
            return redirect()->back()->with('error', 'Se produjo un error al eliminar el mensaje, inténtalo de nuevo.');
        }
    }
}
