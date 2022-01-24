<?php

namespace Acm\Chatticket;

use App\Models\Tiket;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\ResourceTool;

class Chatticket extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Chatticket';
    }

    public function ticketReply($replies,$tickets)
    {
//        $data = Tiket::with('replies')->find($data);
        return $this->withMeta(['replies' => $replies ,
            'ticket'=> $tickets
        ]);
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'chatticket';
    }
}
