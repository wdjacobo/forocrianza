<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class MessagesController extends BaseController
{

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

    //: RedirectResponse
    public function delete(int $message_id)
    {
        $messagesModel = model('MessagesModel');
        $message = $messagesModel->find($message_id);

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
