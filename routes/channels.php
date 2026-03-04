<?php

use Illuminate\Support\Facades\Broadcast;

<<<<<<< HEAD
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
=======
Broadcast::channel('colocation.{colocationId}', function ($user, $colocationId) {

    return $user->colocations()->where('colocations.id', $colocationId)->exists();

});

// Broadcast::channel('colocation.{id}', function ($user, $id) {
//     return true; 
// });

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
>>>>>>> feature/Message
