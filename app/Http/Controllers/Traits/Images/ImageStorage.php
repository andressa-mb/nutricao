<?php

namespace App\Http\Controllers\Traits\Images;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageStorage {

    //Salvar ou Editar
    public function editOrCreateImage(UploadedFile $image, $model): string{
        $extension = $image->extension();
        $folder = strtolower(class_basename($model));

        if(!is_null($model->image)){
            Storage::disk('public')->delete($model->image->url); //deletando da pasta storage
        }

        $file = "{$folder}_{$model->id}.{$extension}";
        $path = $image->storeAs($folder.'s', $file, 'public');

        return $path;
    }


    //Deletar imagem
    public function deleteImage($model): void{
        Storage::disk('public')->delete($model->image->url);//deletando da pasta storage
        $model->image()->delete(); //deletando do banco
    }

}
