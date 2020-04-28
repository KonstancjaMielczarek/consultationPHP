const bar = document.querySelector('.fa-bars');
const closeNav = document.querySelector('.fa-times');
const nav = document.querySelector('nav');
const schedule = document.querySelector('.schedule tbody');
const submit = document.querySelector('[type=submit');
const options = document.querySelector('[name=weeks]');
const data = [];

$(document).ready(function () {

    let json = "1";

    const test = jQuery.ajax({
        type: "POST",
        url: 'http://localhost:8080/',
        dataType: 'json',

        success: function (obj, textstatus, response) {
            if (!('error' in obj)) {
                json = response.responseJSON;

                for(let i=0; i<json.data.length ;i ++){
                    data.push(json.data[i]);
                }
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


function markSchedule(firstDay, lastDay){
    const days = []
    console.log(data);
    for(let i=0; i< data.length; i++){
        console.log(data[i])
        const day = Number(data[i].date.split('-')[2]);
        
        if(day >= firstDay && day<= lastDay) {
            const dataCopy = Object.assign({}, data[i])
            dataCopy.dayIndex = i;
            days.push(dataCopy);
        }
    }
    //console.log(days);
    for(let i=0; i<days.length; i++){
        const startHour = days[i].start_hour.split(':');
        const endHour = days[i].end_hour.split(':');
        const hourStart = startHour[0];
        const minuteStart = startHour[1];
        const hourEnd = endHour[0];
        const minuteEnd = endHour[1];
        const tr = document.querySelectorAll('table tr');
        let setColor = false;
        //console.log(days[i]);
        for(let j=1; j<tr.length; j++){
            const children = tr[j].children[0];

            if(children.textContent.substr(0,2) === hourStart && children.textContent.substr(3,2) === minuteStart){
                tr[j].children[days[i].dayIndex + 1].style.backgroundColor = 'rgba(62, 56, 242, 0.9)';
                setColor = true;
            }

            if(children.textContent.substr(0,2) === hourEnd && children.textContent.substr(3,2) === minuteEnd){
                setColor = false;
            }

            if(setColor === true){
                tr[j].children[days[i].dayIndex + 1].style.backgroundColor = 'rgba(62, 56, 242, 0.9)';
            }
        }
    }
}

function checkWeek(e) {
    
    if(e){
        e.preventDefault();
    }
    
    const options = document.querySelector('[name=weeks]');
    const children = [...options]
    const tr = document.querySelectorAll('table tr');
    let selected;

    children.map((item) => {
        if (item.selected) selected = item
    });

    const arrayWeek = selected.textContent.split("-");
    const firstDay = Number(arrayWeek[0].substr(0,2));
    const lastDay = Number(arrayWeek[1].substr(1,2));

    for(let i=0; i<tr.length; i++){
        const children = tr[i].children;
        for(let j=0; j<children.length; j++){
            children[j].style.backgroundColor = 'white';
        }
    }

    markSchedule(firstDay, lastDay);
}

bar.addEventListener('click', () => {
    nav.style.top = '0'
    bar.style.display = 'none';
});
closeNav.addEventListener('click', () => {
    nav.style.top = '-50px'
    bar.style.display = 'block';
});

submit.addEventListener('click', checkWeek)

addRows();
setTimeout(checkWeek, 500);