<?php

declare(strict_types=1);

namespace Migrify\VendorPatches\FileSystem;

use Migrify\VendorPatches\Exception\ShouldNotHappenException;
use Nette\Utils\Strings;
use Symplify\SmartFileSystem\SmartFileInfo;

final class PathResolver
{
    /**
     * @var string
     */
    private const VENDOR_PACKAGE_DIRECTORY_PATTERN = '#^(?<vendor_package_directory>.*?vendor\/(\w|\.|\-)+\/(\w|\.|\-)+)\/#si';

    public function resolveVendorDirectory(SmartFileInfo $fileInfo): string
    {
        $match = Strings::match($fileInfo->getRealPath(), self::VENDOR_PACKAGE_DIRECTORY_PATTERN);
        if (! isset($match['vendor_package_directory'])) {
            throw new ShouldNotHappenException('Could not resolve vendor package directory');
        }

        return $match['vendor_package_directory'];
    }
}
