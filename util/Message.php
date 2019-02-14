<?php

namespace util;


class Message
{

    public static function makeErrorNotify($err)
    {
        echo "<script>window.onload = function() {

$.notify({
title: \"Erro\",
message: \"$err\"

}, {
type: 'danger',
timer: 5000,
placement: {
from: 'top',
align: 'center'
}
});
};</script>";
    }

    public static function makeSuccessNotify($err)
    {
        echo "<script>window.onload = function() {

$.notify({
title: \"Sucesso\",
message: \"$err\"

}, {
type: 'success',
timer: 5000,
placement: {
from: 'top',
align: 'center'
}
});
};</script>";
    }

    public static function makeSuccessSwal($msg, $callback = null)
    {
        if (!empty($callback)) {
            echo "
                    <script>
                        $(window).ready(function(){
                            swal(
                                'Sucesso!',
                                '$msg',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    $callback
                                }
                            });
                            Pace.stop();
                        });
                    </script>";
        } else {
            echo "
                    <script>
                            $(window).ready(function(){                
                            swal(
                                'Sucesso!',
                                '$msg',
                                'success'
                            );
                            Pace.stop();
                        });
                    </script>";
        }
    }

    public static function makeErrorSwal($msg)
    {
        echo "
                <script>
                    $(window).ready(function(){ 
                        swal(
                            'Erro!',
                            '$msg',
                            'error'
                        );
                        Pace.stop();
                    });
                </script>";
    }

}