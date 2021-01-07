if (document.getElementById('count').innerText === '') {
    document.getElementById('count').innerText = '0';
}

if (document.getElementById('sum').innerText === '') {
    displaySumOff();
}

function displaySumOn() {
    document.getElementById('basket_sum').hidden=false;
}

function displaySumOff() {
    document.getElementById('basket_sum').hidden=true;
}
