		
		
		
		

function copyAddressRight(form) {

	form.otherstreet.value = form.mailingstreet.value;

	form.othercity.value = form.mailingcity.value;

	form.otherstate.value = form.mailingstate.value;

	form.otherzip.value = form.mailingzip.value;

	form.othercountry.value = form.mailingcountry.value;

	form.otherpobox.value = form.mailingpobox.value;
	
	return true;

}

function copyAddressLeft(form) {

	form.mailingstreet.value = form.otherstreet.value;

	form.mailingcity.value = form.othercity.value;

	form.mailingstate.value = form.otherstate.value;

	form.mailingzip.value =	form.otherzip.value;

	form.mailingcountry.value = form.othercountry.value;

	form.mailingpobox.value = form.otherpobox.value;
	
	return true;

}

	
function toggleDisplay(id){
		
if(this.document.getElementById( id).style.display=='none'){
	this.document.getElementById( id).style.display='inline'
	this.document.getElementById(id+"link").style.display='none';
					
}else{
	this.document.getElementById(  id).style.display='none'
	this.document.getElementById(id+"link").style.display='none';
	}
}

function showDefaultCustomView(selectView)
{
viewName = selectView.options[selectView.options.selectedIndex].value;
document.massdelete.viewname.value=viewName;
document.massdelete.action="index.php?module=Contacts&action=index&return_module=Contacts&return_action=index&viewname="+viewName;
document.massdelete.submit();
}
//code added by raju for better emiling
function eMail()
{
    x = document.massdelete.selected_id_con.length;
	var viewid = document.massdelete.viewname.value;
	idstring = "";

        if ( x == undefined)
        {

                if (document.massdelete.selected_id_con.checked)
                {
                        document.massdelete.idlist.value=document.massdelete.selected_id_con.value;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        else
        {
                xx = 0;
                for(i = 0; i < x ; i++)
                {
                        if(document.massdelete.selected_id_con[i].checked)
                        {
                                idstring = document.massdelete.selected_id_con[i].value +";"+idstring
                                xx++
                        }
                }
                if (xx != 0)
                {
                        document.massdelete.idlist.value=idstring;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        document.massdelete.action="index.php?module=Emails&action=SelectEmails&return_module=Contacts&return_action=index";
}
//end of code by raju
function massDelete()
{

        x = document.massdelete.selected_id_con.length;
	var viewid = document.massdelete.viewname.value;
        idstring = "";

        if ( x == undefined)
        {

                if (document.massdelete.selected_id_con.checked)
                {
                        document.massdelete.idlist.value=document.massdelete.selected_id_con.value;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        else
        {
                xx = 0;
                for(i = 0; i < x ; i++)
                {
                        if(document.massdelete.selected_id_con[i].checked)
                        {
                                idstring = document.massdelete.selected_id_con[i].value +";"+idstring
                        xx++
                        }
                }
                if (xx != 0)
                {
                        document.massdelete.idlist.value=idstring;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
	}
		if(confirm("Are you sure you want to delete the selected "+xx+" records ?"))
		{
        document.massdelete.action="index.php?module=Users&action=massdelete&return_module=Contacts&return_action=ListView&viewname="+viewid;
		}
		else
		{
			return false;
		}
}

function massMail()
{

        x = document.massdelete.selected_id_con.length;
	var viewid = document.massdelete.viewname.value;
	idstring = "";
	
        if ( x == undefined)
        {

                if (document.massdelete.selected_id_con.checked)
                {
                        document.massdelete.idlist.value=document.massdelete.selected_id_con.value;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        else
        {
                xx = 0;
                for(i = 0; i < x ; i++)
                {
                        if(document.massdelete.selected_id_con[i].checked)
                        {
                                idstring = document.massdelete.selected_id_con[i].value +";"+idstring
                                xx++
                        }
                }
                if (xx != 0)
                {
                        document.massdelete.idlist.value=idstring;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        document.massdelete.action="index.php?module=CustomView&action=SendMailAction&return_module=Contacts&return_action=index&viewname="+viewid;
}

//to merge a list of contacts with the templates
function massMerge()
{

        x = document.massdelete.selected_id_con.length;
	var viewid = document.massdelete.viewname.value;
        idstring = "";

        if ( x == undefined)
        {

                if (document.massdelete.selected_id_con.checked)
                {
                        document.massdelete.idlist.value=document.massdelete.selected_id_con.value;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        else
        {
                xx = 0;
                for(i = 0; i < x ; i++)
                {
                        if(document.massdelete.selected_id_con[i].checked)
                        {
                                idstring = document.massdelete.selected_id_con[i].value +";"+idstring
                        xx++
                        }
                }
                if (xx != 0)
                {
                        document.massdelete.idlist.value=idstring;
                }
                else
                {
                        alert("Please select atleast one entity");
                        return false;
                }
        }
        if(getObj('selectall_con').checked == true)
				{
						getObj('idlist').value = getObj('allids').value;
				}
        document.massdelete.action="index.php?module=Contacts&action=Merge&return_module=Contacts&return_action=ListView&viewname="+viewid;
}
//end mass merge

function addBusinessCard()
{
document.massdelete.action="index.php?module=Contacts&action=AddBusinessCard&return_module=Contacts&return_action=ListView"


}

function set_return(product_id, product_name) {
        window.opener.document.EditView.parent_name.value = product_name;
        window.opener.document.EditView.parent_id.value = product_id;
}
function set_return_specific(product_id, product_name) {
        window.opener.document.EditView.contact_name.value = product_name;
        window.opener.document.EditView.contact_id.value = product_id;
}
function add_data_to_relatedlist(entity_id,recordid) {

        opener.document.location.href="index.php?module={RETURN_MODULE}&action=updateRelations&smodule={SMODULE}&destination_module=Contacts&entityid="+entity_id+"&parid="+recordid;
}
//added by rdhital for better emails
function set_return_emails(entity_id,email_id,parentname,emailadd){
		window.opener.document.EditView.parent_id.value = window.opener.document.EditView.parent_id.value+entity_id+'@'+email_id+'|';
		window.opener.document.EditView.parent_name.value = window.opener.document.EditView.parent_name.value+parentname+'<'+emailadd+'>; ';
}	
//added by raju for emails
function submitform(id){
		document.massdelete.entityid.value=id;
		document.massdelete.submit();
}	



