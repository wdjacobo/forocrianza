<?php
declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use App\Models\MensajesModel;


class TemasModel extends Model
{
    protected $table = 'categorias';
    // Solo admin y mod pueden modificar el id_subcategoria una vez creada el tema
    protected $allowedFields = ['titulo', 'id_subcategoria'];


    // Cargar el modelo de mensajes en el constructor
    protected $smensajesModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de mensajes
        $this->smensajesModel = new MensajesModel();
    }


    /**
     * 
     * With this code, you can perform two different queries.
     * You can get all news records, or get a news item by its slug.
     * You might have noticed that the $slug variable wasn’t escaped before running the query;
     * Query Builder does this for you.
     * 
     * @param false|string $titulo
     *
     * @return array|null
     */
    public function getTemas($id = false)

    {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    /**
     * Obtener subcategorías por id_categoria
     * 
     * @param int $id_categoria
     * @return array
     */
    public function getTemasBySubcategoria($id_subcategoria)
    {
        return $this->where('id_categoria', $id_subcategoria)->findAll();
    }

    //Esto podría adaptarlo para que busque en todas las categorias o solo la de la id proporcionada, como en getCategorias.
    /**
     * Obtener todas las categorías con sus subcategorías
     * 
     * @return array
     */
    public function getTemasConMensajes()
    {

        // Obtener todas las categorías
        $categorias = $this->findAll();

        // Para cada categoría, obtener sus subcategorías
        foreach ($categorias as &$categoria) {
            // Obtener subcategorías asociadas a esta categoría
            $categoria['subcategorias'] = $this->subcategoriasModel->getSubcategoriasByCategoriaId($categoria['id']);
        }

        return $categorias;
    }


    // Asegurarse que tienen el campo created_at, el código sería así de sencillo
    public function getUltimosTemas($limite = 5)
{
    return $this->orderBy('created_at', 'DESC')
                ->findAll($limite);
}

//                      _ 
//                     | |
//   ___ _ __ _   _  __| |
//  / __| '__| | | |/ _` |
// | (__| |  | |_| | (_| |
//  \___|_|   \__,_|\__,_|


    /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function crearCategoria()
    {
        /*         // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();

        $user = new User([
            'username' => 'foo-bar',
            'email'    => '[email protected]',
            'password' => 'secret plain text password',
        ]);

        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user); */
    }
}
