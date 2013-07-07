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

function email2($adress)
{
	if(filter_var($ip, FILTER_VALIDATE_EMAIL)) {
	  return 1;
	}
	else {
	  return 0;
	}
}

function ip($ip) {
	if(filter_var($ip, FILTER_VALIDATE_IP)) {
	  return 1;
	}
	else {
	  return 0;
	}
}

function mac($mac) {
	if(preg_match('/^[0-9a-fA-F]{2}(?=([:-]?))(?:\\1[0-9a-fA-F]{2}){5}$/', $mac)) {
  		return 1;
	} else {
  		return 0;
	}
}

function addSepare($mac, $separator = ':')
{
  return join($separator, str_split($mac, 2));
}

function remSepare($mac, $separator = array(':', '-'))
{
  return str_replace($separator, '', $mac);
}

?>