<?php
/*
  $Id: validations.php,v 1.6 2001/11/17 04:44:49 hpdl Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_validate_email
  //
  // Arguments   : email   email address to be checked
  //
  // Return      : true  - valid email address
  //               false - invalid email address
  //
  // Description : function for validating email address that conforms to RFC 822 specs
  //
  //               This function is converted from a JavaScript written by 
  //               Sandeep V. Tamhankar (stamhankar@hotmail.com). The original JavaScript
  //               is available at http://javascript.internet.com
  //
  // Sample Valid Addresses:
  //
  //    first.last@host.com
  //    firstlast@host.to
  //    "first last"@host.com
  //    "first@last"@host.com
  //    first-last@host.com
  //    first.last@[123.123.123.123]
  //
  // Invalid Addresses:
  //
  //    first last@host.com
  //    
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_validate_email($email) {
    $valid_address = true;
    
    $mail_pat = '^(.+)@(.+)$';
    $valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
    $atom = "$valid_chars+";
    $quoted_user='(\"[^\"]*\")';
    $word = "($atom|$quoted_user)";
    $user_pat = "^$word(\.$word)*$";
    $ip_domain_pat='^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
    $domain_pat = "^$atom(\.$atom)*$";
    
    if (eregi($mail_pat, $email, $components)) {
    
      $user = $components[1];
      $domain = $components[2];

      // validate user  
      if (eregi($user_pat, $user)) {
        // validate domain
        if (eregi($ip_domain_pat, $domain, $ip_components)) {
          // this is an IP address
      	  for ($i=1;$i<=4;$i++) {
      	    if ($ip_components[$i] > 255) {
      	      $valid_address = false;
      	      break;
      	    }
          }
        }
        else {
          // Domain is symbolic name
          if (eregi($domain_pat, $domain)) {
  
            /* domain name seems valid, but now make sure that it ends in a
               three-letter word (like com, net, org, gov, edu, int) or a two-letter word,
               representing country (ca, uk, nl), and that there's a hostname preceding 
               the domain or country. */
  
            $domain_components = explode(".", $domain);          
  
            // Make sure there's a host name preceding the domain.
            if (sizeof($domain_components) < 2)
              $valid_address = false;
            else {
              $top_level_domain = strtolower($domain_components[sizeof($domain_components)-1]);
              if (strlen($top_level_domain) < 2 || strlen($top_level_domain) > 3)
                $valid_address = false;
              elseif (strlen($top_level_domain) == 3) {
                switch ($top_level_domain) {
                  case 'com':
                  case 'net':
                  case 'org':
                  case 'gov':
                  case 'edu':
                  case 'int':
                    break;
                  default:
                    $valid_address = false;
                    break;
                }
              }
            }
          }
          else {
      	    $valid_address = false;
      	  }
      	}
      }
      else {
        $valid_address = false;
      }
    }
    else
      $valid_address = false;

    if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
      if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
        $valid_address = false;
      }
    }
    
    return $valid_address;
  }

function dw_valida_CPF($CampoNumero) {

$RecebeCPF=$CampoNumero;
$s="";
for ($x=1; $x<=strlen($RecebeCPF); $x=$x+1) {
	$ch=substr($RecebeCPF,$x-1,1);
	if (ord($ch)>=48 && ord($ch)<=57) {
		$s=$s.$ch;
	}
}



$RecebeCPF=$s;

if (strlen($RecebeCPF)!=11) {
	return 0;
} else if ($RecebeCPF=="00000000000") {
	return 0;
} else {
	$Numero[1]=intval(substr($RecebeCPF,1-1,1));
	$Numero[2]=intval(substr($RecebeCPF,2-1,1));
	$Numero[3]=intval(substr($RecebeCPF,3-1,1));
	$Numero[4]=intval(substr($RecebeCPF,4-1,1));
	$Numero[5]=intval(substr($RecebeCPF,5-1,1));
	$Numero[6]=intval(substr($RecebeCPF,6-1,1));
	$Numero[7]=intval(substr($RecebeCPF,7-1,1));
	$Numero[8]=intval(substr($RecebeCPF,8-1,1));
	$Numero[9]=intval(substr($RecebeCPF,9-1,1));
	$Numero[10]=intval(substr($RecebeCPF,10-1,1));
	$Numero[11]=intval(substr($RecebeCPF,11-1,1));
	$soma=10*$Numero[1]+9*$Numero[2]+8*$Numero[3]+7*$Numero[4]+6*$Numero[5]+5*
	$Numero[6]+4*$Numero[7]+3*$Numero[8]+2*$Numero[9];
	$soma=$soma-(11*(intval($soma/11)));
	if ($soma==0 || $soma==1) {
		$resultado1=0;
	} else {
		$resultado1=11-$soma;
	}
	if ($resultado1==$Numero[10]) {
		$soma=$Numero[1]*11+$Numero[2]*10+$Numero[3]*9+$Numero[4]*8+$Numero[5]*7+$Numero[6]*6+$Numero[7]*5+
		$Numero[8]*4+$Numero[9]*3+$Numero[10]*2;
		$soma=$soma-(11*(intval($soma/11)));
		if ($soma==0 || $soma==1) {
			$resultado2=0;
		} else {
			$resultado2=11-$soma;
		}

		if ($resultado2==$Numero[11]) {
			return 1;
		} else {
			return 0;
		}
	
	} else {
		return 0;
	}
}
}

