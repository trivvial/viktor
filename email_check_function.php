<?php

#
# pouziti:
#
# if (email($adresa))
#    {
#     echo "je";
#    }else{
#          echo "neni";
#          }
#
#


function email($adress)
{
        if (ereg("^.+@.+\\..+$", $adress))
                {
                return 1;
                }else{
                        return 0;
                        }
}


?>