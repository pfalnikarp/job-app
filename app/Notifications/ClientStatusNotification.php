<?php
   
namespace App\Notifications;
   
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\Channel;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

   
class ClientStatusNotification extends Notification  implements ShouldBroadcast
{
    use Queueable;
  
   // private $details;

    public  $details = [];

    public $group;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( array $details)
    {
        $this->details = $details;
    }
   
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database' ,'broadcast'];
    }
   
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->greeting($this->details['greeting'])
    //                 ->line($this->details['body'])
    //                 ->action($this->details['actionText'], $this->details['actionURL'])
    //                 ->line($this->details['thanks']);
    // }
  
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
           // 'order_id' => $this->details['order_id']
            // 'order_id' =>  $notifiable,
             'id'     =>  $this->id,
            'detail'  => $this->details['detail'],
            'url'     => $this->details['url'],
              'title'     => $this->details['title'],
                 'footer'     => $this->details['footer'],
        ];
    }

  // public function broadcastOn()
  //   {
  //       return new Channel('private');
  //   }


    //  public function broadcastOn()
    // {
    //     return new Channel('groups.' . 1);
    // }



   public function toBroadcast($notifiable): BroadcastMessage
{
    return new BroadcastMessage([
     // 'order_id'  =>  "$this->details (User $notifiable->id)"
      //'order_id'  =>  "$this->details "
        'id'     =>  $this->id,
         'detail'  => $this->details['detail'],
            'url'     => $this->details['url'],
              'title'     => $this->details['title'],
                 'footer'     => $this->details['footer'],

    ]);
}


}