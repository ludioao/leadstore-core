<?php

namespace LeadStore\Framework\User\ViewComposers;

use Illuminate\View\View;
use LeadStore\Framework\Models\Contracts\UserGroupInterface;

class UserFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $userGroupRepository = app(UserGroupInterface::class);
        $userGroupOptions = $userGroupRepository->all()->pluck('name', 'id');
        $view->with('userGroupOptions', $userGroupOptions);
    }
}
