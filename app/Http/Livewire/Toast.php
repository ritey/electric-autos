<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toast extends Component
{
    public $message;
    public $type;
    public $positionCss;
    public $bgColorCss;
    public $textColorCss;
    public $duration;
    public $showIcon;
    public $hideOnClick;
    public $transition;
    public $transitioClasses;
    protected $listeners = ['show', 'showWarning', 'showError', 'showInfo', 'showSuccess'];

    protected $transitions = [
        'rotate' => ['rotate-180', 'rotate'],
        'zoom_in' => ['scale-50', 'scale-100'],
        'appear_from_right' => ['translate-x-1/2', 'translate-x-0'],
        'appear_from_left' => ['-translate-x-1/2', 'translate-x-0'],
        'appear_from_below' => ['translate-y-1/2', 'translate-y-0'],
        'appear_from_above' => ['-translate-y-1/2', 'translate-y-0'],
    ];

    public function mount()
    {
        if ($message = session('toast')) {
            $this->show($message);
        }
    }

    public function show($params)
    {
        $type = '';
        if (is_array($params)) {
            $this->message = $params['message'] ?? '';
            $type = $params['type'] ?? '';
        } else {
            $this->message = $params;
        }
        $this->_setType($type);
    }

    public function showWarning($message)
    {
        $this->message = $message;
        $this->_setType('warning');
    }

    public function showInfo($message)
    {
        $this->message = $message;
        $this->_setType('info');
    }

    public function showError($message)
    {
        $this->message = $message;
        $this->_setType('error');
    }

    public function showSuccess($message)
    {
        $this->message = $message;
        $this->_setType('success');
    }

    public function render()
    {
        $this->_setBackgroundColor();
        $this->_setTextColor();
        $this->_setPosition();
        $this->_setDuration();
        $this->_setIcon();
        $this->_setClickHandler();
        $this->_setTransition();

        if (!empty($this->message)) {
            $this->dispatchBrowserEvent('new-toast');
        }

        return view('livewire.toast');
    }

    private function _setType($type = '')
    {
        if (in_array($type, ['warning', 'info', 'error', 'success'])) {
            $this->type = $type;
        } else {
            $this->type = 'info';
        }
    }

    private function _setBackgroundColor()
    {
        $this->bgColorCss = 'monza';
    }

    private function _setTextColor()
    {
        $this->textColorCss = 'white';
    }

    private function _setPosition()
    {
        $this->positionCss = 'bottom-4 right-4';
    }

    private function _setDuration()
    {
        $this->duration = (int) 3000; // ms
    }

    private function _setIcon()
    {
        $this->showIcon = 1;
    }

    private function _setClickHandler()
    {
        $this->hideOnClick = 1;
    }

    private function _setTransition()
    {
        $this->transition = 1;
        if ($this->transition) {
            $this->transitioClasses['leave_end_class'] =
            $this->transitioClasses['enter_start_class'] =
            reset($this->transitions['appear_from_above']);

            $this->transitioClasses['leave_start_class'] =
            $this->transitioClasses['enter_end_class'] =
            end($this->transitions['appear_from_above']);
        }
    }
}
