<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Room;

class DashboardComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $room = Room::all();
        $view->with('rooms', $room);
    }
}
