$(function(){

 var form = $("#form-total22");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {

            username: {
                required: true,
            },

            email: {
                required: true,
                email : true,
            }
        },


        onfocusout: function(element) {
            $(element).valid();
           if($('#country').hasClass('error')){
             $('#country').attr('style', 'border-bottom:2px solid #ff1212 !important');         
           }
           if($('#state').hasClass('error')){
             $('#state').attr('style', 'border-bottom:2px solid #ff1212 !important');         
           }
            if($('#smonth').hasClass('error')){
             $('#smonth').attr('style', 'border-bottom:2px solid #ff1212 !important');         
           }

        },
        highlight : function(element, errorClass, validClass) {

            $(element.form).find('.actions').addClass('form-error');
            $(element).removeClass('valid');
            $(element).addClass('error');
           if($('#country').hasClass('error')){
             $('#country').attr('style', 'border-bottom:2px solid #ff1212 !important');          
           }
           if($('#state').hasClass('error')){
             $('#state').attr('style', 'border-bottom:2px solid #ff1212 !important');          
           }
           if($('#smonth').hasClass('error')){
             $('#smonth').attr('style', 'border-bottom:2px solid #ff1212 !important');          
           }
        },
        unhighlight: function(element, errorClass, validClass) {

            $(element.form).find('.actions').removeClass('form-error');
            $(element).removeClass('error');
            $(element).addClass('valid');
           if($('#country').hasClass('error')){
             $('#country').attr('style', 'border-bottom:2px solid #ff1212 !important');          
           }
           else{
             $('#country').attr('style', 'border-bottom: 2px solid #b1afaf');          
           }

          if($('#state').hasClass('error')){
             $('#state').attr('style', 'border-bottom:2px solid #ff1212 !important');          
           }
           else{
             $('#state').attr('style', 'border-bottom: 2px solid #b1afaf');          
           }

          if($('#smonth').hasClass('error')){
             $('#smonth').attr('style', 'border-bottom:2px solid #ff1212 !important');          
           }
           else{
             $('#smonth').attr('style', 'border-bottom: 2px solid #b1afaf');          
           }           

        }



    });



    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Previous',
            next : 'Next Step',
            finish : 'Submit',
            current : ''
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            form.validate().settings.ignore = ":disabled,:hidden";
            // console.log(form.steps("getCurrentIndex"));
            return form.valid();
            return true;
        }
    });
    $("#date").datepicker({
        dateFormat: "MM - DD - yy",
        showOn: "both",
        buttonText : '<i class="zmdi zmdi-chevron-down"></i>',
    });
});
