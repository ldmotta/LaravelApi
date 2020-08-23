<?php 
namespace App\Repositories;

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
interface RepositoryInterface
{
    /**
     * Finds all entry of the container and returns it.
     *
     * @return \Illuminate\Http\Response
     */
    public function all();

    /**
     * Creates a record in a container from the given array data.
     *
     * @param array $data Array of data that you want to store
     * @return \Illuminate\Http\Response
     */
    public function create(array $data);

    /**
     * Updates a record in a container from the given object data.
     *
     * @param object $data Object of tha fields that you want to update
     * @return \Illuminate\Http\Response
     */
    public function update(array $data);

    /**
     * Finds an entry of the container by its identifier and remove it.
     *
     * @param string $id Identifier of the entry to remove.
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function delete($product);

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function show($id);
}