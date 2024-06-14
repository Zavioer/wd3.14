<?php

require_once __DIR__.'/../utils/Message.php';
require_once __DIR__.'/../validators/ValidatorExecutor.php';
require_once __DIR__.'/../validators/Validators.php';

class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template. '.php';
        $output = 'File not found!';
                
        if(file_exists($templatePath)){
            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function jsonify($input)
    {
        header('Content-Type: application/json');
        $encoded = json_encode($input);
        echo $encoded;
    }

    static public function redirect($actionName, $responseCode = 0, $exit = FALSE)
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$actionName}", TRUE, $response_code);

        if ($exit) {
            exit();
        }
    }
}