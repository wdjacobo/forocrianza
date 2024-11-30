<?php
declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use App\Models\SubcategoriasModel;


class UsersInfoModel extends Model
{
    protected $table = 'users_info';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['bio', 'status_message', 'highlight_topic'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    // Cargar el modelo de subcategorías en el constructor
    protected $subcategoriasModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de subcategorías
        //$this->subcategoriasModel = new SubcategoriasModel();
    }


    //Esto podría adaptarlo para que busque en todas las categorias o solo la de la id proporcionada, como en getCategorias.
    /**
     * Obtener todas las categorías con sus subcategorías
     * 
     * @return array
     */
    public function getCategoriasConSubcategorias()
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
    public function getCategorias($id = false)

    {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
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
