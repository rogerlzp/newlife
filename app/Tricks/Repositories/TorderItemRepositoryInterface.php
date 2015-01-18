<?php

namespace Tricks\Repositories;

use Tricks\User;
use Tricks\TorderItem;

interface TorderItemRepositoryInterface
{
    
    /**
     * Create a new orderitem in the database.
     *
     * @param  array $data
     * @return \Tricks\OrderItem
     */
    public function create(array $data);

    /**
     * Update the OrderItem in the database.
     *
     * @param  $id
     * @param  array $data
     * @return \Tricks\OrderItem
     */
    public function edit($id, array $data);

    /**
     * Increment the view count on the given trick.
     *
     * @param  \Tricks\Trick  $trick
     * @return \Tricks\Trick
     */
   // public function incrementViews(Trick $trick);

    /**
     * Find all tricks for the tag that matches the given slug.
     *
     * @param  string $slug
     * @param  integer $perPage
     * @return array
     */
   
}
