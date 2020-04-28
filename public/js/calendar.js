const bar = document.querySelector('.fa-bars');
const closeNav = document.querySelector('.fa-times');
const nav = document.querySelector('nav');
const info = document.querySelector('.info');
const startHour = document.querySelector('[name=start_hour]');
const endHour = document.querySelector('[name=end_hour]');
let flagInput = 1;

bar.addEventListener('click', () => {
    nav.style.top = '0'
    bar.style.display = 'none';
});
closeNav.addEventListener('click', () => {
    nav.style.top = '-50px'
    bar.style.display = 'block';
});

function validateTime(e){
    const minute = this.value.split(':')[1]

    if(flagInput === 2){
        if(Number(minute) === 0 || Number(minute) % 10 === 0){
            console.log('Jest ok');
            flagInput = 1;
        }else{
            this.value = '--:--'
            alert('Można wybrać pełną godzine lub 10,20,30,40,50 minut');
            flagInput = 1;
            return;
        }
    }

    flagInput++
}

startHour.addEventListener('input', validateTime);

endHour.addEventListener('input', validateTime)

function createInfo(){
    info.innerHTML += `
    <p>Poniedziałek 11-14</p>
    <p>Wtorek 9-11</p>
    `;
}

createInfo();