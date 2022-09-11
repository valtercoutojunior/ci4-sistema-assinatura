<?php

namespace App\Services;

class ImageService
{


    public static function storeImages(
        array|object $images,
        string $pathToStore,
        string|int $propertyKey = 'propertyKey',
        string|int $propertyValue = null
    ): array {

        //Verifica se foi enviada apenas uma imagen(object)
        if (is_object($images)) {
            self::worksWithImage($images, $pathToStore);
        }

        //Verifica quando for enviada muitas imagens(array)
        $uploadedImages = [];
        foreach ($images['images'] as $image) {
            $uploadedImages[] = [
                $propertyKey => $propertyValue,
                'image' =>  self::worksWithImage($image, $pathToStore)
            ];
        }
        return $uploadedImages;
    }

    public static function showImage(string $imagePath, string $image, string $sizeImage = 'regular')
    {
        if ($sizeImage == 'small') {
            $imagePath = WRITEPATH . "uploads/$imagePath/small/$image";
        } else {
            $imagePath = WRITEPATH . "uploads/$imagePath/$image";
        }

        //Recupera informações relacionadas a imagem selecionada
        $fileInfo = new \finfo(FILEINFO_MIME);
        $fileType = $fileInfo->file($imagePath);
        header("Content-Type:  $fileType");
        header("Content-Length: " . filesize($imagePath));
        readfile($imagePath);
        exit;
    }


    public static function destroyImage(string $pathToImage, string $imageToDestroy)
    {
        $regularImageToDetroy   = WRITEPATH . "uploads/$pathToImage/$imageToDestroy";
        $smallImageToDetroy     = WRITEPATH . "uploads/$pathToImage/small/$imageToDestroy";

        if (is_file($regularImageToDetroy)) {
            unlink($regularImageToDetroy);
        }
        if (is_file($smallImageToDetroy)) {
            unlink($smallImageToDetroy);
        }
    }

    private static function worksWithImage(object $image, string $pathToStore): string
    {
        //Aqui amazenamos a imagem no caminho informado
        $imagePath = $image->store($pathToStore);
        //Fullpath de onde foi armazenado a imagem(caminho relativo)
        $imagePath = WRITEPATH . "uploads/$imagePath";
        //Cria uma copia miniatura com da imagem
        $imageSmallPath = WRITEPATH . "uploads/$pathToStore/small/";

        //Cria a pasta small caso ela não exista
        if (!is_dir($imageSmallPath)) {
            mkdir($imageSmallPath);
        }

        //manipula a imagem para criar uma copia menor doque a original
        service('image')
            ->withFile($imagePath) //Local da imagem original
            ->resize(275, 275, true, 'center') //defini o tamanho da imagem small
            ->save($imageSmallPath . $image->getName()); //Renomeia a imagem para que não haja imagens com nomes duplicados
        return $image->getName();
    }
}
