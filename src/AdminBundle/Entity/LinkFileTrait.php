<?php
/**
 * Created by PhpStorm.
 * User: michal@glajc.pl
 * Date: 11.11.2016
 * Time: 14:08
 */

namespace AdminBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

trait LinkFileTrait
{
    private $location='/../../../web/media/link' ;
    private $path=__DIR__;

    public function checkDir()
    {
        $id=$this->getId();

        $fs=new Filesystem();
        if (!$fs->exists($this->path.$this->location)) {
            $fs->mkdir($this->path.$this->location);
        }
        $this->setImagePath($this->path.$this->location.'/'.$id.'');
        if (!$fs->exists($this->getImagePath())) {
            $fs->mkdir($this->getImagePath());
        }
    }

    public function getImages()
    {
        $this->checkDir();
        $finder = new Finder();
        return $finder->files() ->in($this->getImagePath());
    }

    public function getRandomImage()
    {
        $images=$this->getImages();
        $images=iterator_to_array($images);
        if (count($images)<1) {
            return null;
        }
        shuffle($images);
        return $images[0];
    }

    public function UploadFile(UploadedFile $file)
    {
        $file->move($this->getImagePath().'/', $file->getClientOriginalName());
    }

    public function removeImage($file)
    {
        $this->checkDir();
        $fs=new Filesystem();
        if ($fs->exists($this->getImagePath().'/'.$file)) {
            $fs->remove($this->getImagePath().'/'.$file);
        }
    }

    public function imageExists($image)
    {
        $this->checkDir();
        $fs=new Filesystem();

        return $fs->exists($this->getImagePath().'/'.$image);
    }


    public function getRelativePath($path)
    {
        $path=strtr($path, "\\", "/");
        $x=explode('../web/', $path);
        return $x[1];
    }


    public function getImageName($path)
    {
        $path=strtr($path, "\\", "/");
        $x=explode('/', $path);
        return $x[count($x)-1];
    }

    public function getFileName($path)
    {
        $x=explode('/', $path);
        return $x[count($x)-1];
    }
}
