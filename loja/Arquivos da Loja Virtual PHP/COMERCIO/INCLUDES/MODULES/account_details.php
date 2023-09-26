<?php
/*
  $Id: account_details.php,v 1.12 2002/01/11 18:45:43 dgw_ Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
<?php
  if (ACCOUNT_GENDER) {
    $male = ($account['customers_gender'] == 'm') ? true : false;
    $female = ($account['customers_gender'] == 'f') ? true : false;
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_GENDER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo ($account['customers_gender'] == 'm') ? MALE : FEMALE;
  } elseif ($error) {
    if ($entry_gender_error) {
      echo tep_draw_radio_field('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female) . '&nbsp;&nbsp' . FEMALE . '&nbsp;' . ENTRY_GENDER_ERROR;
    } else {
      echo ($HTTP_POST_VARS['gender'] == 'm') ? MALE : FEMALE;
      echo tep_draw_hidden_field('gender');
    }
  } else {
    echo tep_draw_radio_field('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . ENTRY_GENDER_TEXT;
  }
?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_firstname'];
  } elseif ($error) {
    if ($entry_firstname_error) {
      echo tep_draw_input_field('firstname') . '&nbsp;' . ENTRY_FIRST_NAME_ERROR;
    } else {
      echo $HTTP_POST_VARS['firstname'] . tep_draw_hidden_field('firstname');
    }
  } else {
    echo tep_draw_input_field('firstname', $account['customers_firstname']) . '&nbsp;' . ENTRY_FIRST_NAME_TEXT;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_lastname'];
  } elseif ($error) {
    if ($entry_lastname_error) {
      echo tep_draw_input_field('lastname') . '&nbsp;' . ENTRY_LAST_NAME_ERROR;
    } else {
      echo $HTTP_POST_VARS['lastname'] . tep_draw_hidden_field('lastname');
    }
  } else {
    echo tep_draw_input_field('lastname', $account['customers_lastname']) . '&nbsp;' . ENTRY_LAST_NAME_TEXT;
  }
?></td>
          </tr>

<? // DW ---> ?>

    <tr>
            <td class="main">&nbsp;CPF/CNPJ:</td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['documento_cliente'];
  } elseif ($error) {
    if ($entry_documento_error) {
      echo tep_draw_input_field('documento') . '&nbsp;<small><font color="#FF0000">N�mero do documento inv�lido</font></small>';
    } else {
      echo $HTTP_POST_VARS['documento'] . tep_draw_hidden_field('documento');
    }
  } else {
    echo tep_draw_input_field('documento', $account['documento_cliente']) . '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>';
  }
?></td>
          </tr>

<? // DW <--- ?>

<?php
  if (ACCOUNT_DOB) {
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_DATE_OF_BIRTH; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo tep_date_short($account['customers_dob']);
  } elseif ($error) {
    if ($entry_date_of_birth_error) {
      echo tep_draw_input_field('dob') . '&nbsp;' . ENTRY_DATE_OF_BIRTH_ERROR;
    } else {
      echo $HTTP_POST_VARS['dob'] . tep_draw_hidden_field('dob');
    }
  } else {
    echo tep_draw_input_field('dob', tep_date_short($account['customers_dob'])) . '&nbsp;' . ENTRY_DATE_OF_BIRTH_TEXT;
  }
?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_email_address'];
  } elseif ($error) {
    if ($entry_email_address_error) {
      echo tep_draw_input_field('email_address') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR;
    } elseif ($entry_email_address_check_error) {
      echo tep_draw_input_field('email_address') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($entry_email_address_exists) {
      echo tep_draw_input_field('email_address') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $HTTP_POST_VARS['email_address'] . tep_draw_hidden_field('email_address');
    }
  } else {
    echo tep_draw_input_field('email_address', $account['customers_email_address']) . '&nbsp;' . ENTRY_EMAIL_ADDRESS_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
 if (ACCOUNT_COMPANY) {
?>  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_COMPANY; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_COMPANY; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['entry_company'];
  } elseif ($error) {
    if ($entry_company_error) {
      echo tep_draw_input_field('company') . '&nbsp;' . ENTRY_COMPANY_ERROR;
    } else {
      echo $HTTP_POST_VARS['company'] . tep_draw_hidden_field('company');
    }
  } else {
    echo tep_draw_input_field('company', $account['entry_company']) . '&nbsp;' . ENTRY_COMPANY_TEXT;
  }
?></td>
          </tr>
        </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
}
?>
  <tr>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_ADDRESS; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['entry_street_address'];
  } elseif ($error) {
    if ($entry_street_address_error) {
      echo tep_draw_input_field('street_address') . '&nbsp;' . ENTRY_STREET_ADDRESS_ERROR;
    } else {
      echo $HTTP_POST_VARS['street_address'] . tep_draw_hidden_field('street_address');
    }
  } else {
    echo tep_draw_input_field('street_address', $account['entry_street_address']) . '&nbsp;' . ENTRY_STREET_ADDRESS_TEXT;
  }
?></td>
          </tr>
<?
  if (ACCOUNT_SUBURB) {
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_SUBURB; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['entry_suburb'];
  } elseif ($error) {
    if ($entry_suburb_error) {
      echo tep_draw_input_field('suburb') . '&nbsp;' . ENTRY_SUBURB_ERROR;
    } else {
      echo $HTTP_POST_VARS['suburb'] . tep_draw_hidden_field('suburb');
    }
  } else {
    echo tep_draw_input_field('suburb', $account['entry_suburb']) . '&nbsp;' . ENTRY_SUBURB_TEXT;
  }
?></td>
          </tr>
<?
   }
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_POST_CODE; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['entry_postcode'];
  } elseif ($error) {
    if ($entry_post_code_error) {
      echo tep_draw_input_field('postcode') . '&nbsp;' . ENTRY_POST_CODE_ERROR;
    } else {
      echo $HTTP_POST_VARS['postcode'] . tep_draw_hidden_field('postcode');
    }
  } else {
    echo tep_draw_input_field('postcode', $account['entry_postcode']) . '&nbsp;' . ENTRY_POST_CODE_TEXT;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_CITY; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['entry_city'];
  } elseif ($error) {
    if ($entry_city_error) {
      echo tep_draw_input_field('city') . '&nbsp;' . ENTRY_CITY_ERROR;
    } else {
      echo $HTTP_POST_VARS['city'] . tep_draw_hidden_field('city');
    }
  } else {
    echo tep_draw_input_field('city', $account['entry_city']) . '&nbsp;' . ENTRY_CITY_TEXT;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_COUNTRY; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo tep_get_country_name($account['entry_country_id']);
  } elseif ($error) {
    if ($entry_country_error) {
      tep_get_country_list('country', $HTTP_POST_VARS['country'], (ACCOUNT_STATE) ? 'onChange="update_zone(this.form);"' : '');
      echo '&nbsp;' . ENTRY_COUNTRY_ERROR;
    } else {
      echo tep_get_country_name($HTTP_POST_VARS['country']) . tep_draw_hidden_field('country');
    }
  } else {
    tep_get_country_list('country', $account['entry_country_id'], (ACCOUNT_STATE) ? 'onChange="update_zone(this.form);"' : '');
    echo '&nbsp;' . ENTRY_COUNTRY_TEXT;
  }
?></td>
          </tr>
<?php
  if (ACCOUNT_STATE) {
    $customers_state = ($account['entry_state']) ? $account['entry_state'] : JS_STATE_SELECT;
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_STATE; ?></td>
            <td class="main">&nbsp;
<?php
    if ($is_read_only) {
      echo tep_get_zone_name($account['entry_country_id'], $account['entry_zone_id'], $account['entry_state']);
    } elseif ($processed) {
      echo tep_get_zone_name($HTTP_POST_VARS['country'], $HTTP_POST_VARS['zone_id'], $HTTP_POST_VARS['state']) . tep_draw_hidden_field('zone_id') . tep_draw_hidden_field('state');
    } else {
      echo tep_get_zone_list('zone_id', $account['entry_country_id'], $account['entry_zone_id'], 'onChange="resetStateText(this.form);"');
      echo '&nbsp;' . ENTRY_STATE_TEXT;
    }
?></td>
          </tr>
<?php
    if ( (!$is_read_only) && (!$error) && (!$processed) ) {
?>
          <tr>
            <td class="main">&nbsp;</td>
            <td class="main">&nbsp;
<?php
  echo tep_draw_input_field('state', $customers_state, 'onChange="resetZoneSelected(this.form);"') . '&nbsp;' . ENTRY_STATE_TEXT;
?></td>
          </tr>
<?php
    }
  }
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_CONTACT; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_telephone'];
  } elseif ($error) {
    if ($entry_telephone_error) {
      echo tep_draw_input_field('telephone') . '&nbsp;' . ENTRY_TELEPHONE_NUMBER_ERROR;
    } else {
      echo $HTTP_POST_VARS['telephone'] . tep_draw_hidden_field('telephone');
    }
  } else {
    echo tep_draw_input_field('telephone', $account['customers_telephone']) . '&nbsp;' . ENTRY_TELEPHONE_NUMBER_TEXT;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_FAX_NUMBER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_fax'];
  } elseif ($processed) {
    echo $HTTP_POST_VARS['fax'] . tep_draw_hidden_field('fax');
  } else {
    echo tep_draw_input_field('fax', $account['customers_fax']) . '&nbsp;' . ENTRY_FAX_NUMBER_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_OPTIONS; ?></td>
  </tr>
<?php
  $newsletter_array = array(array('id' => '1',
                                  'text' => ENTRY_NEWSLETTER_YES),
                            array('id' => '0',
                                  'text' => ENTRY_NEWSLETTER_NO));
?>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_NEWSLETTER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    if ($account['customers_newsletter'] == '1') {
      echo ENTRY_NEWSLETTER_YES;
    } else {
      echo ENTRY_NEWSLETTER_NO;
    }
  } elseif ($processed) {
    if ($HTTP_POST_VARS['newsletter'] == '1') {
      echo ENTRY_NEWSLETTER_YES;
    } else {
      echo ENTRY_NEWSLETTER_NO;
    }
    echo tep_draw_hidden_field('newsletter');  
  } else {
    echo tep_draw_pull_down_menu('newsletter', $newsletter_array, $account['customers_newsletter']) . '&nbsp;' . ENTRY_NEWSLETTER_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  if (!$is_read_only) {
?>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_PASSWORD; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_PASSWORD; ?></td>
            <td class="main">&nbsp;
<?php
    if ($error) {
      if ($entry_password_error) {
        echo tep_draw_password_field('password') . '&nbsp;' . ENTRY_PASSWORD_ERROR;
      } else {
        echo PASSWORD_HIDDEN . tep_draw_hidden_field('password') . tep_draw_hidden_field('confirmation');
      }
    } else {
      echo tep_draw_password_field('password') . '&nbsp;' . ENTRY_PASSWORD_TEXT;
    }
?></td>
         </tr>
<?php
    if ( (!$error) || ($entry_password_error) ) {
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
            <td class="main">&nbsp;
<?php
    echo tep_draw_password_field('confirmation') . '&nbsp;' . ENTRY_PASSWORD_CONFIRMATION_TEXT;
?></td>
          </tr>
<?php
    }
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  }
?>
</table>
