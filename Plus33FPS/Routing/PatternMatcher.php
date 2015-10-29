<?php
namespace Plus33FPS\Routing;

class PatternMatcher {
    public function matchAgainst($pattern, $string) {
        return !!preg_match($pattern, $string);
    }
}