<?php

route('contact','get' , 'contactController::index');
route('contact.store','post' , 'contactController::create');
route('contact.edit','post' , 'contactController::edit');
route('contact.delete','post' , 'contactController::delete');


route('/', 'get', function () {
    echo ('Halo, test 1 2 3');
});
route('account', 'get', function () {
    echo ('ACCOUNT');
});
