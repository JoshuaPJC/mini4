<?php
/** For more info about namespaces plase @see http://php.net/manual/en/language.namespaces.importing.php */
namespace Mini\Core;

class Application
{

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     * @param $routes
     */
    public function __construct($routes)
    {

        if (!isset($_GET['url'])) {
            $_GET['url'] = '';
        }
        $url = trim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url_array = explode('/', $url);


        $key = $this->matchRoute($url_array, $routes);

        if (isset($key))
            echo $routes[$key];
        else
            echo "null";


    }


    private function matchRoute($url_array, $routes)
    {

        foreach ($routes as $key => $route) {
            $match = true;

            $route_array = explode('/', filter_var(trim($key, '/')));

            if (count($route_array) != count($url_array)) {
                $match = false;
            }

            for ($i = 0; $i < count($route_array); $i++) {
                if (!isset($route_array[$i]) || !isset($url_array[$i])) {
                    $match = false;
                    break;
                }
                $route_array_elem = $route_array[$i];
                //Check if route elem is param
                if (strlen($route_array_elem) > 0) {
                    if ($route_array_elem{0} == ':') {
                        if (empty($url_array[$i])) {
                            $match = false;
                            break;
                        }
                    } else {
                        if ($route_array_elem != $url_array[$i]) {
                            $match = false;
                            break;
                        }
                    }
                } else {
                    if (strlen($url_array[$i]) > 0) {
                        $match = false;
                        break;
                    }
                }
            }

            if ($match)
                return $key;
        }

        return null;
    }

}
