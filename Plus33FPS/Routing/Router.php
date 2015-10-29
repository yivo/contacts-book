<?php

namespace Plus33FPS\Routing;

class Router {

    /**
     * @param Request $request
     * @param Route[] $routes
     * @return $this
     */
    public function route($request, $routes) {
        # TODO Fix namespace

        $patternMatcher = new PatternMatcher();
        foreach ($routes as $route) {
            if ($patternMatcher->matchAgainst($route->getPattern(), $request->getURI())) {
                return $route;
            }
        }
        # TODO Implement not found case
    }
}