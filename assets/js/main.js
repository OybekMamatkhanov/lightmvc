$(document).ready(function () {

    $('#InputName').change(function(){
        var test = $('#InputName').val();
        $('#image_name').html(test);
        console.log(test);
    });

    $('#InputEmail').change(function(){
        var test = $('#InputEmail').val();
        $('#image_email').html(test);
        console.log(test);
    });

    $('#InputMessage').change(function(){
        var test = $('#InputEmail').val();
        $('#image_message').html(test);
        console.log(test);
    });


    $('#InputImage').change(function () {


        $(".image_name").val("Задерищенко")
        if (this.files.length > 0) {

            $.each(this.files, function (i, v) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = new Image();
                    img.src = e.target.result;

                    img.onload = function () {

                        var canvas = document.createElement("canvas");

                        var value = 25;

                        img.width = (img.width * value) / 320;
                        img.height = (img.height * value) / 240;

                        var ctx = canvas.getContext("2d");
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.drawImage(img, 0, 0, img.width, img.height);

                        $('#image_content').append(img);

                    }
                };
                reader.readAsDataURL(this);
            });
        }
    });

});





/*$("#InputName").keyup(function () {
    var value = $(this).val();
    $("#image_name").text(value);
}).keyup();*/

/*var name = document.getElementById("InputName");
var message = document.getElementById("InputMessage");
var email = document.getElementById("InputEmail");*/
//$('#image_name').val("#InputName");
/*$('#image_email').html(message);
$('#image_message').html(email);*/