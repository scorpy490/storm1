function bt_click()
{
    let sumbonus=0;
    ticby++;
    let res_str = "Без выигрыша"
    let res = Math.floor(Math.random()*all_tic)
    if (ext_tikets.has(res)) res_str = "Дубль";
    if (tikets.has(res))
    {
        res_str = tikets.get(res);
        wincost+=tikets.get(res);
        tikets.delete(res);
        let k1 = win_list.get(res_str)
        win_list.set(res_str, ++k1)
    }
    for (var [key, value] of tikets)
    {
        sumbonus+=value;
    }
    document.getElementById("i1").innerHTML = '<h3>'+res_str+'<h3>';
    document.getElementById("ticby").innerHTML = ticby.toLocaleString("ru");
    document.getElementById("cost").innerHTML = (ticby*50).toLocaleString('ru');
    document.getElementById("wincost").innerHTML = wincost.toLocaleString('ru');
    document.getElementById("wintic").innerHTML = tikets.size.toLocaleString('ru');
    document.getElementById("sumbonus").innerHTML = sumbonus.toLocaleString('ru');
    document.getElementById("w50").innerHTML = win_list.get(50);
    document.getElementById("w125").innerHTML = win_list.get(125);
    document.getElementById("w250").innerHTML = win_list.get(250);
    document.getElementById("w1250").innerHTML = win_list.get(1250);
    document.getElementById("w2k5").innerHTML = win_list.get(2500);
    document.getElementById("w12k5").innerHTML = win_list.get(125000);
    document.getElementById("w1m").innerHTML = win_list.get(1000000);
}

function sum_tic() {
    let s=0;
    for (const [key, value] of tikets) {
        s += value;
    }
    return s
}

//document.getElementById("bt")
let k=0;
let wincost = 0;
let ticby = 0;
let tikets = new Map();
let ext_tikets = new Map();
let all_tic = 2000000;
let priz_arr = new Map();
let win_list = new Map();
priz_arr.set(50,600000);
priz_arr.set(125,48000);
priz_arr.set(250,10000);
priz_arr.set(1250,4000);
priz_arr.set(2500,2000);
priz_arr.set(125000,4);
priz_arr.set(1000000,1);

for (var [key, value] of priz_arr) {
    //console.log(value*key);
    k=0
    while (k<value) {
        let bon = Math.floor(Math.random() * all_tic)
        if (!tikets.has(bon)) {
            tikets.set(bon, key);
            k++;
        }
    }
    console.log(k);
}
for (var [key] of priz_arr){
    win_list.set(key,0)
}

