<?php

namespace Tricks\Repositories;

use Tricks\User;
use Tricks\Torder;

interface TorderRepositoryInterface
{
    
    /**
     * Create a new order in the database.
     *
     * @param  array $data
     * @return \Tricks\Order
     */
    public function create(array $data);

    /**
     * Update the Order in the database.
     *
     * @param  $id
     * @param  array $data
     * @return \Tricks\Order
     */
    public function edit($id, array $data);

   

}
