<?php

declare(strict_types=1);

use Awcodes\Gravatar\Gravatar;

it('can generate a gravatar URL', function () {
    $url = Gravatar::get('test@example.com');

    expect($url)->toBe('https://www.gravatar.com/avatar/55502f40dc8b7c769880b10874abc9d0?s=80&d=mp&r=g');
});
