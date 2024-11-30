<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use App\Models\SubcategoriasModel;


class CategoriasModel extends Model
{

    // See: https://www.codeigniter.com/user_guide/models/model.html

    //The first two are used by all of the CRUD methods to determine what table to use and how we can find the required records:

    protected $table      = 'users'; // The database table that this model primarily works with
    protected $primaryKey = 'id'; // Name of the column that uniquely identifies the records in this table, used with methods like find() to know what column to match the specified value to

    protected $useAutoIncrement = true; // Specifies if the table uses an auto-increment feature for $primaryKey.

    protected $returnType     = 'array'; // the type of data that is returned Valid values are ‘array’ (the default), ‘object’, or the fully qualified name of a class
    protected $useSoftDeletes = true; // If true, then any delete() method calls will set deleted_at in the database, instead of actually deleting the row. This can preserve data when it might be referenced elsewhere, or can maintain a “recycle bin” of objects that can be restored, or even simply preserve it as part of a security trail. If true, the find*() methods will only return non-deleted rows, unless the withDeleted() method is called prior to calling the find*() method. Ver documentación.

    protected $allowedFields = ['name', 'email']; // This array should be updated with the field names that can be set during save(), insert(), or update() methods. The $primaryKey field should never be an allowed field.

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true; // Whether to update Entity’s only changed fields. The default value is true, meaning that only changed field data is used when updating to the database.

    // Allows you to convert data retrieved from a database into the appropriate PHP type.
    protected array $casts = [
        //ejemplos
        'id'        => 'int',
        'birthdate' => '?datetime', // Add a question mark at the beginning of type to mark the field as nullable
        'hobbies'   => 'json-array',
        'active'    => 'int-bool',
    ];

    // Dates
    protected $useTimestamps = false; // This requires that the table have columns named created_at, updated_at and deleted_at in the appropriate data type
    protected $dateFormat    = 'datetime'; // Valid options are: 'datetime', 'date', or 'int'
    protected $createdField  = 'created_at'; // Set to an empty string ('') to avoid updating it (even $useTimestamps is enabled).
    protected $updatedField  = 'updated_at'; // Set to an empty string ('') to avoid updating it (even $useTimestamps is enabled).
    protected $deletedField  = 'deleted_at'; // Specifies which database field to use for soft deletions.

    // Validation
    protected $validationRules      = []; // Contains either an array of validation rules as described in How to Save Your Rules
    protected $validationMessages   = []; // Contains an array of custom error messages that should be used during validation, as described in Setting Custom Error Messages.
    protected $skipValidation       = false; // Whether validation should be skipped during all inserts and updates. The default value is false, meaning that data will always attempt to be validated.
    protected $cleanValidationRules = true; // This is used in updates. The default value is true, meaning that validation rules for the fields that are not present in the passed data will be (temporarily) removed before the validation. This is to avoid validation errors when updating only some fields.

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

    /*
protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

        protected array $casts = [
        //ejemplos
        'id'        => 'int',
        'birthdate' => '?datetime',
        'hobbies'   => 'json-array',
        'active'    => 'int-bool',
    ];

    // Dates
    protected $useTimestamps = false;
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
*/


// Métodos disponibles:

/*

FIND DATA:

find(acepta varios primary keys)
findColumn()
findAll() Acepta Query Builder commands
first()
withDeleted()
onlyDeleted()


SAVING DATA:



*/

}
