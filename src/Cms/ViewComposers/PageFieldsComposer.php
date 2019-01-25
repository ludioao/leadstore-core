<?php

namespace LeadStore\Framework\Cms\ViewComposers;

use Illuminate\View\View;
use LeadStore\Framework\Widget\Facade as Widget;

class PageFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $widgetOptions = Widget::allOptions();

        $view->with('widgetOptions', $widgetOptions);
    }
}