function dw_valida_CNPJ($CampoNumero) {

$RecebeCNPJ=${"CampoNumero"};
$s="";

for ($x=1; $x<=strlen($RecebeCNPJ); $x=$x+1) {
	$ch=substr($RecebeCNPJ,$x-1,1);
	if (ord($ch)>=48 && ord($ch)<=57) {
		$s=$s.$ch;
	}
}
$RecebeCNPJ=$s;

if (strlen($RecebeCNPJ) > 14) {
	while (strlen($RecebeCNPJ) != 14) {
		if (!intval(substr($RecebeCNPJ, 0,1))) {
			$RecebeCNPJ = substr($RecebeCNPJ, 1); 
		} else {
			return 0;
		}
	}
}

if (strlen($RecebeCNPJ)!=14) {
	return 0;
} else if ($RecebeCNPJ=="00000000000000") {
	return 0;
} else {
	$Numero[1]=intval(substr($RecebeCNPJ,1-1,1));
	$Numero[2]=intval(substr($RecebeCNPJ,2-1,1));
	$Numero[3]=intval(substr($RecebeCNPJ,3-1,1));
	$Numero[4]=intval(substr($RecebeCNPJ,4-1,1));
	$Numero[5]=intval(substr($RecebeCNPJ,5-1,1));
	$Numero[6]=intval(substr($RecebeCNPJ,6-1,1));
	$Numero[7]=intval(substr($RecebeCNPJ,7-1,1));
	$Numero[8]=intval(substr($RecebeCNPJ,8-1,1));
	$Numero[9]=intval(substr($RecebeCNPJ,9-1,1));
	$Numero[10]=intval(substr($RecebeCNPJ,10-1,1));
	$Numero[11]=intval(substr($RecebeCNPJ,11-1,1));
	$Numero[12]=intval(substr($RecebeCNPJ,12-1,1));
	$Numero[13]=intval(substr($RecebeCNPJ,13-1,1));
	$Numero[14]=intval(substr($RecebeCNPJ,14-1,1));
	$soma=$Numero[1]*5+$Numero[2]*4+$Numero[3]*3+$Numero[4]*2+$Numero[5]*9+$Numero[6]*8+$Numero[7]*7+
	$Numero[8]*6+$Numero[9]*5+$Numero[10]*4+$Numero[11]*3+$Numero[12]*2;
	$soma=$soma-(11*(intval($soma/11)));
	if ($soma==0 || $soma==1) {
		$resultado1=0;
	} else {
		$resultado1=11-$soma;
	}

	if ($resultado1==$Numero[13]) {
		$soma=$Numero[1]*6+$Numero[2]*5+$Numero[3]*4+$Numero[4]*3+$Numero[5]*2+$Numero[6]*9+
		$Numero[7]*8+$Numero[8]*7+$Numero[9]*6+$Numero[10]*5+$Numero[11]*4+$Numero[12]*3+$Numero[13]*2;
		$soma=$soma-(11*(intval($soma/11)));
		
		if ($soma==0 || $soma==1) {
			$resultado2=0;
		} else {
			$resultado2=11-$soma;
		}

		if ($resultado2==$Numero[14]) {
			return 1;
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}
}


?>