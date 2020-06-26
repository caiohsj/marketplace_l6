<?php
namespace App\Traits;

trait UploadTrait
{
    private function imageUpload($images, $columnImage = null)
    {
        $uploadeImages = [];
        if (is_array($images)) {
            foreach ($images as $image) {
                $uploadeImages[] = [$columnImage => $image->store('product', 'public')];
            }
        } else {
            return $images->store('logo' ,'public');
        }
        return $uploadeImages;
    }
}
