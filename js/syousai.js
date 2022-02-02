

//カウンター
var ary = document.getElementsByName("input[]");

//加算
function addOne(value) {
    ary[value].value++;
    chgNumBack(value);
}

//減算
function subOne(value) {
    if (ary[value].value >= 1) {
        ary[value].value--;
    } else {
        chgNumBack(value);
    }
}