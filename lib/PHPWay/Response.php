<?php



namespace PHPWay;


class Response 
{
    private $_body;
    private $_headers = array();
    private $_status = 200;

    public static function show_404($message = '')
    {
        $response = static::page_404($message);
        $response->process();
    }

    public static function page_404($message = '')
    {
        $message = $message ? $message : 'Page not found';
        $response = new static($message);
        $response->set_status(404);
        return $response;
    }

    public static function error($params = array())
    {
        $response = new static(json_encode($params));
        $response
            ->set_status(400)
            ->header('Content-type', 'application/json');
        return $response;
    }

    public static function json($content)
    {
        $response = new static;
        $response
            ->header('Content-type', 'application/json')
            ->body(json_encode($content));
        return $response;
    }

    public function __construct($body = '')
    {
        $this->body($body);
    }

    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }

    public function header($key, $val)
    {
        $this->_headers[$key] = $val;
        return $this;
    }

    public function body($body)
    {
        $this->_body = $body;
        return $this;
    }

    public function process()
    {
        $this->send_status();
        $this->send_headers();
        $this->send_content();
        exit(0);
    }

    private function send_status()
    {
        switch ($this->_status) 
        {
            case 100: $text = 'Continue'; break;
            case 101: $text = 'Switching Protocols'; break;
            case 200: $text = 'OK'; break;
            case 201: $text = 'Created'; break;
            case 202: $text = 'Accepted'; break;
            case 203: $text = 'Non-Authoritative Information'; break;
            case 204: $text = 'No Content'; break;
            case 205: $text = 'Reset Content'; break;
            case 206: $text = 'Partial Content'; break;
            case 300: $text = 'Multiple Choices'; break;
            case 301: $text = 'Moved Permanently'; break;
            case 302: $text = 'Moved Temporarily'; break;
            case 303: $text = 'See Other'; break;
            case 304: $text = 'Not Modified'; break;
            case 305: $text = 'Use Proxy'; break;
            case 400: $text = 'Bad Request'; break;
            case 401: $text = 'Unauthorized'; break;
            case 402: $text = 'Payment Required'; break;
            case 403: $text = 'Forbidden'; break;
            case 404: $text = 'Not Found'; break;
            case 405: $text = 'Method Not Allowed'; break;
            case 406: $text = 'Not Acceptable'; break;
            case 407: $text = 'Proxy Authentication Required'; break;
            case 408: $text = 'Request Time-out'; break;
            case 409: $text = 'Conflict'; break;
            case 410: $text = 'Gone'; break;
            case 411: $text = 'Length Required'; break;
            case 412: $text = 'Precondition Failed'; break;
            case 413: $text = 'Request Entity Too Large'; break;
            case 414: $text = 'Request-URI Too Large'; break;
            case 415: $text = 'Unsupported Media Type'; break;
            case 500: $text = 'Internal Server Error'; break;
            case 501: $text = 'Not Implemented'; break;
            case 502: $text = 'Bad Gateway'; break;
            case 503: $text = 'Service Unavailable'; break;
            case 504: $text = 'Gateway Time-out'; break;
            case 505: $text = 'HTTP Version not supported'; break;
            default:
                exit('Unknown http status code "' . htmlentities($this->_status) . '"');
            break;
        }

        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        header($protocol . ' ' . $this->_status . ' ' . $text);
    }

    private function send_headers()
    {
        foreach ($this->_headers as $header => $val)
        {
            header("{$header}: {$val}");
        }
    }

    private function send_content()
    {
        echo $this->_body;
    }
}