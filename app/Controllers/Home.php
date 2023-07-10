<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $path = APPPATH . 'Views/speeds.txt';
        if (file_exists($path)) {
            $content = file_get_contents($path);
            return $content;
        } else {
            return 'Log file not found.';
        }
    }
    public function sleep($sec)
    {
        sleep($sec);
        return "sleep : " . (string) $sec;
    }
    public function Log_insert($content)
    {
        $path = APPPATH . 'Views/speeds.txt';
        $logEntry = date('Y-m-d H:i:s') . ' |' . $content . '<br><br>';
        try {
            $currentContent = file_get_contents($path);
            $newContent = $logEntry . $currentContent;
            file_put_contents($path, $newContent);
        } catch (\Exception $e) {
            file_put_contents($path, $logEntry, FILE_APPEND);
        }
        return true;
    }
}
