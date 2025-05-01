<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    /**
     * Get the model's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Upload and attach an image to the model.
     *
     * @param Request $request The request containing the image file
     * @param string $fieldName The name of the file input field (default: 'image')
     * @param string $storageDir The directory to store the image in (default: model's table name)
     * @return Image|null
     */
    public function uploadImage(Request $request, string $fieldName = 'image', ?string $storageDir = null)
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $file = $request->file($fieldName);

        // Validate file is an image
        if (!$file->isValid() || !in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'])) {
            return null;
        }

        // Set storage directory to model's table name if not provided
        if (!$storageDir) {
            $storageDir = $this->getTable();
        }

        $filename = time() . '_' . $file->getClientOriginalName();

        // Store image in public storage
        $path = $file->storeAs($storageDir, $filename, 'public');

        // Create image record with polymorphic relationship
        $image = new Image([
            'url' => $path,
            'filename' => $filename,
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
        ]);

        // Save image with polymorphic relationship
        $this->image()->save($image);

        return $image;
    }

    /**
     * Delete the image associated with the model.
     *
     * @return bool
     */
    public function deleteImage()
    {
        if (!$this->image) {
            return false;
        }

        // Delete the file from storage
        Storage::disk('public')->delete($this->image->url);

        // Delete the image record
        $this->image->delete();

        return true;
    }

    /**
     * Replace the current image with a new one.
     *
     * @param Request $request The request containing the image file
     * @param string $fieldName The name of the file input field (default: 'image')
     * @param string $storageDir The directory to store the image in (default: model's table name)
     * @return Image|null
     */
    public function replaceImage(Request $request, string $fieldName = 'image', ?string $storageDir = null)
    {
        // Delete old image if exists
        $this->deleteImage();

        // Upload new image
        return $this->uploadImage($request, $fieldName, $storageDir);
    }

    /**
     * Get image URL or default image if none exists.
     *
     * @param string $defaultImage Default image path
     * @return string
     */
    public function getImageUrl(?string $defaultImage = 'default/school.jpg')
    {
        if ($this->image) {
            return Storage::url($this->image->url);
        }

        return asset($defaultImage);
    }

    /**
     * Check if the model has an image.
     *
     * @return bool
     */
    public function hasImage()
    {
        return $this->image()->exists();
    }
}
