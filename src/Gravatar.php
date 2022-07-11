<?php

namespace FilamentGravatar;

class Gravatar
{
    /**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar | robohash ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param bool $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return string containing either just a URL or a complete image tag
	 * @source https://gravatar.com/site/implement/images/php/
	 */

    public static function get(
        string $email = null,
        int $s = 80,
        string $d = 'mp',
        string $r = 'g',
        bool $img = false,
        $atts = []
    ): string {
        $s = config('filament-gravatar.size', $s);
        $d = config('filament-gravatar.default', $d);
        $r = config('filament-gravatar.rating', $r);

		$url = 'https://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}
}