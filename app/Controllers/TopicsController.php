<?php
declare(strict_types=1);

namespace App\Controllers;

class TopicsController extends BaseController
{

    public function index()
    {
        $model = model('topicsModel');

        //Uso de paginate!
        $data = [
            'users' => $model->paginate(10),
            'pager' => $model->pager,
        ];

        // If you want to add WHERE conditions
        $data = [
            'users' => $model->where('ban', 1)->paginate(10),
            'pager' => $model->pager,
        ];

        // Ou pasar ao modelo isto:
/*         public function banned()
        {
            $this->builder()->where('ban', 1);
    
            return $this; // This will allow the call chain to be used.
        } */
       // E aquí facer
       $data = [
           'users' => $model->banned()->paginate(10),
           'pager' => $model->pager,
       ];

       // En la vista usamos así los links:
       /*<?= $pager->links() ?> */


        return view('users/index', $data);
    }
}
