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
        url: 'http://localhost:8080/listConsultation',
        dataType: 'json',

        success: function (obj, textstatus, response) {
            if (!('error' in obj)) {
                json = response.responseJSON;

                console.log(json.data);
                const table = document.querySelector('table');
                for(let i=0; i<json.data.length; i++){
                    table.innerHTML += `
                    <tr>
                        <td>${json.data[i].name}</td>
                        <td>${json.data[i].surname}</td>
                        <td>${json.data[i].date}</td>
                        <td>${json.data[i].start_hour}</td>
                        <td>${json.data[i].end_hour}</td>
                        <td>${json.data[i].email}</td>
                        <td>${json.data[i].subject}</td>
                        <td>${json.data[i].status}</td>
                    </tr>
                    `
                }
            } else {
                console.log(obj.error);
            }
        }
    });

});