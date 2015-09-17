(function(global, $){
    var contactForm = $("#form-contact");

    contactForm.submit(function(){
        return false;
    }).validate({
        rules:{
           userName:{
               required: true
           },
           userCom:{
               required: true
           }
        },
        messages:{

        },
        submitHandler: function(){
            var currentForm = $(this.currentForm),
                formData = currentForm.serialize();
            console.log(formData);
        }
    });
}(window, window.jQuery));