$(document).ready(function () {

    let json = "1";

    const test = jQuery.ajax({
        type: "GET",
        url: '',
        dataType: 'json',

        success: function (obj, textstatus, response) {
            if (!('error' in obj)) {
                json = response.responseJSON;
                console.log(json);
                let array = [
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                    ["", "", "", "", "", ""],
                ]
                table = document.getElementById("table");

                let column = 0;
                let row = 0;
                let minute = 0;
                let hour = 0;
                let startTime;
                let cell;
                let id;

                for (let i = 0; i < json.data.length; i++) {

                    startTime = (json.data[i].start_cons).substr(0, 2);

                    for (let l = 0; l < 24; l++) {

                        if (((json.data[i].start_hour).substr(0, 5)) == (startTime + ":" + minute + "0")) {
                            row = l;
                        }

                        if (((json.data[i].end_hour).substr(0, 5)) == (startTime + ":" + minute + "0")) {
                            hour = l;
                        }

                        minute++;

                        if (minute > 5) {
                            minute = 0;
                            startTime++;
                        }

                    }

                    switch ((json.data[i].day_name).toLowerCase()) {
                        case "poniedziałek":
                            column = 1;
                            break;
                        case "wtorek":
                            column = 2;
                            break;
                        case "środa":
                            column = 3;
                            break;
                        case "czwartek":
                            column = 4;
                            break;
                        case "piątek":
                            column = 5;
                            break;
                    };


                    for (let m = 0; m < (hour - row); m++) {
                        array[(row + m)][column] = json.data[i].name + " " + json.data[i].surname;
                        console.log((row + 1 + m) + "_" + (1 + column));
                        cell = document.getElementById((row + 1 + m) + "_" + (1 + column));
                        cell.style['background'] = '#2f323e';
                        cell.style['color'] = '#fff'
                    }

                }


                minute = 0;
                startTime = (json.data[0].start_cons).substr(0, 2);

                for (let i = 0; i < 24; i++) {
                    array[i][0] = startTime + ":" + minute + "0";
                    minute++;
                    if (minute > 5) {
                        minute = 0;
                        startTime++;
                    }
                }



                // rows
                for (let i = 1; i < table.rows.length; i++) {
                    // cells
                    for (let j = 0; j < table.rows[i].cells.length; j++) {
                        table.rows[i].cells[j].innerHTML = array[i - 1][j];
                    }
                }


            } else {
                console.log(obj.error);
            }
        }
    });

});