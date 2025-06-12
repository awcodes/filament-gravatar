<?php

declare(strict_types=1);

namespace Awcodes\Gravatar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GravatarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('gravatar');
    }
}
