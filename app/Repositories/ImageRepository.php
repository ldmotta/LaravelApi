<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageRepository implements ImageRepositoryInterface
{
    protected $model;
    protected $uploadFolder;
    protected $imageField;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->uploadFolder = $model->getTable();
        $this->imageField = 'image';
    }
    
    // Upload image
    public function doUpload($request)
    {
        if ($request->hasFile($this->imageField) && $request->file($this->imageField)->isValid()) {
            $filePath = "{$this->uploadFolder}/{$request->image}";

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            $newName = $this->makeImageName($request);

            return $request->image->storeAs($this->uploadFolder, $newName);
        }
    }

    /**
     * Cria um name para fazer upload da imagem
     * @param \Illuminate\Http\Request  $request
     * @param string $imageField
     * @param bool $unique
     * @return string
     */
    public function makeImageName($request, $unique = false)
    {
        $name = Str::kebab($request->name);      
        if ($unique) {
            $name = md5($request->name . time());
        }
        $ext = $request->file($this->imageField)->extension();
        return "{$name}.{$ext}"; 
    }

    /**
     * Defines which will be the image field in the database
     * 
     * @param string $field
     */
    public function setImageField($field)
    {
        $this->imageField = $field;
    }

    /**
     * Defines which will be the image folder for the stored images
     * 
     * @param string $field
     */
    public function setUploadFolder($newFolder)
    {
        $this->uploadFolder = $newFolder;
    }
    
}
