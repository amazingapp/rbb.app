<?php

namespace Banijya;

use Illuminate\Database\Eloquent\Model;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $this->path = sprintf('/%s/%s', $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf('/%s/tn-%s', $this->baseDir, $this->name);
        $this->icon_path = sprintf('/%s/ico-%s', $this->baseDir, $this->name);

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

    protected function makeThumbnail()
    {
        Image::make($this->path)->fit(73)->save($this->thumbnail_path);
    }


    protected function makeIcon()
    {
        Image::make($this->path)->fit(48)->save($this->icon_path);
    }

}
