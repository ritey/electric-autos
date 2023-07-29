<?php

namespace CoderStudios\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Show the log file page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (filesize(storage_path().'/logs/laravel.log') > 20000000) {
            $log_lines = $this->readLastLines(storage_path().'/logs/laravel.log', 200);
            $log = '';
            foreach ($log_lines as $line) {
                $log .= $line."\n";
            }
            $this->clearLogFile();
        } else {
            $log = file_get_contents(storage_path().'/logs/laravel.log');
        }
        $vars = [
            'action' => route('admin.log.clear'),
            'size' => filesize(storage_path().'/logs/laravel.log'),
            'log' => $log,
        ];

        return view('admin.log', compact('vars'))->render();
    }

    /**
     * Clear the log file and redirect back to the log page.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id = '')
    {
        $this->clearLogFile();

        return redirect()->route('admin.log')->withSuccess('Log file cleared');
    }

    private function readLastLines($filename, $num, $reverse = false)
    {
        $file = new \SplFileObject($filename, 'r');
        $file->seek(PHP_INT_MAX);
        $last_line = $file->key();
        $lines = new \LimitIterator($file, $last_line - $num, $last_line);
        $arr = iterator_to_array($lines);
        if ($reverse) {
            $arr = array_reverse($arr);
        }

        return $arr;

        return implode('', $arr);
    }

    private function clearLogFile()
    {
        $filename = storage_path().'/logs/laravel.log';
        $handle = fopen($filename, 'r+');
        ftruncate($handle, 0);
        fclose($handle);
    }
}
