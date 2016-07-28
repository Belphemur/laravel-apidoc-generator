<?php

namespace Mpociot\ApiDoc\Generators;

use Dingo\Api\Routing\Router;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DingoGenerator extends AbstractGenerator
{
    /**
     * @param \Illuminate\Routing\Route $route
     * @param array $bindings
     * @param bool $withResponse
     *
     * @return array
     */
    public function processRoute($route, $bindings = [], $withResponse = true)
    {
        try {
            DB::beginTransaction();

            $response = '';

            if ($withResponse) {
                try {
                    $response = $this->getRouteResponse($route, $bindings);
                } catch (Exception $e) {
                }
            }

            $routeAction      = $route->getAction();
            $routeGroup       = $this->getRouteGroup($routeAction['uses']);
            $routeDescription = $this->getRouteDescription($routeAction['uses']);

            return $this->getParameters([
                'resource'    => $routeGroup,
                'title'       => $routeDescription['short'],
                'description' => $routeDescription['long'],
                'methods'     => $route->getMethods(),
                'uri'         => $route->uri(),
                'parameters'  => [],
                'response'    => $response,
            ], $routeAction, $bindings);
        } finally {
            DB::rollBack();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function callRoute($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        return call_user_func_array([app('Dingo\Api\Dispatcher'), strtolower($method)], [$uri]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getUri($route)
    {
        return $route->uri();
    }

    /**
     * get the root resolver for the given route string
     *
     * @param $route
     * @param $bindings
     *
     * @return \Closure
     */
    protected function getRouteResolver($route, $bindings)
    {
        /**
         * @var $request Request
         */
        $request = app('request')->create(action($route, $bindings));
        app(Router::class)->dispatchToRoute($request);
        return $request->getRouteResolver();
    }}
