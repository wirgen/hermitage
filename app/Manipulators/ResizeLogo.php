<?php

namespace App\Manipulators;

use Intervention\Image\Constraint;
use Intervention\Image\Image;
use livetyping\hermitage\foundation\images\processor\manipulators\Manipulator;

final class ResizeLogo extends Manipulator
{
    /** @var int|null */
    protected $width;

    /** @var int|null */
    protected $height;

    /** @var bool */
    protected $aspectRatio;

    /** @var bool */
    protected $interlace;

    /** @var string|null */
    protected $logo;

    /** @var string */
    protected $position;

    /** @var int */
    protected $offsetX;

    /** @var int */
    protected $offsetY;

    /**
     * @param \Intervention\Image\Image $image
     */
    public function run(Image $image)
    {
        $callback = function (Constraint $constraint) {
            if ($this->aspectRatio) {
                $constraint->aspectRatio();
            }
            $constraint->upsize();
        };

        $image->resize($this->width, $this->height, $callback)->interlace($this->interlace);

        if ($this->logo) {
            $image->insert($this->logo, $this->position, $this->offsetX, $this->offsetY);
        }
    }

    /**
     * @param array $config
     */
    protected function configure(array $config)
    {
        $this->width = $config['width'] ?? null;
        $this->height = $config['height'] ?? null;
        $this->aspectRatio = $config['aspectRatio'] ?? true;
        $this->interlace = $config['interlace'] ?? true;
        $this->logo = $config['logo'] ?? null;
        $this->position = $config['position'] ?? 'center';
        $this->offsetX = $config['offsetX'] ?? 0;
        $this->offsetY = $config['offsetY'] ?? 0;
    }
}
