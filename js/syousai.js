var plice = 850;//document.getElementById("plice").value;
var totalprice = 0;


//カウンター
var ary = document.getElementsByName("input[]");

//加算
function addOne(value) {
    ary[value].value++;
    totalprice = totalprice + plice;
    chgNumBack(value);
}

//減算
function subOne(value) {
    if (ary[value].value >= 1) {
        ary[value].value--;
        totalprice = totalprice - plice;
    } else {
        chgNumBack(value);
    }
}

function total() {
    var massage = '小計は' + totalprice + 'です。\nカートに追加しますか?';
    if (confirm(massage)) {
        submit();
    }
    else {
        return false;
    }
}
    function submit() {
        location.href='cartadd.php';
        

    }
    