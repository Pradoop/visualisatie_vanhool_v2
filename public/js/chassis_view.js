//Search Box
$(document).ready(function(){
    $("#search_input").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

//Variables
let current_column = -1;
let status = 0;

//Functions
function sorterCheck(i) {

    if(current_column !== i) {
        //Remove all
        if(document.getElementById('up_logo') !== null) {
            let remove = document.getElementById('up_logo');
            remove.parentNode.removeChild(remove);
        }
        if(document.getElementById('down_logo') !== null) {
            let remove = document.getElementById('down_logo');
            remove.parentNode.removeChild(remove);
        }
        //Reset variables
        current_column = i;
        status = 0;
    }

    //Change sorting status
    if(status === 0) {//DOWN
        console.log('Column ' + current_column + ' clicked 1 time: ' + status + " (DOWN)");
        let img_down = document.createElement('img');
        img_down.setAttribute('id', 'down_logo');
        img_down.setAttribute('class', 'down_logo');
        img_down.setAttribute('src', BASE_URL + '/images/icons8-down-arrow-15.png');
        img_down.setAttribute('alt', '...');
        document.getElementById('th' + current_column).appendChild(img_down);
        status++;
    }
    else if(status === 1) {//UP
        console.log('Column ' + current_column + ' clicked 2 times: ' + status + " (UP)");
        let remove = document.getElementById('down_logo');
        remove.parentNode.removeChild(remove);
        let img_up = document.createElement('img');
        img_up.setAttribute('id', 'up_logo');
        img_up.setAttribute('class', 'up_logo');
        img_up.setAttribute('src', BASE_URL + '/images/icons8-up-arrow-15.png');
        img_up.setAttribute('alt', '...');
        document.getElementById('th' + current_column).appendChild(img_up);
        status++;
    }
    else {//ORIGINAL
        console.log('Column ' + current_column + ' clicked 3 times: ' + status + " (ORIGINAL)");
        let remove = document.getElementById('up_logo');
        remove.parentNode.removeChild(remove);
        status = 0;
    }

}
