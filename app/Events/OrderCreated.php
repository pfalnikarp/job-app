<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $created_by ;

    
    public function __construct($created_by)
    {
       $this->created_by = $created_by;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    //   Commented below on 27-07-21 as to broadcast to groups
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }


    public function broadcastAs()
    {
        return 'OrderCreated';
    }


     public function broadcastOn()
    {
        $channels = [];
    
        // foreach ($this->group->users as $user) {
        //     array_push($channels, new PrivateChannel('users.' . $user->id));
        // }


            array_push($channels, new PrivateChannel('users.' .  $this->created_by));
       
    
        return $channels;

        //   return new PrivateChannel('events');
    }


}
