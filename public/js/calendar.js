const bar = document.querySelector('.fa-bars');
const closeNav = document.querySelector('.fa-times');
const nav = document.querySelector('nav');

bar.addEventListener('click', () => {
    nav.style.top = '0'
    bar.style.display = 'none';
});
closeNav.addEventListener('click', () => {
    nav.style.top = '-50px'
    bar.style.display = 'block';
});

$(document).ready(function () {

    let json = "1";

    const test = jQuery.ajax({
        type: "POST",
        url: 'http://localhost:8080/calendar',
        dataType: 'json',

        success: function (obj, textstatus, response) {
            console.log(response);
            if (!('error' in obj)) {
                json = response.responseJSON;

                console.log(json);
            } else {
                console.log(obj.error);
            }
        }
    });

});
    

