<?php

namespace Awcodes\FilamentGravatar;

class Gravatar
{
    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param  string|null  $email The email address
     * @param  int  $size Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param  string  $default Default imageset to use [ 404 | mp | identicon | monsterid | wavatar | robohash ]
     * @param  string  $rating Maximum rating (inclusive) [ g | pg | r | x ]
     * @param  bool  $asImage True to return a complete IMG tag False for just the URL
     * @param  array  $attributes Optional, additional key/value attributes to include in the IMG tag
     * @return string containing either just a URL or a complete image tag
     *
     * @source https://gravatar.com/site/implement/images/php/
     */
    public static function get(
        ?string $email = null,
        int $size = 80,
        string $default = 'mp',
        string $rating = 'g',
        bool $asImage = false,
        array $attributes = []
    ): string {

        $size = GravatarPlugin::get()->getSize() ?? $size;
        $default = GravatarPlugin::get()->getDefault() ?? $default;
        $rating = GravatarPlugin::get()->getRating() ?? $rating;

        $url = 'https://www.gravatar.com/avatar';
        if ($email) {
            $url .= '/' . md5(strtolower(trim($email)));
        }
        $url .= "?s=$size&d=$default&r=$rating";
        if ($asImage) {
            $url = '<img src="' . $url . '"';
            foreach ($attributes as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }

        return $url;
    }
}
