<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by impress-org on 24-December-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace Give\Vendors\Symfony\Component\HttpFoundation\File\Exception;

/**
 * Thrown when the access on a file was denied.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class AccessDeniedException extends FileException
{
    /**
     * @param string $path The path to the accessed file
     */
    public function __construct($path)
    {
        parent::__construct(sprintf('The file %s could not be accessed', $path));
    }
}
