<?php

namespace App;

use App\Controllers\NotFound\NotFoundController;
use DI\NotFoundException;

class Router
{
    private const SPECIAL_MAP = [
        [
            'symbol' => '-',
            'name' => 'Dash',
        ],
        [
            'symbol' => '.',
            'name' => 'Period',
        ],
        [
            'symbol' => '~',
            'name' => 'Tilda',
        ],
        [
            'symbol' => '_',
            'name' => 'Underscore',
        ],
    ];

    public function dispatch(): void
    {
        [$route, $controller, $action] = $this->prepRouteControllerAction(...$this->getRouterControllerAction());
        $controllerName = "{$controller}Controller";
        $controllerClass = "App\\Controllers\\$route\\$controllerName";

        try {
            if (!class_exists($controllerClass)) {
                throw new NotFoundException();
            }

            $controller = new $controllerClass();
            $controller->$action();
        } catch (NotFoundException) {
            $controller = new NotFoundController();
            $controller->index();
        }
    }

    public function getRouterControllerAction(): array
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];
        $route = explode('/', $path);

        array_shift($route);
        $last = end($route);

        if ($last === '') {
            array_pop($route);
        }

        // sanitize route
        $route = array_map(function ($item) {
            return preg_replace('/[^a-z0-9-~._]/i', '', $item);
        }, $route);

        return [
            $route[0] ?? 'index',
            $route[1] ?? 'index',
            $route[2] ?? 'index',
        ];
    }

    public function prepRouteControllerAction($route, $controller, $action): array
    {
        $route = $this->cleanSpecialCharacters($route);
        $controller = $this->cleanSpecialCharacters($controller);
        $action = lcfirst($this->cleanSpecialCharacters($action));

        return [$route, $controller, $action];
    }

    public function cleanSpecialCharacters(string $string): string
    {
        foreach (self::SPECIAL_MAP as $item) {
            $string = str_replace($item['symbol'], $item['name'], ucwords($string, $item['symbol']));
        }

        return $string;
    }
}
