<?php

namespace Core;
use Service\Logger\LoggerServiceInterface;
use Throwable;

class App
{
    private array $routes;
    private Container $container;
    private LoggerServiceInterface $loggerService;
    public function __construct(Container $container, LoggerServiceInterface $loggerService)
    {
        $this->container = $container;
        $this->loggerService = $loggerService;
    }

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$requestUri])) {
            $route = $this->routes[$requestUri];
            if (isset($route[$requestMethod])) {
                $controllerName = $route[$requestMethod]['class'];
                $methodName = $route[$requestMethod]['method'];

                $controller = $this->container->get($controllerName);

                if (isset($route[$requestMethod]['request'])) {
                    // создаем объект request, если он указан
                    $requestClass = $route[$requestMethod]['request'];
                    $request = new $requestClass($requestMethod, $requestUri, $_POST);
                    try {
                        // передаем объект request
                        $controller->$methodName($request);
                    } catch (Throwable $exception) {
                        $this->loggerService->error($exception);

                        http_response_code(500);
                        require_once '../View/500.php';
                    }
                } else {
                    $controller->$methodName();
                }
            } else {
                echo "$requestMethod не поддерживается для $requestUri";
            }
        } else {
            http_response_code(404);
            require_once '../View/404.php';
        }
    }

    public function createRoute(string $route, string $methodHttp, string $className, string $methodName, string $requestClass = null)
    {
        $this->routes[$route][$methodHttp] = [
            'class' => $className,
            'method' => $methodName
            ];
        if ($requestClass) {
            $this->routes[$route][$methodHttp]['request'] = $requestClass;
        }
    }
}