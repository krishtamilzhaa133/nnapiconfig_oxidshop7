
jQuery(document).ready(
    function () {
        setNovalnetConfig();
        jQuery("input[name='confstrs[productactivationkey]'], input[name='confstrs[paymentaccesskey]']").change(
            function () {
                setNovalnetConfig();
            }
        );
        if(jQuery('form#moduleConfiguration').length) {
            jQuery("#moduleConfiguration").submit(
                function () {
                    var sNovalnetActivationKey = jQuery.trim(jQuery("input[name='confstrs[productactivationkey]']").val());
                    var sNovalnetAccessKey = jQuery.trim(jQuery("input[name='confstrs[paymentaccesskey]']").val());
                    var sErrorMsg = jQuery('#sMandatoryError').val();
                    if (sNovalnetActivationKey == '' || sNovalnetAccessKey == '') {
                        alert(sErrorMsg);
                        return false;
                    }
                }
            );
        }
    }
);


function setNovalnetConfig()
{
  
    var sNovalnetActivationKey = jQuery.trim(jQuery('input[name="confstrs[productactivationkey]"]').val());
    var sNovalnetAccessKey = jQuery.trim(jQuery('input[name="confstrs[paymentaccesskey]"]').val());
    if (sNovalnetActivationKey != '' && sNovalnetAccessKey != '') {
        getMerchantConfigs(sNovalnetActivationKey, sNovalnetAccessKey);
    }
    else{
        if(jQuery('input[name="confstrs[productactivationkey]"]').val() =="" && jQuery('input[name="confstrs[paymentaccesskey]"]').val()==""){
	    jQuery('#dNovalnetTariffId').val('');
	    jQuery('input[name="confstrs[clientkey]"]').val('');
     	jQuery('input[name="confstrs[projectid]"]').val('');
        }
    }
}


function getMerchantConfigs(sNovalnetActivationKey, sNovalnetAccessKey)
{
    var sToken   = jQuery('#sToken').val();
    var sShopUrl  = jQuery('#sGetUrl').val();
    var oParams = { 'signature': sNovalnetActivationKey, 'access_key': sNovalnetAccessKey, 'lang':'EN' };
  
    if (sShopUrl != '' && sToken != '') {
        var sFormUrl  =  sShopUrl+"index.php?cl=Nnapiconfigure&fnc=getmerchatdetails&stoken="+sToken;
        jQuery.ajax(
            {
                url: sFormUrl,
                type: 'POST',
                data: oParams,
            
                success: function (response) {
                    var resultData = /{.*}/.exec(response);
                    console.log(resultData);
                    if (resultData) {
                        var jsonresponse = JSON.parse(resultData);
                        var response = jsonresponse;
                        console.log(response.merchant.vendor);
                        if (response.merchant.vendor != undefined && response.merchant.project != undefined) {
                            var tariff = response.merchant.tariff;
                            var novalnetSavedTariff = jQuery('#novalnetSavedTariff').val();
                            jQuery("#dNovalnetTariffId option").remove();
                            jQuery.each(
                                tariff, function ( index, value ) {
                                    jQuery('<option/>', { text  : value.name, value : index }).appendTo('#dNovalnetTariffId');
                                }
                            );
                            if (novalnetSavedTariff != '') {
                                      jQuery('#dNovalnetTariffId').find('option[value=' + novalnetSavedTariff + ']').attr('selected', true);
                            } else {
                                jQuery('#dNovalnetTariffId').val(jQuery.trim(Object.keys(response.merchant.tariff)[0])).attr("selected", true);
                            }
                             if (response.merchant.client_key != '' || response.merchant.project != '') {
                                jQuery("#clientkey").val(response.merchant.client_key);
                                jQuery("#projectid").val(response.merchant.project);
                             }
                        }
                    }
                }
            }
        );
    }
}


























