<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use Auth;
use Session;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Upload;
use CoderStudios\Requests\UploadRequest;
use Log;

class PicsController extends BaseController
{

	/**
     * Laravel Request Repository
     *
     * @var object
     */
    protected $request;

    /**
     * Laravel Cache Repository
     *
     * @var object
     */
    protected $cache;

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache, Upload $upload)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->upload = $upload;
		$this->middleware('auth');
	}

	public function index()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'user' => Auth::user(),
				'all_pics' => $this->upload->mine(Auth::user()->id)->get(),
			];
			$view = view('pages.pics-index', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function save(UploadRequest $request)
	{
		$files = $request->file('file');
        $json = [];
        foreach($files as $file) {
            $data = [];
            $data['filename'] = $file->getClientOriginalName();
            $data['maskname'] = md5($file->getClientOriginalName() . date('Y-m-d H:i:s'));
            $data['extension'] = $file->guessExtension();
            $data['size'] = $file->getClientSize();
            $data['user_id'] = Auth::user()->user_id;
            if ($file->isValid()) {
                $upload = $this->upload->create($data);
                $result = $file->move(storage_path('app/uploads/'.$data['user_id']), $data['maskname'] . '.' . $data['extension']);
                $json[] = ['result' => true];
            } else {
                $json[] = ['result' => false];
            }
        }
        $failed = 0;
        $success = 0;
        foreach($json as $item) {
            if (!$item['result']) {
                $failed++;
            }
        }
        $success = (count($json)-$failed);
        $message = $success . ' ' . str_plural('file',$success) . ' uploaded.';
        if ($failed > 0) {
            $message = $message . ' ' . $failed . ' ' . str_plural('file',$failed) . ' failed to upload.';
        }
        if ($success) {
            Session::put('success_message',$message);
            return response()->json(['result' => true, 'path' => route('pic.index') ]);
        }
        return response()->json(['result' => false, 'path' => route('pic.index') . '?result=false']);
	}
}