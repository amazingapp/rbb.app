<?php

namespace Banijya;

use Illuminate\Database\Eloquent\Model;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
class Aavatar extends Model
{
    protected $table ='images';

    protected $baseDir = 'images/aavatar';

    protected $fillable = ['user_id' , 'name', 'caption', 'path', 'thumbnail_path', 'icon_path'];


    /**
     * An Aavatar belongs to a user
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Named Constructor
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public static function named($name)
    {
        return (new static)->saveAs($name);
    }


    /**
     * Setup the name of the images
     * @param   $name
     * @return  $this
     */
    public function saveAs($name)
    {
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf('%s/%s', $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf('%s/tn-%s', $this->baseDir, $this->name);
        $this->icon_path = sprintf('%s/ico-%s', $this->baseDir, $this->name);

        return $this;
    }

    /**
     * Move uploaded images to its destination path
     * @param  UploadedFile $file
     * @return $this
     */
    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        $this->makeIcon();

        return $this;
    }


    /**
     * Delete old files
     * @return $this
     */
    public function removeOldAavatar()
    {
        if( 'images/aavatar/dummy/aavatar.png' == $this->path) return $this;

        $files = [
                    public_path($this->path),
                    public_path($this->thumbnail_path),
                    public_path($this->icon_path),
                ];

        File::delete($files);

        return $this;
    }

    /**
     * Make Thumbnail
     * @return [type] [description]
     */
    protected function makeThumbnail()
    {
        Image::make($this->path)->fit(73)->save($this->thumbnail_path);
    }


    /**
     * Make Icon
     * @return
     */
    protected function makeIcon()
    {
        Image::make($this->path)->fit(48)->save($this->icon_path);
    }

}
