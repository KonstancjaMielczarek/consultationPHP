const bar = document.querySelector('.fa-bars');
const closeNav = document.querySelector('.fa-times');
const nav = document.querySelector('nav');
const schedule = document.querySelector('.schedule tbody');


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
    
function addRows() {
    const startHour = 10;
    const endHour = 13;

    for(let i=startHour; i <= endHour; i++){

        for(let j=0; j<6; j++){
            schedule.innerHTML += `
            <tr>
                <td class='tableTime'>${i}:${j === 0 ? '00' : j * 10}-${ j === 5 ? i + 1: i}:${j === 5 ? '00': (j + 1)*10}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            `;
        }
    }
};

bar.addEventListener('click', () => {
    nav.style.top = '0'
    bar.style.display = 'none';
});
closeNav.addEventListener('click', () => {
    nav.style.top = '-50px'
    bar.style.display = 'block';
});

addRows();

