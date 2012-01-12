<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header:  \modules\Invoice\language\hu_hu.lang.php - 19:17 2011.11.12. $
 * Description:  Defines the Hungarian language pack for the Invoice module vtiger 5.3.x
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): Istvan Holbok,  e-mail: holbok@gmail.com , mobil: +3670-3420900 , Skype: holboki
 ********************************************************************************/
 
$mod_strings = Array(
'LBL_MODULE_NAME'=>'Díjbekérő',
'LBL_SO_MODULE_NAME'=>'Díjbekérő',
'LBL_RELATED_PRODUCTS'=>'Termék adatok',
'LBL_MODULE_TITLE'=>'Díjbekérő: Kezdőlap',
'LBL_SEARCH_FORM_TITLE'=>'Díjbekérő Keresés',
'LBL_LIST_FORM_TITLE'=>'Díjbekérő Lista',
'LBL_LIST_SO_FORM_TITLE'=>'Megrendelések Listája',
'LBL_NEW_FORM_TITLE'=>'Új Díjbekérő',
'LBL_NEW_FORM_SO_TITLE'=>'Új Megrendelés',
'LBL_MEMBER_ORG_FORM_TITLE'=>'Szervezeti tagság',

'LBL_LIST_ACCOUNT_NAME'=>'Cég neve',
'LBL_LIST_CITY'=>'Város',
'LBL_LIST_WEBSITE'=>'Weboldal',
'LBL_LIST_STATE'=>'Állam/megye',
'LBL_LIST_PHONE'=>'Telefon',
'LBL_LIST_EMAIL_ADDRESS'=>'Email cím',
'LBL_LIST_CONTACT_NAME'=>'Kapcsolat neve',

//DON'T CONVERT THESE THEY ARE MAPPINGS
'db_name' => 'LBL_LIST_ACCOUNT_NAME',
'db_website' => 'LBL_LIST_WEBSITE',
'db_billing_address_city' => 'LBL_LIST_CITY',

//END DON'T CONVERT

'LBL_ACCOUNT'=>'Cég:',
'LBL_ACCOUNT_NAME'=>'Cég neve:',
'LBL_PHONE'=>'Telefon:',
'LBL_WEBSITE'=>'Weboldal:',
'LBL_FAX'=>'Fax:',
'LBL_TICKER_SYMBOL'=>'Tőzsdei rövidítés:',
'LBL_OTHER_PHONE'=>'Telefon, másik:',
'LBL_ANY_PHONE'=>'Telefon, bármilyen:',
'LBL_MEMBER_OF'=>'Tagja:',
'LBL_EMAIL'=>'Email:',
'LBL_EMPLOYEES'=>'Alkalmazottak:',
'LBL_OTHER_EMAIL_ADDRESS'=>'Email cím, másik:',
'LBL_ANY_EMAIL'=>'Email cím, bármilyen:',
'LBL_OWNERSHIP'=>'Tulajdonos:',
'LBL_RATING'=>'Értékelés:',
'LBL_INDUSTRY'=>'Iparág:',
'LBL_SIC_CODE'=>'TEÁOR:',
'LBL_TYPE'=>'Típus:',
'LBL_ANNUAL_REVENUE'=>'Éves forgalom:',
'LBL_ADDRESS_INFORMATION'=>'Cím adatok',
'LBL_Quote_INFORMATION'=>'Cég Információ',
'LBL_CUSTOM_INFORMATION'=>'Egyedi Információ',
'LBL_BILLING_ADDRESS'=>'Számlázási cím:',
'LBL_SHIPPING_ADDRESS'=>'Szállítási cím:',
'LBL_ANY_ADDRESS'=>'Bármilyen cím:',
'LBL_CITY'=>'Város:',
'LBL_STATE'=>'Állam/Megye:',
'LBL_POSTAL_CODE'=>'Irányítószám:',
'LBL_COUNTRY'=>'Ország:',
'LBL_DESCRIPTION_INFORMATION'=>'Leírás',
'LBL_DESCRIPTION'=>'Leírás:',
'LBL_TERMS_INFORMATION'=>'Határidők és Feltételek',
'NTC_COPY_BILLING_ADDRESS'=>'Számlázási cím másolása a Szállítási címhez',
'NTC_COPY_SHIPPING_ADDRESS'=>'Szállítási cím másolása a Számlázási címhez',
'NTC_REMOVE_MEMBER_ORG_CONFIRMATION'=>'Biztos vagy abban, hogy ezt a rekordot - mint tagszervezet - el akarod távolítani?',
'LBL_DUPLICATE'=>'Valószínű Cég Duplikáció',
'MSG_DUPLICATE' => 'Ennek a Cégnek a létrehozása valószínűleg duplikálni fog egy már létező Céget a rendszerben. Kiválaszthatsz egy már létező Céget a listáról innen alább, vagy kattinthatsz az Új Cég gombra, hogy folytasd a cég létrehozását a már bevitt adatokkal.',

'LBL_INVITEE'=>'Kapcsolatok',
'ERR_DELETE_RECORD'=>"Adj meg egy rekord azonosítót a VTiger-fiók törléséhez",

'LBL_SELECT_ACCOUNT'=>'Cég kiválasztása',
'LBL_GENERAL_INFORMATION'=>'Általános Információ',

//for v4 release added
'LBL_NEW_POTENTIAL'=>'Új Lehetőség',
'LBL_POTENTIAL_TITLE'=>'Lehetőségek',

'LBL_NEW_TASK'=>'Új Feladatok',
'LBL_TASK_TITLE'=>'Feladatok',
'LBL_NEW_CALL'=>'Új Hívás',
'LBL_CALL_TITLE'=>'Hívások',
'LBL_NEW_MEETING'=>'Új Megbeszélés',
'LBL_MEETING_TITLE'=>'Megbeszélések',
'LBL_NEW_EMAIL'=>'Új Email',
'LBL_EMAIL_TITLE'=>'Emailek',
'LBL_NEW_CONTACT'=>'Új Kapcsolat',
'LBL_CONTACT_TITLE'=>'Kapcsolatok',

//Added vtiger_fields after RC1 - Release
'LBL_ALL'=>'Minden',
'LBL_PROSPECT'=>'Vevő jelölt',
'LBL_INVESTOR'=>'Befektető',
'LBL_RESELLER'=>'Viszonteladó',
'LBL_PARTNER'=>'Partner',

// Added for 4GA
'LBL_TOOL_FORM_TITLE'=>'Cég Eszközök',
//Added for 4GA
'Subject'=>'Tárgy',
'Quote Name'=>'Ajánlat neve',
'Vendor Name'=>'Beszállító neve',
'Invoice Terms'=>'Fizetési határidő',
'Contact Name'=>'Kapcsolat neve',//to include contact name vtiger_field in Invoice
'Invoice Date'=>'Díjbekérő kiállítási dátuma',
'Sub Total'=>'Részösszeg',
'Due date'=>'Határidő',
'Carrier'=>'Futár',
'Type'=>'Típus',
'Sales Tax'=>'ÁFA',
'Sales Commission'=>'Értékesítési jutalék',
'Excise Duty'=>'Jövedéki adó',
'Total'=>'Összeg',
'Product Name'=>'Termék neve',
'Assigned To'=>'Felelős',
'Billing Address'=>'Számlázási cím - Utca',
'Shipping Address'=>'Szállítási cím - Utca',
'Billing City'=>'Számlázási cím - Város',
'Billing State'=>'Számlázási cím - Állam/megye',
'Billing Code'=>'Számlázási cím - Irányítószám',
'Billing Country'=>'Számlázási cím - Ország',
'Billing Po Box'=>'Számlázási cím - Postafiók',
'Shipping Po Box'=>'Szállítási cím - Postafiók',
'Shipping City'=>'Szállítási cím - Város',
'Shipping State'=>'Szállítási cím - Állam/megye',
'Shipping Code'=>'Szállítási cím - Irányítószám',
'Shipping Country'=>'Szállítási cím - Ország',
'City'=>'Város',
'State'=>'Állam/megye',
'Code'=>'Kód',
'Country'=>'Ország',
'Created Time'=>'Létrehozva',
'Modified Time'=>'Módosítva',
'Description'=>'Megjegyzés',
'Potential Name'=>'Lehetőség neve',
'Customer No'=>'Ügyfél száma',
'Sales Order'=>'Megrendelések',
'Pending'=>'Függőben',
'Account Name'=>'Cég neve',
'Terms & Conditions'=>'Határidők és Feltételek',
//Quote Info
'LBL_INVOICE_INFORMATION'=>'Díjbekérő Információ',
'LBL_INVOICE'=>'Díjbekérő:',
'LBL_SO_INFORMATION'=>'Megrendelés adatai',
'LBL_SO'=>'Megrendelés:',

//Added in release 4.2
'LBL_SUBJECT'=>'Tárgy:',
'LBL_SALES_ORDER'=>'Megrendelés:',
'Invoice Id'=>'Díjbekérő No.',
'LBL_MY_TOP_INVOICE'=>'Legfontosabb ki nem egyenlített Díjbekérőim',
'LBL_INVOICE_NAME'=>'Díjbekérő neve:',
'Purchase Order'=>'Beszerzések',
'Status'=>'Állapot',
'Id'=>'Díjbekérő No.',
'Invoice'=>'Díjbekérő',

//Added for existing Picklist Entries

'Created'=>'Létrehozott',
'Approved'=>'Jóváhagyott',
'Sent'=>'Elküldött',
'Credit Invoice'=>'Utalásos Díjbekérő',
'Paid'=>'Fizetett',
'AutoCreated'=>'Automatikusan létrehozva',
//Added to Custom Invoice Number
'Invoice No'=>'Díjbekérő No.',
'Adjustment'=>'Kézi módosítási lehetőség',

//Added for Reports (5.0.4)
'Tax Type'=>'Adó típusa',
'Discount Percent'=>'Kedvezmény Százalék',
'Discount Amount'=>'Kedvezmény Összeg',
'Terms & Conditions'=>'Határidők és Feltételek',
'No'=>'Nem',
'Date'=>'Dátum',

// Added affter 5.0.4 GA
//Added for Documents module
'Documents'=>'Dokumentumok',
'SINGLE_Invoice'=>'Díjbekérő',
);

?>
