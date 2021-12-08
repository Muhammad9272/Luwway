(function($) {

    var form = $("#signup-form");
    if(gs.front_debug==0){
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                 element.before(error); 
            },
            rules: {

                fname : {
                    required: true,
                },
                lname : {
                    required: true,
                },
                email: {
                    required: true,
                    email : true
                },
                name:{
                    required:true,
                },
                address:{
                    required:true,
                },
                gender:{
                    required:true,
                } ,           
                shop_name : {
                    required: true,
                },
                owner_name : {
                    required: true,
                },
                shop_number : {
                    required: true,
                },
                shop_address : {
                    required: true,
                },
                country_id : {
                    required: true,
                },
                state_id : {
                    required: true,
                },
                photo : {
                    required: true,
                },
                zip : {
                    required: true,
                },
                phone : {
                    required: true,
                },
                shop_image : {
                    required: true,
                },
                password:{
                    required: true,
                } ,
                password_confirmation: {
                    equalTo: "#regex",
                },
                privacy_policy:{
                    required:true,
                },
                gender:{
                    required:true,
                },

                messages: {
                    password: " Enter Password",
                    confirmpassword: " Enter Confirm Password Same as Password"
                },


            },
            onfocusout: function(element) {
                $(element).valid();
            },
            highlight : function(element, errorClass, validClass) {
                $(element.form).find('.actions').addClass('form-error');
                $(element).removeClass('valid');
                $(element).addClass('error');
                // $('#error_gender').html('<label id="gender11" class="text-danger">Select Gender</label>');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element.form).find('.actions').removeClass('form-error');
                $(element).removeClass('error');
                $(element).addClass('valid');
                // $('#gender11').remove();
            }
        });
    }

    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        labels: {
            previous : 'Previous',
            next : 'Next',
            finish : 'Submit',
            current : ''
        },
        titleTemplate : '<span class="title">#title#</span>',
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
         // $('#signup-form').submit();
        },
        // onInit : function (event, currentIndex) {
        //     event.append('demo');
        // }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });

    // $('#gender').parent().append('<ul class="list-item" id="newgender" name="gender"></ul>');
    // $('#gender option').each(function(){
    //     $('#newgender').append('<li value="' + $(this).val() + '">'+$(this).text()+'</li>');
    // });
    // $('#gender').remove();
    // $('#newgender').attr('id', 'gender');
    // $('#gender li').first().addClass('init');
    // $("#gender").on("click", ".init", function() {
    //     $(this).closest("#gender").children('li:not(.init)').toggle();
    // });
    
    // var allOptions = $("#gender").children('li:not(.init)');
    // $("#gender").on("click", "li:not(.init)", function() {
    //     allOptions.removeClass('selected');
    //     $(this).addClass('selected');
    //     $("#gender").children('.init').html($(this).html());
    //     allOptions.toggle();
    // });

    // $('#country').parent().append('<ul class="list-item" id="newcountry" name="country"></ul>');
    // $('#country option').each(function(){
    //     $('#newcountry').append('<li value="' + $(this).val() + '">'+$(this).text()+'</li>');
    // });
    // $('#country').remove();
    // $('#newcountry').attr('id', 'country');
    // $('#country li').first().addClass('init');
    // $("#country").on("click", ".init", function() {
    //     $(this).closest("#country").children('li:not(.init)').toggle();
    // });
    
    // var CountryOptions = $("#country").children('li:not(.init)');
    // $("#country").on("click", "li:not(.init)", function() {
    //     CountryOptions.removeClass('selected');
    //     $(this).addClass('selected');
    //     $("#country").children('.init').html($(this).html());
    //     CountryOptions.toggle();
    // });

    // $('#payment_type').parent().append('<ul  class="list-item" id="newpayment_type" name="payment_type"></ul>');
    // $('#payment_type option').each(function(){
    //     $('#newpayment_type').append('<li value="' + $(this).val() + '">'+$(this).text()+'</li>');
    // });
    // $('#payment_type').remove();
    // $('#newpayment_type').attr('id', 'payment_type');
    // $('#payment_type li').first().addClass('init');
    // $("#payment_type").on("click", ".init", function() {
    //     $(this).closest("#payment_type").children('li:not(.init)').toggle();
    // });
    
    // var PaymentsOptions = $("#payment_type").children('li:not(.init)');
    // $("#payment_type").on("click", "li:not(.init)", function() {
    //     PaymentsOptions.removeClass('selected');
    //     $(this).addClass('selected');
    //     $("#payment_type").children('.init').html($(this).html());
    //     PaymentsOptions.toggle();
    // });

    $.dobPicker({
        daySelector: '#birth_date',
        monthSelector: '#birth_month',
        yearSelector: '#birth_year',
        dayDefault: 'Day',
        monthDefault: 'Month',
        yearDefault: 'Year',
        minimumAge: 0,
        maximumAge: 120
    });

    $.dobPicker({
        daySelector: '#expiry_date',
        monthSelector: '#expiry_month',
        yearSelector: '#expiry_year',
        dayDefault: 'Day',
        monthDefault: 'Month',
        yearDefault: 'Year',
        minimumAge: 0,
        maximumAge: 120
    });
        
})(jQuery);
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.your_picture_image')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}