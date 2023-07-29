<?php

namespace CoderStudios\Controllers\Admin;

use App\Http\Controllers\Controller;
use CoderStudios\LaravelBootstrap\Traits\Filled;
use CoderStudios\Libraries\SettingsLibrary;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Filled;

    /*
    |--------------------------------------------------------------------------
    | Setting Controller
    |--------------------------------------------------------------------------
    |
    |
    */

    public function __construct(Request $request, SettingsLibrary $settings)
    {
        $this->settings = $settings;
        $this->request = $request;
    }

    public function index()
    {
        $order = 'name';
        $asc = 'ASC';
        if ($this->request->get('order')) {
            switch ($this->request->get('order')) {
                case 'created':
                    $order = 'created_at';
                    $asc = 'DESC';

                    break;

                case 'tweet':
                    $order = 'tweeted_at';
                    $asc = 'DESC';

                    break;

                case 'next':
                    $order = 'next_at';
                    $asc = 'ASC';

                    break;

                case 'updated':
                    $order = 'updated_at';
                    $asc = 'DESC';

                    break;
            }
        }
        $vars = [
            'settings' => $this->settings->orderBy($order, $asc)->paginate(),
            'order' => $this->request->get('order'),
        ];

        return view('admin.settings.index', compact('vars'));
    }

    public function new()
    {
        $vars = [
            'setting' => $this->settings->newInstance(),
        ];

        return view('admin.settings.new', compact('vars'));
    }

    public function edit($id = '')
    {
        $setting = $this->settings->where('id', $id)->first() ?? null;
        if (!$setting) {
            return redirect()->route('admin.settings.index')->withStatus('The setting could not be found, please try a different setting.');
        }

        $vars = [
            'setting' => $setting,
        ];

        return view('admin.settings.edit', compact('vars'));
    }

    public function update($id = '', Request $request)
    {
        $setting = $this->settings->where('id', $id)->first() ?? null;
        if (!$setting) {
            return redirect()->route('admin.settings.index')->withStatus('The setting at: '.route('admin.settings.setting.edit', ['id' => $id]).' is incorrect, please try a different setting.');
        }

        $data = $this->getFilledData($this->settings->getFillable(), $request, $this->settings->getCasts());
        $setting->update($data);
        cache()->flush();

        return redirect()->route('admin.settings.index')->withStatus('Setting updated');
    }

    public function store(Request $request)
    {
        $data = $this->getFilledData($this->settings->getFillable(), $request, $this->settings->getCasts());
        $this->settings->create($data);
        cache()->flush();

        return redirect()->route('admin.settings.index')->withStatus('Setting created');
    }

    public function delete($id = '')
    {
        $setting = $this->settings->where('id', $id)->first() ?? null;
        if (!$setting) {
            return redirect()->route('admin.settings.index')->withStatus('The setting at: '.route('admin.settings.setting.edit', ['id' => $id]).' is incorrect, please try again.');
        }
        $setting->delete();
        cache()->flush();

        return redirect()->back()->withStatus('Deleted');
    }
}
