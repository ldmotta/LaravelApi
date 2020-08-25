<?php 
namespace App\Repositories;

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
interface ImageRepositoryInterface
{
    /**
     * Finds all entry of the container and returns it.
     *
     * @return \Illuminate\Http\Response
     */
    public function doUpload($request);

    public function makeImageName($request, $unique = false);

    public function setImageField($field);

    public function setUploadFolder($newFolder);
}
